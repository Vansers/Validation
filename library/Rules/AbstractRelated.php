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

use Respect\Validation\Result;
use Respect\Validation\Rule;
use Respect\Validation\StandardResult;

abstract class AbstractRelated implements Rule
{
    /**
     * @var string
     */
    private $reference;

    /**
     * @var Rule|null
     */
    private $rule;

    /**
     * @var bool
     */
    private $mandatory = true;

    public function __construct(string $reference, Rule $rule = null, bool $mandatory = true)
    {
        $this->reference = $reference;
        $this->rule = $rule;
        $this->mandatory = $mandatory;
    }

    /**
     * @param string $input
     *
     * @return bool
     */
    abstract protected function hasReference($input, string $reference): bool;

    /**
     * @param string $input
     *
     * @return mixed
     */
    abstract protected function getReferenceValue($input, string $reference);

    /**
     * {@inheritdoc}
     */
    public function validate($input): Result
    {
        $properties = ['reference' => $this->reference, 'mandatory' => $this->mandatory];

        if (!$this->hasReference($input, $this->reference)) {
            return new StandardResult(!$this->mandatory, $input, $this, $properties);
        }

        if ($this->rule === null) {
            return new StandardResult(true, $input, $this, $properties);
        }

        $referenceValue = $this->getReferenceValue($input, $this->reference);
        $referenceValueResult = $this->rule->validate($referenceValue);

        return new StandardResult($referenceValueResult->isValid(), $input, $this, $properties, $referenceValueResult);
    }
}
