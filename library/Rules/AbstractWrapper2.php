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

abstract class AbstractWrapper2 extends AbstractRule
{
    /**
     * @var Rule
     */
    private $rule;

    /**
     * @param Rule $rule
     */
    public function __construct(Rule $rule)
    {
        $this->rule = $rule;
    }

    /**
     * Returns the wrappered rule.
     *
     * @return Rule
     */
    public function getRule(): Rule
    {
        return $this->rule;
    }
}
