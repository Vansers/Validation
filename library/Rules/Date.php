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

use DateTimeInterface;
use Respect\Validation\Result;
use Respect\Validation\Rule;
use Respect\Validation\StandardResult;

/**
 * @author Alexandre Gomes Gaigalas <alexandre@gaigalas.net>
 */
final class Date implements Rule
{
    /**
     * @var string
     */
    private $format;

    public function __construct(string $format = null)
    {
        $exceptionalFormats = [
            'c' => 'Y-m-d\TH:i:sP',
            'r' => 'D, d M Y H:i:s O',
        ];

        if (isset($exceptionalFormats[$format])) {
            $format = $exceptionalFormats[$format];
        }

        $this->format = $format;
    }

    /**
     * {@inheritdoc}
     */
    public function validate($input): Result
    {
        if ($input instanceof DateTimeInterface) {
            return new StandardResult($this->format === null, $input, $this, array_filter(['format' => $this->format]));
        }

        $scalarValResult = (new ScalarVal())->validate($input);
        if (!$scalarValResult->isValid()) {
            return new StandardResult(false, $input, $this, [], $scalarValResult);
        }

        if ($this->format === null) {
            return $this->validateWithoutFormat($input);
        }

        return $this->validateWithFormat($input, $this->format);
    }

    private function validateWithoutFormat($input): Result
    {
        return new StandardResult(false !== strtotime($input), $input, $this);
    }

    private function validateWithFormat($input, string $format): Result
    {
        $info = date_parse_from_format($format, $input);
        $isValid = $info['error_count'] === 0 && $info['warning_count'] === 0;

        return new StandardResult($isValid, $input, $this, ['format' => $format]);
    }
}
