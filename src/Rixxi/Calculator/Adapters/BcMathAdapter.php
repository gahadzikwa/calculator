<?php

namespace Rixxi\Calculator\Adapters;

use Rixxi;
use Rixxi\Calculator\Calculator;
use Rixxi\Calculator\InvalidArgumentException;


class BcMathAdapter implements Rixxi\Calculator\IAdapter
{

	/** @var int */
	private $precision;


	/** @inheritdoc */
	public function __construct($precision)
	{
		$this->precision = (int) $precision;
	}


	/**
	 * @inheritdoc
	 * @param string
	 * @param string
	 * @return string
	 */
	public function add($a, $b)
	{
		return bcadd($a, $b, $this->precision);
	}


	/**
	 * @inheritdoc
	 * @param string
	 * @param string
	 * @return string
	 */
	public function divide($a, $b)
	{
		return bcdiv($a, $b, $this->precision);
	}


	/**
	 * @inheritdoc
	 * @param string
	 * @param string
	 * @return string
	 */
	public function multiply($a, $b)
	{
		return bcmul($a, $b, $this->precision);
	}


	/**
	 * @inheritdoc
	 * @param string
	 * @param string
	 * @return string
	 */
	public function subtract($a, $b)
	{
		return bcsub($a, $b, $this->precision);
	}


	/**
	 * @inheritdoc
	 * @param  mixed
	 * @return string
	 */
	public function pack($value)
	{
		if (!is_numeric($value)) {
			throw new InvalidArgumentException('BcMathCalculator only supports conversion from numeric value.');
		}

		return is_float($value) ? number_format($value, $this->precision, Calculator::DECIMAL_SEPARATOR, '') : (string) $value;
	}


	/**
	 * @inheritdoc
	 * @param  string
	 * @return mixed
	 */
	public function unpack($value)
	{
		if (!is_string($value)) {
			throw new InvalidArgumentException('BcMathCalculator only supports conversion from string to string.');
		}

		if (($pos = strpos($value, Calculator::DECIMAL_SEPARATOR)) !== FALSE) {
			$value = rtrim(rtrim($value, '0'), '.');
		}

		return $value;
	}

}
