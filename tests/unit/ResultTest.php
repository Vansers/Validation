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
 * @covers Respect\Validation\Result
 */
final class ResultTest extends \PHPUnit_Framework_TestCase
{
    public function testShouldAcceptStatusInputAndRuleOnConstructor()
    {
        $status = false;
        $input = 'some input';
        $rule = $this->getMock(RuleInterface::class);

        $result = new Result($status, $input, $rule);

        $this->assertSame($status, $result->isValid());
        $this->assertSame($input, $result->getInput());
        $this->assertSame($rule, $result->getRule());
    }

    public function testShouldAcceptPropertiesOnConstructor()
    {
        $properties = [
            'foo' => new \stdClass(),
        ];

        $result = new Result(true, 'input', $this->getMock(RuleInterface::class), $properties);

        $this->assertSame($properties, $result->getProperties());
    }

    public function testShouldAcceptChildrenOnConstructor()
    {
        $children = [
            $this->getMock(ResultInterface::class),
            $this->getMock(ResultInterface::class),
            $this->getMock(ResultInterface::class),
        ];

        $result = new Result(true, 'input', $this->getMock(RuleInterface::class), [], $children);

        $this->assertSame($children, $result->getChildren());
    }

    /**
     * @expectedException Respect\Validation\Exceptions\ComponentException
     * @expectedExceptionMessage very child of Result must implement ResultInterface
     */
    public function testShouldThrowAnExceptionWhenAChildIsNotAValidInstance()
    {
        $children = [
            $this->getMock(ResultInterface::class),
            $this->getMock(ResultInterface::class),
            'not an instance of ResultInterface',
        ];

        new Result(true, 'input', $this->getMock(RuleInterface::class), [], $children);
    }
}
