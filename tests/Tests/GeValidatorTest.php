<?php

namespace Tests;

use syamgot\validator\GeValidator;


/**
 * GeValidator unit test
 * 
 * @author syamgot
 */
class GeValidatorTest extends \PHPUnit_Framework_TestCase {
    
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
		$v = new GeValidator($param);
		$this->assertEquals($v->isValid($val), $res);
	}
	
	/**
	 * 
	 */	
	public static function setUpBeforeClass() {
		self::$obj = new GeValidator();
	}
	
	/**
	 * @var GeValidator
	 */
	protected static $obj;
	
    /**
     * 
     */
    public function providerIsValid() {
    	return array(
    		  array(5, 4, false)
    		, array(5, 5, true)
    		, array(5, 6, true)
    		, array(0, -1, false)
    		, array(0, 0, true)
    	);
    }
    
    /**
     * 
     */
    public function providerConstruct() {
    	return array(
	    	  array(5, 4, false)
	    	, array(5, 5, true)
	    	, array(5, 6, true)
	    	, array(array('min'=>5), 4, false)
	    	, array(array('min'=>5), 5, true)
	    	, array(array('min'=>5), 6, true)
    	);
    }


}

