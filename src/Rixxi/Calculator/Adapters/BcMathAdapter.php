<?php

namespace Rixxi\Calculator\Adapters;

use Rixxi;


class BcMathAdapter implements Rixxi\Calculator\IAdapter
{

	/** @var int */
	private $precision;


	/** @param int */
	public function __construct($precision)
	{
		$this->precision = (int) $precision;
	}


	/**
	 * @param string
	 * @param string
	 * @return string
	 */
	public function add($a, $b)
	{
		return bcadd($a, $b, $this->precision);
	}


	/**
	 * @param string
	 * @param string
	 * @return string
	 */
	public function divide($a, $b)
	{
		return bcdiv($a, $b, $this->precision);
	}


	/**
	 * @param string
	 * @param string
	 * @return string
	 */
	public function multiply($a, $b)
	{
		return bcmul($a, $b, $this->precision);
	}


	/**
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
	 * @return string
	 */
	public function pack($value)
	{
		if (!is_numeric($value)) {
			throw new \InvalidArgumentException('BcMathCalculator only supports conversion from numeric value.');
		}

		return is_float($value) ? number_format($value, $this->precision, '.', '') : (string) $value;
	}


	/**
	 * @param string
	 * @return string
	 */
	public function unpack($value)
	{
		if (!is_string($value)) {
			throw new \InvalidArgumentException('BcMathCalculator only supports conversion from string to string.');
		}

		return $value;
	}

}
