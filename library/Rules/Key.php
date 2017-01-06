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

final class Key extends AbstractRelated
{
    /**
     * {@inheritdoc}
     */
    protected function getReferenceValue($input, string $reference)
    {
        return $input[$reference];
    }

    /**
     * {@inheritdoc}
     */
    protected function hasReference($input, string $reference): bool
    {
        if (is_array($input)) {
            return array_key_exists($reference, $input);
        }

        return isset($input[$reference]);
    }
}
