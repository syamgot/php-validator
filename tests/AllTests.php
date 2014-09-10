<?php

//require_once 'PHPUnit/Framework/TestSuite.php';
require_once __DIR__.'/autoload.php';

class AllTests {
	
	public static function suite() {

		$suite = new PHPUnit_Framework_TestSuite();

		foreach (self::$tests as $value)
		{
			require_once $value.'.php';
			$suite->addTestSuite($value);
		}
		
		return $suite;
	}

	protected static $tests = array(
		  'ValidatorTest'
		, 'AlumValidatorTest'
		, 'DataTypeValidatorTest'
		, 'GEValidatorTest'
		, 'GTValidatorTest'
		, 'LEValidatorTest'
		, 'LTValidatorTest'
		, 'NotEmptyValidatorTest'
		, 'NotNullValidatorTest'
		, 'RegularExpressionValidatorTest'
		, 'StrLengthValidatorTest'
		, 'ValidatorTemplatesTest'
	);
}
