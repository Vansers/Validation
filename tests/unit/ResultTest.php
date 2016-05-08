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
 * @covers Respect\Validation\Result
 */
class ResultTest extends \PHPUnit_Framework_TestCase
{
    public function testShouldAcceptStatusOnConstructor()
    {
        $status = false;

        $result = new Result($status);

        $this->assertSame($status, $result->isValid());
    }
}
