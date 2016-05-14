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

final class AbstractWrapper2Test extends \PHPUnit_Framework_TestCase
{
    public function testShouldAcceptRuleOnConstructor()
    {
        $ruleMock = $this->createMock(RuleInterface::class);

        $abstractWrapper = $this
            ->getMockBuilder(AbstractWrapper2::class)
            ->setConstructorArgs([$ruleMock])
            ->getMockForAbstractClass();

        $this->assertSame($ruleMock, $abstractWrapper->getRule());
    }
}
