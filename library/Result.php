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
final class Result
{
    /**
     * @var bool
     */
    private $isValid;

    /**
     * @param bool $isValid
     */
    public function __construct($isValid)
    {
        $this->isValid = $isValid;
    }

    /**
     * @return bool
     */
    public function isValid()
    {
        return $this->isValid;
    }
}
