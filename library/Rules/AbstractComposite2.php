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

use Respect\Validation\Rule;

/**
 * Abstract class to handle nested rules.
 */
abstract class AbstractComposite2 implements Rule
{
    /**
     * @var Rule[]
     */
    private $rules = [];

    /**
     * @param Rule ...$rules
     */
    public function __construct(Rule ...$rules)
    {
        $this->addRules($rules);
    }

    /**
     * @return Rule[]
     */
    public function getRules()
    {
        return $this->rules;
    }

    /**
     * @param Rule $rule
     */
    public function addRule(Rule $rule)
    {
        $this->rules[] = $rule;
    }

    /**
     * @param Rule[] $rules
     */
    public function addRules(array $rules)
    {
        foreach ($rules as $rule) {
            $this->addRule($rule);
        }

        return $this;
    }
}
