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

/**
 * @covers Respect\Validation\Rules\AbstractComposite2
 */
final class AbstractComposite2Test extends \PHPUnit_Framework_TestCase
{
    private function getAbstractComposite2MockWithoutConstructor()
    {
        return $this
            ->getMockBuilder(AbstractComposite2::class)
            ->disableOriginalConstructor()
            ->getMockForAbstractClass();
    }

    public function getRuleMocksByQuantity($quantity)
    {
        $ruleMocks = [];
        for ($index = 0; $index < $quantity; ++$index) {
            $ruleMocks[] = $this->createMock(Rule::class);
        }

        return $ruleMocks;
    }

    public function testShouldHaveNoNestedRulesByDefault()
    {
        $abstractNestedMock = $this->getAbstractComposite2MockWithoutConstructor();

        $this->assertEmpty($abstractNestedMock->getRules());
    }

    public function testShouldBeAbleToAddARule()
    {
        $ruleMock = $this->createMock(Rule::class);

        $abstractNestedMock = $this->getAbstractComposite2MockWithoutConstructor();
        $abstractNestedMock->addRule($ruleMock);

        $expectedRules = [$ruleMock];

        $this->assertSame($expectedRules, $abstractNestedMock->getRules());
    }

    public function testShouldBeAbleToAddRules()
    {
        $rules = $this->getRuleMocksByQuantity(3);

        $abstractNestedMock = $this->getAbstractComposite2MockWithoutConstructor();
        $abstractNestedMock->addRules($rules);

        $this->assertSame($rules, $abstractNestedMock->getRules());
    }

    public function testShouldNotOverwriteWhenAddingRules()
    {
        $rules = $this->getRuleMocksByQuantity(4);
        $rule1 = array_shift($rules);
        list($rule2, $rule3, $rule4) = $rules;

        $abstractNestedMock = $this->getAbstractComposite2MockWithoutConstructor();
        $abstractNestedMock->addRule($rule1);
        $abstractNestedMock->addRules($rules);

        $expectedRules = [$rule1, $rule2, $rule3, $rule4];

        $this->assertSame($expectedRules, $abstractNestedMock->getRules());
    }

    public function testShouldBeAbleToAddRulesOnConstructor()
    {
        $rules = $this->getRuleMocksByQuantity(3);

        $abstractNestedMock = $this
            ->getMockBuilder(AbstractComposite2::class)
            ->setConstructorArgs($rules)
            ->getMockForAbstractClass();

        $this->assertSame($rules, $abstractNestedMock->getRules());
    }
}
