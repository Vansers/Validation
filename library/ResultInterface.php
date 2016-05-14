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

use Respect\Validation\Rules\RuleInterface;

/**
 * Interface for results.
 *
 * @author Henrique Moody <henriquemoody@gmail.com>
 */
interface ResultInterface
{
    /**
     * Returns whether the result is valid or not.
     *
     * @return bool
     */
    public function isValid();

    /**
     * Returns the input that was used on the validation.
     *
     * @return mixed
     */
    public function getInput();

    /**
     * Returns the rule that was used on the validation.
     *
     * @return RuleInterface
     */
    public function getRule();

    /**
     * Returns the children of the result.
     *
     * Most results don't have children, then they will just return an empty array.
     *
     * @return RuleInterface[]
     */
    public function getChildren();

    /**
     * Returns some properties to give more information about the validation that was made.
     *
     * Results may or may not have properties.
     *
     * @return array
     */
    public function getProperties();
}
