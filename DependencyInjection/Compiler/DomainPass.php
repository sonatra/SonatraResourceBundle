<?php

/*
 * This file is part of the Fxp package.
 *
 * (c) François Pluchino <francois.pluchino@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Fxp\Bundle\ResourceBundle\DependencyInjection\Compiler;

use Symfony\Component\DependencyInjection\Compiler\CompilerPassInterface;
use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\DependencyInjection\Reference;

/**
 * @author François Pluchino <francois.pluchino@gmail.com>
 */
class DomainPass implements CompilerPassInterface
{
    /**
     * @var array|null
     */
    private $resolveTargets;

    /**
     * {@inheritdoc}
     */
    public function process(ContainerBuilder $container)
    {
        if (!$container->hasDefinition('fxp_resource.domain_manager')
                || !$container->hasDefinition('doctrine')) {
            return;
        }

        $managers = array();

        foreach ($container->findTaggedServiceIds('fxp_resource.domain') as $serviceId => $tag) {
            $managers[$serviceId] = new Reference($serviceId);
        }

        $container->getDefinition('fxp_resource.domain_manager')
            ->replaceArgument(0, $managers);

        $container->getDefinition('fxp_resource.domain_factory')
            ->addMethodCall('addResolveTargets', array($this->getResolveTargets($container)));
    }

    /**
     * Get the resolve target classes.
     *
     * @param ContainerBuilder $container The container
     *
     * @return array
     */
    private function getResolveTargets(ContainerBuilder $container)
    {
        if (null === $this->resolveTargets) {
            $this->resolveTargets = array();

            if ($container->hasDefinition('doctrine.orm.listeners.resolve_target_entity')) {
                $def = $container->getDefinition('doctrine.orm.listeners.resolve_target_entity');

                foreach ($def->getMethodCalls() as $call) {
                    if ('addResolveTargetEntity' === $call[0]) {
                        $this->resolveTargets[$call[1][0]] = $call[1][1];
                    }
                }
            }
        }

        return $this->resolveTargets;
    }
}
