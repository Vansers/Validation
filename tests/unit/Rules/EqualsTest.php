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

use stdClass;

/**
 * @group  rule
 * @covers Respect\Validation\Rules\Equals
 */
class EqualsTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @dataProvider providerForEquals
     */
    public function testInputEqualsToExpectedValueShouldPass($compareTo, $input)
    {
        $rule = new Equals($compareTo);
        $result = $rule->validate($input);

        $this->assertTrue($result->isValid());
    }

    /**
     * @dataProvider providerForNotEquals
     */
    public function testInputNotEqualsToExpectedValueShouldPass($compareTo, $input)
    {
        $rule = new Equals($compareTo);
        $result = $rule->validate($input);

        $this->assertFalse($result->isValid());
    }

    public function providerForEquals()
    {
        return [
            ['foo', 'foo'],
            [[], []],
            [new stdClass(), new stdClass()],
            [10, '10'],
        ];
    }

    public function providerForNotEquals()
    {
        return [
            ['foo', ''],
            ['foo', 'bar'],
        ];
    }
}
