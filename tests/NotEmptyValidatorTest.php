<?php

require_once __DIR__ . '/../src/com/syamgot/php/validator/NotEmptyValidator.php';

use com\syamgot\php\validator\NotEmptyValidator;


/**
 * NotEmptyValidator unit test
 * 
 * @author syamgot
 */
class NotEmptyValidatorTest extends PHPUnit_Framework_TestCase {
	
	/** **************************************************
	*
	* Tests
	*
	************************************************** */
    
	/**
	 * @dataProvider providerTest
	 * 
	 */
	public function testIsValid($val, $res) {
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
		self::$obj = new NotEmptyValidator();
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
	 * @var NotEmptyValidator
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
    public function providerTest() {
    	return array(
    		  array(false, false)
    		, array(true, true)
    		, array(0, false)
    		, array(1, true)
    		, array(0.0, false)
    		, array(0.1, true)
    		, array('', false)
    		, array('hoge', true)
    		, array(array(), false)
    		, array(array('hoge'), true)
    		, array(null, false)
    	);
    }


}

