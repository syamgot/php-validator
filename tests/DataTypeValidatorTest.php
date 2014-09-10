<?php

require_once __DIR__ . '/../src/syamgot/validator/DataTypeValidator.php';

use syamgot\validator\DataTypeValidator;

/**
 * DataTypeValidator unit test
 * 
 * @author syamgot
 */
class DataTypeValidatorTest extends PHPUnit_Framework_TestCase {
	
	/** **************************************************
	*
	* Tests
	*
	************************************************** */
    
	/**
	 * 
	 * Enter description here ...
	 */
	public function testException() {
		try {
			self::$obj->setDataType('');
		}
		catch (Exception $expected) {
			return;
		}
		$this->fail();
	}

	/**
	 * 
	 * Enter description here ...
	 * @dataProvider providerSetDataType
	 * @depends testException
	 */
	public function testSetDataType($dataType) {
		self::$obj->setDataType($dataType);
	}
	
	/**
	 * 
	 * Enter description here ...
	 * @dataProvider providerIsValid
	 * @depends  testSetDataType
	 */
	public function testIsValid($dataType, $val, $res) {
		self::$obj->setDataType($dataType);
		$this->assertEquals(self::$obj->isValid($val), $res);
	}
	

	/** **************************************************
	*
	* setup and teardown
	*
	************************************************** */
	
	/**
	 * 
	 */	
	public static function setUpBeforeClass() {
		self::$obj = new DataTypeValidator();
	}
	
	/**
	 * 
	 */
	protected function setUp() {}
	
	/**
	 * 
	 */
	protected function tearDown() {}
	
	/**
	 * 
	 */
	public static function tearDownAfterClass() {}
	
	
	/** **************************************************
	*
	* Static Methods
	*
	************************************************** */
	
	/**
	 * @var DataTypeValidator
	 */
	protected static $obj;
	
	
	/** **************************************************
	 * 
	 * Data Providers
	 * 
	 ************************************************** */
	
	/**
	 * 
	 */
	public function providerSetDataType() {
		return array(
			  array('int')
			, array('integer')
			, array('float')
			, array('string')
			, array('array')
			, array('bool')
			, array('null')
		);
	}
	
    /**
     * 
     */
    public function providerIsValid() {
    	return array(
    		  array('int', 		0, 				true)
    		, array('int', 		'hoge', 		false)
    		, array('int', 		100.01, 		false)
    		, array('int', 		array('hoge'), 	false)
    		, array('int', 		true, 			false)
    		, array('int', 		null, 			false)
    	
    		, array('string', 	0, 				false)
    		, array('string', 	'hoge', 		true)
    		, array('string', 	100.01, 		false)
    		, array('string', 	array('hoge'), 	false)
    		, array('string', 	true, 			false)
    		, array('string', 	null, 			false)
    		
	    	, array('float', 	0, 				false)
	    	, array('float', 	'hoge', 		false)
	    	, array('float', 	100.01, 		true)
	    	, array('float', 	array('hoge'), 	false)
	    	, array('float', 	true, 			false)
	    	, array('float', 	null, 			false)
	    	
	    	, array('array', 	0, 				false)
	    	, array('array', 	'hoge', 		false)
	    	, array('array', 	100.01, 		false)
	    	, array('array', 	array('hoge'), 	true)
	    	, array('array', 	true, 			false)
	    	, array('array', 	null, 			false)
	    	
	    	, array('bool', 	0, 				false)
	    	, array('bool', 	'hoge', 		false)
	    	, array('bool', 	100.01, 		false)
	    	, array('bool', 	array('hoge'), 	false)
	    	, array('bool', 	true, 			true)
	    	, array('bool', 	null, 			false)
	    	
	    	, array('null', 	0, 				false)
	    	, array('null', 	'hoge', 		false)
	    	, array('null', 	100.01, 		false)
	    	, array('null', 	array('hoge'), 	false)
	    	, array('null', 	true, 			false)
	    	, array('null', 	null, 			true)
    	);
    }


}

