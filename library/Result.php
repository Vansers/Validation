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
 * Interface for results.
 *
 * @author Henrique Moody <henriquemoody@gmail.com>
 */
interface Result
{
    /**
     * Returns whether the result is valid or not.
     *
     * @return bool
     */
    public function isValid(): bool;

    /**
     * Returns the input that was used on the validation.
     *
     * @return mixed
     */
    public function getInput();

    /**
     * Returns the rule that was used on the validation.
     *
     * @return Rule
     */
    public function getRule(): Rule;

    /**
     * Returns the children of the result.
     *
     * Most results don't have children, then they will just return an empty array.
     *
     * @return Rule[]
     */
    public function getChildren(): array;

    /**
     * Returns some properties to give more information about the validation that was made.
     *
     * Results may or may not have properties.
     *
     * @return array
     */
    public function getProperties(): array;

    /**
     * Creates a new result, changing its validation status and properties.
     *
     * @param bool  $isValid
     * @param array $properties
     *
     * @return Result
     */
    public function with($isValid, array $properties = []): Result;
}
