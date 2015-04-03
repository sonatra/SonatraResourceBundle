<?php

/*
 * This file is part of the Sonatra package.
 *
 * (c) François Pluchino <francois.pluchino@sonatra.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Sonatra\Bundle\ResourceBundle\Resource;

use Sonatra\Bundle\ResourceBundle\Exception\InvalidArgumentException;
use Sonatra\Bundle\ResourceBundle\Exception\UnexpectedTypeException;
use Sonatra\Bundle\ResourceBundle\ResourceStatutes;
use Symfony\Component\Form\FormInterface;
use Symfony\Component\Validator\ConstraintViolationList;
use Symfony\Component\Validator\ConstraintViolationListInterface;

/**
 * Action resource for domain.
 *
 * @author François Pluchino <francois.pluchino@sonatra.com>
 */
class Resource implements ResourceInterface
{
    /**
     * @var string
     */
    protected $status;

    /**
     * @var object
     */
    protected $data;

    /**
     * @var ConstraintViolationListInterface
     */
    protected $errors;

    /**
     * Constructor.
     *
     * @param object|FormInterface             $data   The data instance or form with data instance
     * @param ConstraintViolationListInterface $errors The list of errors
     */
    public function __construct($data, ConstraintViolationListInterface $errors = null)
    {
        $this->status = ResourceStatutes::PENDING;
        $this->data = $data;
        $this->errors = null !== $errors ? $errors : new ConstraintViolationList();

        $this->validateData($data);
    }

    /**
     * {@inheritdoc}
     */
    public function setStatus($status)
    {
        $this->status = $status;
    }

    /**
     * {@inheritdoc}
     */
    public function getStatus()
    {
        return $this->status;
    }

    /**
     * {@inheritdoc}
     */
    public function getData()
    {
        return $this->data;
    }

    /**
     * {@inheritdoc}
     */
    public function getErrors()
    {
        return $this->errors;
    }

    /**
     * {@inheritdoc}
     */
    public function getFormErrors()
    {
        if ($this->data instanceof FormInterface) {
            return $this->data->getErrors(true);
        }

        throw new InvalidArgumentException('The data of resource is not a form instance, used the "getErrors()" method');
    }

    /**
     * {@inheritdoc}
     */
    public function isForm()
    {
        return $this->getData() instanceof FormInterface;
    }

    /**
     * {@inheritdoc}
     */
    public function isValid()
    {
        $formSuccess = $this->isForm()
            ? 0 === $this->getFormErrors()->count()
            : true;

        return 0 === $this->getErrors()->count() && $formSuccess;
    }

    /**
     * Validate the data.
     *
     * @param mixed $data
     *
     * @throws UnexpectedTypeException When the data or form data is not an instance of object
     */
    protected function validateData($data)
    {
        if ($data instanceof FormInterface) {
            $data = $data->getData();
        }

        if (!is_object($data)) {
            throw new UnexpectedTypeException($data, 'object');
        }
    }
}
