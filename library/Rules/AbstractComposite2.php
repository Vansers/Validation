<?php

/*
 * This file is part of Respect/Validation.
 *
 * (c) Alexandre Gomes Gaigalas <alexandre@gaigalas.net>
 *
 * For the full copyright and license information, please view the "LICENSE.md"
 * file that was distributed with this source code.
 */

namespace Respect\Validation\Rules;

/**
 * Abstract class to handle nested rules.
 */
abstract class AbstractComposite2 implements RuleInterface
{
    /**
     * @var RuleInterface[]
     */
    private $rules = [];

    /**
     * @param RuleInterface ...$rules
     */
    public function __construct(RuleInterface ...$rules)
    {
        $this->addRules($rules);
    }

    /**
     * @return RuleInterface[]
     */
    public function getRules()
    {
        return $this->rules;
    }

    /**
     * @param RuleInterface $rule
     */
    public function addRule(RuleInterface $rule)
    {
        $this->rules[] = $rule;
    }

    /**
     * @param RuleInterface[] $rules
     */
    public function addRules(array $rules)
    {
        foreach ($rules as $rule) {
            $this->addRule($rule);
        }

        return $this;
    }
}
