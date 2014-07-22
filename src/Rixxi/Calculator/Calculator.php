<?php

namespace Rixxi\Calculator;

use Kdyby\Money\Money;


/**
 * @method mixed add(mixed $a, mixed $b)
 * @method mixed subtract(mixed $a, mixed $b)
 * @method mixed multiply(mixed $a, mixed $b)
 * @method mixed divide(mixed $a, mixed $b)
 */
class Calculator
{

	const DEFAULT_PRECISION = 8;

	const DECIMAL_SEPARATOR = '.';

	/** @var string[] */
	private $operations = array(
		'add',
		'subtract',
		'multiply',
		'divide',
	);

	/** @var IAdapter */
	private $adapter;


	/**
	 * @param IAdapter|int Adapter instance or precision
	 */
	public function __construct($adapter = NULL)
	{
		$this->adapter = $adapter === NULL || is_numeric($adapter) ? $this->createAdapter($adapter ?: self::DEFAULT_PRECISION) : $adapter;
	}


	public function __call($name, $arguments)
	{
		if (in_array($name, $this->operations, TRUE)) {
			return $this->convertToResult(call_user_func_array(array($this->adapter, $name), $this->convertArguments($arguments)));

		} else {
			throw new UnsupportedException("Method $name is not supported.");
		}
	}


	/**
	 * @param  mixed
	 * @return string
	 */
	public function getDecimal($value)
	{
		if ($value instanceof IDecimal) {
			return $value->toDecimal();

		} elseif ($value instanceof Money) {
			return $value->toDecimal();

		} elseif (is_int($value) || is_float($value) || is_string($value) && Helper::isDecimal($value)) {
			return $value;

		} else {
			throw new InvalidArgumentException(is_object($value) ? "Value " . get_class($value) . " is not instance of Rixxi\\Calculator\\IDecimal or supported decimal." : "Value '$value' is not valid decimal number.");
		}
	}


	/**
	 * Convert value from adapters internal format
	 *
	 * @param  mixed
	 * @return mixed
	 */
	protected function convertToResult($value)
	{
		return $this->adapter->unpack($value);
	}


	/**
	 * Converts arguments to adapters internal format
	 *
	 * @param  mixed[]
	 * @return mixed[]
	 */
	protected function convertArguments($arguments)
	{
		$converted = array();
		foreach ($arguments as $argument) {
			$converted[] = $this->adapter->pack($this->getDecimal($argument));
		}
		return $converted;
	}


	/** @return IAdapter */
	private function createAdapter($precision)
	{
		if (extension_loaded('bcmath')) {
			return new Adapters\BcMathAdapter($precision);

		} else {
			throw new RuntimeException("BcMath extension must be enabled.");
		}
	}

}
