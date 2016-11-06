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

use Respect\Validation\Result;
use Respect\Validation\Rule;
use Respect\Validation\StandardResult;

/**
 * Validates if the input is equal to some value.
 *
 * @author Alexandre Gomes Gaigalas <alexandre@gaigalas.net>
 */
final class Equals implements Rule
{
    /**
     * @var mixed
     */
    private $compareTo;

    /**
     * @param mixed $compareTo
     */
    public function __construct($compareTo)
    {
        $this->compareTo = $compareTo;
    }

    /**
     * {@inheritdoc}
     */
    public function validate($input): Result
    {
        return new StandardResult(($input == $this->compareTo), $input, $this, ['compareTo' => $this->compareTo]);
    }
}
