<?php

require_once __DIR__ . '/../src/com/syamgot/php/validator/GTValidator.php';

use com\syamgot\php\validator\GTValidator;


/**
 * GTValidator unit test
 * 
 * @author syamgot
 */
class GTValidatorTest extends PHPUnit_Framework_TestCase {
	
	/** **************************************************
	*
	* Tests
	*
	************************************************** */
    
	/**
	 * @dataProvider providerIsValid
	 */
	public function testIsValid($min, $val, $res) {
		self::$obj->setMin($min);
		$this->assertEquals(self::$obj->isValid($val), $res);
	}
	
	/**
	 * @dataProvider providerConstruct
	 */
	public function testConstruct($param, $val, $res) {
		$v = new GTValidator($param);
		$this->assertEquals($v->isValid($val), $res);
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
		self::$obj = new GTValidator();
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
	 * @var GTValidator
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
    public function providerIsValid() {
    	return array(
    		  array(5, 4, false)
    		, array(5, 5, false)
    		, array(5, 6, true)
    		, array(0, -1, false)
    		, array(0, 0, false)
    	);
    }
    
    /**
     * 
     */
    public function providerConstruct() {
    	return array(
	    	  array(5, 4, false)
	    	, array(5, 5, false)
	    	, array(5, 6, true)
	    	, array(array('min'=>5), 4, false)
	    	, array(array('min'=>5), 5, false)
	    	, array(array('min'=>5), 6, true)
    	);
    }


}

