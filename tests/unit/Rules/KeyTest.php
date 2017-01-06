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
 * @covers Respect\Validation\Rules\Key
 */
final class KeyTest extends RuleTestCase2
{
    /**
     * {@inheritdoc}
     */
    public function providerForValidInput(): array
    {
        return [
            'Present Key' => [new Key('bar'), ['bar' => 'foo']],
            'Present Numeric Key' => [new Key(0), [0 => 'foo']],
            'Empty Key' => [new Key('someEmptyKey'), ['someEmptyKey' => '']],
            'Absent Key When Not Mandatory With Extra Validator' => [
                new Key('bar', $this->createRuleMock(false, ['foo' => '']), false),
                ['foo' => ''],
            ],
            'Present Key With Valid Extra Validator' => [
                new Key('bar', $this->createRuleMock(true, ['bar' => 'something'])),
                ['bar' => 'something'],
            ],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function providerForInvalidInput(): array
    {
        return [
            'Empty Input' => [new Key('someEmptyKey'), ''],
            'Absent Key' => [new Key('bar'), ['baraaaaaa' => 'foo']],
            'Present Key Invalid Key Rule' => [new Key('bar', $this->createRuleMock(false, ['bar' => 42])), ['bar' => 42]],
        ];
    }
}
