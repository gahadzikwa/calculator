<?php

namespace Rixxi\Calculator;


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
		return $this->calculator->multiply($this->calculator->getDecimal($value), 100);
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

}
