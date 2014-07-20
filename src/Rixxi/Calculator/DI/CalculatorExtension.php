<?php

namespace Rixxi\Calculator\DI;

use Nette;
use Nette\Utils\Validators;
use Rixxi\Calculator\Calculator;


class CalculatorExtension extends Nette\DI\CompilerExtension
{

	public $defaults = [
		'precision' => 8,
	];


	public function loadConfiguration()
	{
		$config = $this->getConfig($this->defaults);
		Validators::assert($config['precision'], 'int:0..');

		$builder = $this->getContainerBuilder();

		$builder->addDefinition($this->prefix('calculator'))
			->setClass(Calculator::class, array($config['precision']));
	}

}
