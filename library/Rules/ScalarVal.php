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
use Respect\Validation\StandardResult;

/**
 * @author Henrique Moody <henriquemoody@gmail.com>
 */
final class ScalarVal implements Rule
{
    /**
     * {@inheritdoc}
     */
    public function validate($input)
    {
        return new StandardResult(is_scalar($input), $input, $this);
    }
}
