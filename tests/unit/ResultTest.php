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
    private function getRuleMock()
    {
        return $this->createMock(RuleInterface::class);
    }

    private function getResultMocksByQuantity($quantity)
    {
        $results = [];
        for ($index = 0; $index < $quantity; ++$index) {
            $results[] = $this->createMock(ResultInterface::class);
        }

        return $results;
    }

    public function testShouldAcceptStatusInputAndRuleOnConstructor()
    {
        $status = false;
        $input = 'some input';
        $rule = $this->getRuleMock();

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

        $result = new Result(true, 'input', $this->getRuleMock(), $properties);

        $this->assertSame($properties, $result->getProperties());
    }

    public function testShouldAcceptChildrenOnConstructor()
    {
        $children = $this->getResultMocksByQuantity(3);

        $result = new Result(true, 'input', $this->getRuleMock(), [], $children);

        $this->assertSame($children, $result->getChildren());
    }

    /**
     * @expectedException Respect\Validation\Exceptions\ComponentException
     * @expectedExceptionMessage very child of Result must implement ResultInterface
     */
    public function testShouldThrowAnExceptionWhenAChildIsNotAValidInstance()
    {
        $children = $this->getResultMocksByQuantity(2);
        $children[] = 'not an instance of ResultInterface';

        new Result(true, 'input', $this->getRuleMock(), [], $children);
    }

    public function testShouldCreateANewResult()
    {
        $result1 = new Result(true, 'input', $this->getRuleMock());
        $result2 = $result1->with($result1->isValid());

        $this->assertNotSame($result1, $result2);
    }

    public function testShouldCreateANewResultWithADifferentStatus()
    {
        $result1 = new Result(true, 'input', $this->getRuleMock());
        $result2 = $result1->with(false);

        $this->assertNotEquals($result1->isValid(), $result2->isValid());
    }

    public function testShouldCreateANewResultWithOverwrittenProperties()
    {
        $properties1 = ['foo' => 123];
        $properties2 = ['foo' => 456];

        $result1 = new Result(true, 'input', $this->getRuleMock(), $properties1);
        $result2 = $result1->with($result1->isValid(), $properties2);

        $this->assertNotEquals($result1->getProperties(), $result2->getProperties());
    }

    public function testShouldCreateANewResultAndKeepTheDEfinedProperties()
    {
        $properties1 = ['foo' => 123, 'bar' => 42];
        $properties2 = ['foo' => 456];

        $result1 = new Result(true, 'input', $this->getRuleMock(), $properties1);
        $result2 = $result1->with($result1->isValid(), $properties2);

        $this->assertArrayHasKey('bar', $result2->getProperties());
    }

    public function testShouldCreateANewResultAndKeepTheSameInput()
    {
        $result1 = new Result(true, 'input', $this->getRuleMock());
        $result2 = $result1->with($result1->isValid());

        $this->assertSame($result1->getInput(), $result2->getInput());
    }

    public function testShouldCreateANewResultAndKeepTheSameRule()
    {
        $result1 = new Result(true, 'input', $this->getRuleMock());
        $result2 = $result1->with($result1->isValid());

        $this->assertSame($result1->getRule(), $result2->getRule());
    }

    public function testShouldCreateANewResultAndKeepTheSameChildren()
    {
        $children = $this->getResultMocksByQuantity(1);

        $result1 = new Result(true, 'inp', $this->getRuleMock(), [], $children);
        $result2 = $result1->with($result1->isValid());

        $this->assertSame($result1->getChildren(), $result2->getChildren());
    }
}
