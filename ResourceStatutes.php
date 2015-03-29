<?php

/*
 * This file is part of the Sonatra package.
 *
 * (c) François Pluchino <francois.pluchino@sonatra.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Sonatra\Bundle\ResourceBundle;

use Sonatra\Bundle\ResourceBundle\Exception\ClassNotInstantiableException;

/**
 * The action statutes for the resource domains.
 *
 * @author François Pluchino <francois.pluchino@sonatra.com>
 */
final class ResourceStatutes
{
    /**
     * The ResourceStatutes::PENDING status is used when an error is thrown on a
     * previous resource.
     *
     * This status is used in Sonatra\Bundle\ResourceBundle\Event\ResourceEvent
     * and Sonatra\Bundle\ResourceBundle\Domain\DomainInterface instances.
     */
    const PENDING = 'pending';

    /**
     * The ResourceStatutes::ERROR status is used when the action of the resource
     * domain wasn't completed successfully.
     *
     * This status is used in Sonatra\Bundle\ResourceBundle\Event\ResourceEvent
     * and Sonatra\Bundle\ResourceBundle\Domain\DomainInterface instances.
     */
    const ERROR = 'error';

    /**
     * The ResourceStatutes::CREATED status is used when the action of domain has
     * created the resource successfully.
     *
     * This status is used in Sonatra\Bundle\ResourceBundle\Event\ResourceEvent
     * and Sonatra\Bundle\ResourceBundle\Domain\DomainInterface instances.
     */
    const CREATED = 'created';

    /**
     * The ResourceStatutes::UPDATED status is used when the action of domain has
     * updated the resource successfully.
     *
     * This status is used in Sonatra\Bundle\ResourceBundle\Event\ResourceEvent
     * and Sonatra\Bundle\ResourceBundle\Domain\DomainInterface instances.
     */
    const UPDATED = 'updated';

    /**
     * The ResourceStatutes::DELETED status is used when the action of domain has
     * deleted the resource successfully.
     *
     * This status is used in Sonatra\Bundle\ResourceBundle\Event\ResourceEvent
     * and Sonatra\Bundle\ResourceBundle\Domain\DomainInterface instances.
     */
    const DELETED = 'deleted';

    /**
     * The ResourceStatutes::UNDELETED status is used when the action of domain has
     * undeleted the resource successfully.
     *
     * This status is used in Sonatra\Bundle\ResourceBundle\Event\ResourceEvent
     * and Sonatra\Bundle\ResourceBundle\Domain\DomainInterface instances.
     */
    const UNDELETED = 'undeleted';

    /**
     * Constructor.
     *
     * @throws ClassNotInstantiableException
     */
    public function __construct()
    {
        throw new ClassNotInstantiableException(__CLASS__);
    }
}
