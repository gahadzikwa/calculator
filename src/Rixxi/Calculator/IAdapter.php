<?php

namespace Rixxi\Calculator;


interface IAdapter
{

	/** @param  int */
	function __construct($precision);

	/**
	 * @param  mixed
	 * @param  mixed
	 * @return mixed
	 */
	function add($a, $b);

	/**
	 * @param  mixed
	 * @param  mixed
	 * @return mixed
	 */
	function divide($a, $b);

	/**
	 * @param  mixed
	 * @param  mixed
	 * @return mixed
	 */
	function subtract($a, $b);

	/**
	 * @param  mixed
	 * @param  mixed
	 * @return mixed
	 */
	function multiply($a, $b);

	/**
	 * @param  mixed
	 * @param  mixed
	 * @return int 0 if the two operands are equal, 1 if the left operand is larger than the right operand, -1 otherwise.
	 */
	function compare($a, $b);

	/**
	 * Converts value to internal representation used for computations
	 *
	 * @param  float|string|int
	 * @return mixed
	 * @throws InvalidArgumentException
	 */
	function pack($value);

	/**
	 * Converts value from internal representation to scalar value
	 *
	 * @param  mixed
	 * @return float|string|int
	 * @throws InvalidArgumentException
	 */
	function unpack($value);

}
