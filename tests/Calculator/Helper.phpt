<?php

namespace RixxiTests\Calculator;

use Nette,
	Tester,
	Tester\Assert;

use Rixxi\Calculator\Helper;

require __DIR__ . '/../bootstrap.php';



class HelperTest extends Tester\TestCase
{

	function getDecimals()
	{
		return array(
			array('1', TRUE),
			array('01', FALSE),

			array('0', TRUE),
			array('0.0', TRUE),
			array('0.00000000', TRUE),
			array('00.00000000', FALSE),

			array('-.1', TRUE),
			array('-0.1', TRUE),
			array('-0.01', TRUE),
			array('-0.10', TRUE),
			array('-0.010', TRUE),
			array('-0', FALSE),
			array('-0.0', FALSE),
		);
	}


	/**
	 * @dataProvider getDecimals
	 */
	function testIsDecimal($value, $expected)
	{
		Assert::same($expected, Helper::isDecimal($value));
	}

}


$test = new HelperTest;
$test->run();
