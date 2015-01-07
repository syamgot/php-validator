<?php

namespace Tests;

use syamgot\validator\LTValidator;


/**
 * LTValidator unit test
 * 
 * @author syamgot
 */
class LTValidatorTest extends \PHPUnit_Framework_TestCase {
    
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
		$v = new LTValidator($param);
		$this->assertEquals($v->isValid($val), $res);
	}
	
	/**
	 * 
	 */	
	public static function setUpBeforeClass() {
		self::$obj = new LTValidator();
	}
	
	/**
	 * @var LTValidator
	 */
	protected static $obj;
	
    /**
     * 
     */
    public function providerIsValid() {
    	return array(
    		  array(5, 4, true)
    		, array(5, 5, false)
    		, array(5, 6, false)
    		, array(0, -1, true)
    		, array(0, 0, false)
    	);
    }
    
    /**
     * 
     */
    public function providerConstruct() {
    	return array(
	    	  array(5, 4, true)
	    	, array(5, 5, false)
	    	, array(5, 6, false)
	    	, array(array('max'=>5), 4, true)
	    	, array(array('max'=>5), 5, false)
	    	, array(array('max'=>5), 6, false)
    	);
    }


}

