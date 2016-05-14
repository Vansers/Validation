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

abstract class AbstractWrapper2 extends AbstractRule
{
    /**
     * @var RuleInterface
     */
    private $rule;

    /**
     * @param RuleInterface $rule
     */
    public function __construct(RuleInterface $rule)
    {
        $this->rule = $rule;
    }

    /**
     * Returns the wrappered rule.
     *
     * @return RuleInterface
     */
    public function getRule()
    {
        return $this->rule;
    }
}
