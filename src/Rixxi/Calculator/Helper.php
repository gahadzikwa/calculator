<?php

namespace Rixxi\Calculator;


class Helper
{

	const DECIMAL_REGEX = '/^-?([1-9][0-9]*|0|\.[0-9]+)(\.[0-9]*)?$/D';

	/**
	 * @param  string
	 * @return bool
	 */
	public static function isDecimal($value)
	{
		return preg_match(self::DECIMAL_REGEX, $value) === 1;
	}

}
