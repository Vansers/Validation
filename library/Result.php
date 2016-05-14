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

use Respect\Validation\Exceptions\ComponentException;
use Respect\Validation\Rules\RuleInterface;

/**
 * Class to handle validation.
 *
 * @author Henrique Moody <henriquemoody@gmail.com>
 */
final class Result implements ResultInterface
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
     * @var RuleInterface
     */
    private $rule;

    /**
     * @var RuleInterface[]
     */
    private $children;

    /**
     * @var array
     */
    private $properties;

    /**
     * @param bool            $isValid
     * @param mixed           $input
     * @param RuleInterface   $rule
     * @param array           $properties
     * @param RuleInterface[] $children
     */
    public function __construct($isValid, $input, RuleInterface $rule, array $properties = [], array $children = [])
    {
        $this->checkChildrenInstance($children);

        $this->isValid = $isValid;
        $this->input = $input;
        $this->rule = $rule;
        $this->properties = $properties;
        $this->children = $children;
    }

    /**
     * @param ResultInterface[] $children
     */
    private function checkChildrenInstance(array $children)
    {
        foreach ($children as $child) {
            if ($child instanceof ResultInterface) {
                continue;
            }

            throw new ComponentException('Every child of Result must implement ResultInterface');
        }
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
            $this->getChildren()
        );
    }
}
