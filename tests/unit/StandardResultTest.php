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
 * @covers Respect\Validation\StandardResult
 */
final class StandardResultTest extends \PHPUnit_Framework_TestCase
{
    private function getRuleMock()
    {
        return $this->createMock(Rule::class);
    }

    private function getResultMocksByQuantity($quantity)
    {
        $results = [];
        for ($index = 0; $index < $quantity; ++$index) {
            $results[] = $this->createMock(Result::class);
        }

        return $results;
    }

    public function testShouldAcceptStatusInputAndRuleOnConstructor()
    {
        $status = false;
        $input = 'some input';
        $rule = $this->getRuleMock();

        $result = new StandardResult($status, $input, $rule);

        $this->assertSame($status, $result->isValid());
        $this->assertSame($input, $result->getInput());
        $this->assertSame($rule, $result->getRule());
    }

    public function testShouldAcceptPropertiesOnConstructor()
    {
        $properties = [
            'foo' => new \stdClass(),
        ];

        $result = new StandardResult(true, 'input', $this->getRuleMock(), $properties);

        $this->assertSame($properties, $result->getProperties());
    }

    public function testShouldAcceptChildrenOnConstructor()
    {
        $children = $this->getResultMocksByQuantity(3);

        $result = new StandardResult(true, 'input', $this->getRuleMock(), [], ...$children);

        $this->assertSame($children, $result->getChildren());
    }

    public function testShouldCreateANewResult()
    {
        $result1 = new StandardResult(true, 'input', $this->getRuleMock());
        $result2 = $result1->with($result1->isValid());

        $this->assertNotSame($result1, $result2);
    }

    public function testShouldCreateANewResultWithADifferentStatus()
    {
        $result1 = new StandardResult(true, 'input', $this->getRuleMock());
        $result2 = $result1->with(false);

        $this->assertNotEquals($result1->isValid(), $result2->isValid());
    }

    public function testShouldCreateANewResultWithOverwrittenProperties()
    {
        $properties1 = ['foo' => 123];
        $properties2 = ['foo' => 456];

        $result1 = new StandardResult(true, 'input', $this->getRuleMock(), $properties1);
        $result2 = $result1->with($result1->isValid(), $properties2);

        $this->assertNotEquals($result1->getProperties(), $result2->getProperties());
    }

    public function testShouldCreateANewResultAndKeepTheDEfinedProperties()
    {
        $properties1 = ['foo' => 123, 'bar' => 42];
        $properties2 = ['foo' => 456];

        $result1 = new StandardResult(true, 'input', $this->getRuleMock(), $properties1);
        $result2 = $result1->with($result1->isValid(), $properties2);

        $this->assertArrayHasKey('bar', $result2->getProperties());
    }

    public function testShouldCreateANewResultAndKeepTheSameInput()
    {
        $result1 = new StandardResult(true, 'input', $this->getRuleMock());
        $result2 = $result1->with($result1->isValid());

        $this->assertSame($result1->getInput(), $result2->getInput());
    }

    public function testShouldCreateANewResultAndKeepTheSameRule()
    {
        $result1 = new StandardResult(true, 'input', $this->getRuleMock());
        $result2 = $result1->with($result1->isValid());

        $this->assertSame($result1->getRule(), $result2->getRule());
    }

    public function testShouldCreateANewResultAndKeepTheSameChildren()
    {
        $children = $this->getResultMocksByQuantity(1);

        $result1 = new StandardResult(true, 'inp', $this->getRuleMock(), [], ...$children);
        $result2 = $result1->with($result1->isValid());

        $this->assertSame($result1->getChildren(), $result2->getChildren());
    }
}
