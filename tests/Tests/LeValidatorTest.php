<?php

namespace Tests;

use syamgot\validator\LEValidator;


/**
 * LEValidator unit test
 * 
 * @author syamgot
 */
class LEValidatorTest extends \PHPUnit_Framework_TestCase {
    
	/**
	 * @dataProvider providerIsValid
	 */
	public function testIsValid($Max, $val, $res) {
		self::$obj->setMax($Max);
		$this->assertEquals(self::$obj->isValid($val), $res);
	}
	
	/**
	 * @dataProvider providerConstruct
	 */
	public function testConstruct($param, $val, $res) {
		$v = new LEValidator($param);
		$this->assertEquals($v->isValid($val), $res);
	}
	
	/**
	 * 
	 */	
	public static function setUpBeforeClass() {
		self::$obj = new LEValidator();
	}
	
	/**
	 * @var LEValidator
	 */
	protected static $obj;
	
    /**
     * 
     */
    public function providerIsValid() {
    	return array(
    		  array(5, 4, true)
    		, array(5, 5, true)
    		, array(5, 6, false)
    		, array(0, -1, true)
    		, array(0, 0, true)
    	);
    }
    
    /**
     * 
     */
    public function providerConstruct() {
    	return array(
	    	  array(5, 4, true)
	    	, array(5, 5, true)
	    	, array(5, 6, false)
	    	, array(array('max'=>5), 4, true)
	    	, array(array('max'=>5), 5, true)
	    	, array(array('max'=>5), 6, false)
    	);
    }


}

