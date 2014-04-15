<?php

namespace Rixxi\Calculator;

use Kdyby;


class TemplateHelper
{

    /** @var Calculator */
    private $calculator;


    public function __construct(Calculator $calculator)
    {
        $this->calculator = $calculator;
    }


	public function percent($value)
	{
		return $this->calculator->multiply($this->parseDecimal($value), 100);
	}


	public function trimZeroDecimals($value)
	{
		if (strpos($value, '.') === FALSE) {
			return $value;
		}
		list($number, $decimals) = explode('.', $value);
		$decimals = rtrim($decimals, '0');
		return $decimals === '' ? $number : $number . '.' . $decimals;
	}


	private function parseDecimal($value)
	{
		if ($value instanceof IDecimal) {
			return $value->toDecimal();

		} elseif (Helper::isDecimal($value)) {
			return $value;

		} else {
			throw new \Exception('Value must be int, float or well formed bigint (string).');
		}
	}

}
