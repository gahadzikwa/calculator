<?php

namespace RixxiTests\Calculator\Adapters;

use Nette,
	Tester,
	Tester\Assert;
use Rixxi\Calculator\Adapters\BcMathAdapter;
use Rixxi\Calculator\Calculator;
use Rixxi\Calculator\Helper;


require __DIR__ . '/../../bootstrap.php';



class BcMathAdapterTest extends Tester\TestCase
{

	function getPack()
	{
		return array(
			array(1000000, 0, '1000000'),
			array('10.000000001', 9, '10.000000001'),
			array('0.000000001', 9, '0.000000001'),
			array('.000000001', 9, '.000000001'),
			array('10.000000001', 8, '10.00000000'),
			array('0.000000001', 8, '0.00000000'),
			array('.000000001', 8, '.00000000'),
			array('0.001', 2, '0.00'),
			array('.001', 2, '.00'),
			array('.1', 1, '.1'),
			array('10.01', 0, '10'),
			array('0.01', 0, '0'),
			array('.01', 0, '0'),
			array('10.1', 0, '10'),
			array('0.1', 0, '0'),
			array('.1', 0, '0'),
		);
	}


	/**
	 * @dataProvider getPack
	 */
	function testPack($value, $precision, $expected)
	{
		$adapter = new BcMathAdapter($precision);
		Assert::true(Helper::isDecimal($value));
		Assert::same($expected, $adapter->pack($value));
	}


	function getUnpack()
	{
		return array(
			array('0.00000000', 8, '0'),
		);
	}


	/**
	 * @dataProvider getUnpack
	 */
	function testUnpack($value, $precision, $expected)
	{
		$adapter = new BcMathAdapter($precision);
		Assert::same($expected, $adapter->unpack($value));
	}

}


$test = new BcMathAdapterTest;
$test->run();
