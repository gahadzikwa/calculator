<?php

namespace Rixxi\Calculator;


interface Exception
{

}


class RuntimeException extends \RuntimeException implements Exception
{

}


class InvalidStateException extends \RuntimeException implements Exception
{

}


class InvalidArgumentException extends \InvalidArgumentException implements Exception
{

}


class SingletonException extends \RuntimeException implements Exception
{

}


class UnsupportedException extends \RuntimeException implements Exception
{

}