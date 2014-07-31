<?php

namespace RixxiTests\Calculator;

use Nette,
	Tester,
	Tester\Assert;
use Rixxi\Calculator\Calculator;

require __DIR__ . '/../bootstrap.php';


class CalculatorTest extends Tester\TestCase
{

	function getMinMax()
	{
		return array(
			array('min', 2, array('.001', '0'), '0'),
			array('max', 2, array('.001', '0'), '0'),
			array('min', 2, array('0', '.001'), '0'),
			array('max', 2, array('0', '.001'), '0'),
			array('min', 2, array('.001', '0.01'), '0'),
			array('max', 2, array('.001', '0.01'), '0.01'),
			array('min', 2, array('0.01', '.001'), '0'),
			array('max', 2, array('0.01', '.001'), '0.01'),
			array('min', 2, array('0.02', '0.01', '.001'), '0'),
			array('max', 2, array('0.01', '0.02', '.001'), '0.02'),
			array('min', 2, array('0.001', '0.01', '.02'), '0'),
			array('max', 2, array('0.02', '0.01', '.001'), '0.02'),
		);
	}


	/**
	 * @dataProvider getMinMax
	 */
	function testMinMax($function, $precision, $arguments, $expected)
	{
		$calculator = new Calculator($precision);
		Assert::same($expected, call_user_func_array(array($calculator, $function), $arguments));
	}
}


$test = new CalculatorTest;
$test->run();
