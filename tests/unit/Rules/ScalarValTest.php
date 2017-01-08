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
 * @group  rule
 * @covers Respect\Validation\Rules\ScalarVal
 */
final class ScalarValTest extends RuleTestCase2
{
    /**
     * {@inheritdoc}
     */
    public function providerForValidInput()
    {
        $rule = new ScalarVal();

        return [
            [$rule, '6'],
            [$rule, 'String'],
            [$rule, 1.0],
            [$rule, 42],
            [$rule, false],
            [$rule, true],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function providerForInvalidInput()
    {
        $rule = new ScalarVal();

        return [
            [$rule, []],
            [$rule, function () {
            }],
            [$rule, new \stdClass()],
            [$rule, null],
            [$rule, tmpfile()],
        ];
    }
}
