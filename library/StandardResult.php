<?php

/*
 * This file is part of Respect/Validation.
 *
 * (c) Alexandre Gomes Gaigalas <alexandre@gaigalas.net>
 *
 * For the full copyright and license information, please view the "LICENSE.md"
 * file that was distributed with this source code.
 */

namespace Respect\Validation;

/**
 * Class to handle validation.
 *
 * @author Henrique Moody <henriquemoody@gmail.com>
 */
final class StandardResult implements Result
{
    /**
     * @var bool
     */
    private $isValid;

    /**
     * @var mixed
     */
    private $input;

    /**
     * @var Rule
     */
    private $rule;

    /**
     * @var Rule[]
     */
    private $children;

    /**
     * @var array
     */
    private $properties;

    /**
     * @param bool   $isValid
     * @param mixed  $input
     * @param Rule   $rule
     * @param array  $properties
     * @param Result $children...
     */
    public function __construct($isValid, $input, Rule $rule, array $properties = [], Result ...$children)
    {
        $this->isValid = $isValid;
        $this->input = $input;
        $this->rule = $rule;
        $this->properties = $properties;
        $this->children = $children;
    }

    /**
     * {@inheritdoc}
     */
    public function isValid()
    {
        return $this->isValid;
    }

    /**
     * {@inheritdoc}
     */
    public function getInput()
    {
        return $this->input;
    }

    /**
     * {@inheritdoc}
     */
    public function getRule()
    {
        return $this->rule;
    }

    /**
     * {@inheritdoc}
     */
    public function getChildren()
    {
        return $this->children;
    }

    /**
     * {@inheritdoc}
     */
    public function getProperties()
    {
        return $this->properties;
    }

    /**
     * {@inheritdoc}
     */
    public function with($isValid, array $properties = [])
    {
        return new self(
            $isValid,
            $this->getInput(),
            $this->getRule(),
            $properties + $this->getProperties(),
            ...$this->getChildren()
        );
    }
}
