<?php

namespace Rixxi\Calculator;

use Nette;
use Rixxi;


class Helper extends Nette\Object
{

	public static function isDecimal($value)
	{
		return is_int($value) || is_float($value) || preg_match('');
	}

}
