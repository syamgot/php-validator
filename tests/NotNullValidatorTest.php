<?php

require_once __DIR__ . '/../src/com/syamgot/php/validator/NotNullValidator.php';

use com\syamgot\php\validator\NotNullValidator;


/**
 * NotNullValidator unit test
 * 
 * @author syamgot
 */
class NotNullValidatorTest extends PHPUnit_Framework_TestCase {
	
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
		self::$obj = new NotNullValidator();
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
	 * @var NotNullValidator
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
    		  array('', true)
    		, array(0, true)
    		, array(0.0, true)
    		, array(array(), true)
    		, array(null, false)
    	);
    }


}

