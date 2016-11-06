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

abstract class RuleTestCase2 extends \PHPUnit_Framework_TestCase
{
    /**
     * @return array
     */
    abstract public function providerForValidInput(): array;

    /**
     * @return array
     */
    abstract public function providerForInvalidInput(): array;

    /**
     * @return array
     */
    public function providerForAllInput(): array
    {
        return array_merge(
            $this->providerForValidInput(),
            $this->providerForInvalidInput()
        );
    }

    /**
     * @test
     *
     * @dataProvider providerForValidInput
     *
     * @param Rule  $rule
     * @param mixed $input
     */
    public function shouldValidateValidInput(Rule $rule, $input)
    {
        $result = $rule->validate($input);

        $this->assertTrue($result->isValid());
    }

    /**
     * @test
     *
     * @dataProvider providerForInvalidInput
     *
     * @param Rule  $rule
     * @param mixed $input
     */
    public function shouldValidateInvalidInput(Rule $rule, $input)
    {
        $result = $rule->validate($input);

        $this->assertFalse($result->isValid());
    }

    /**
     * @test
     *
     * @dataProvider providerForAllInput
     *
     * @param Rule  $rule
     * @param mixed $input
     */
    public function shouldReturnTheSameInputOnResult(Rule $rule, $input)
    {
        $result = $rule->validate($input);

        $this->assertSame($input, $result->getInput());
    }

    /**
     * @test
     *
     * @dataProvider providerForAllInput
     *
     * @param Rule  $rule
     * @param mixed $input
     */
    public function shouldReturnTheSameRuleOnResult(Rule $rule, $input)
    {
        $result = $rule->validate($input);

        $this->assertSame($rule, $result->getRule());
    }
}
