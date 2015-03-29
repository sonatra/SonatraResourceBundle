<?php

/*
 * This file is part of the Sonatra package.
 *
 * (c) François Pluchino <francois.pluchino@sonatra.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Sonatra\Bundle\ResourceBundle\Event;

use Sonatra\Bundle\ResourceBundle\Domain\DomainInterface;
use Sonatra\Bundle\ResourceBundle\Resource\ResourceInterface;
use Symfony\Component\EventDispatcher\Event;

/**
 * The resource event.
 *
 * @author François Pluchino <francois.pluchino@sonatra.com>
 */
class ResourceEvent extends Event
{
    /**
     * @var DomainInterface
     */
    private $domain;

    /**
     * @var ResourceInterface[]
     */
    private $resources;

    /**
     * Constructor.
     *
     * @param DomainInterface     $domain    The resource domain for this resources
     * @param ResourceInterface[] $resources The list of resource instances
     */
    public function __construct(DomainInterface $domain, array $resources)
    {
        $this->domain = $domain;
        $this->resources = $resources;
    }

    /**
     * Get the resource domain for this resources.
     *
     * @return DomainInterface
     */
    public function getDomain()
    {
        return $this->domain;
    }

    /**
     * Get the list of resource instances.
     *
     * @return ResourceInterface[]
     */
    public function getResources()
    {
        return $this->resources;
    }
}