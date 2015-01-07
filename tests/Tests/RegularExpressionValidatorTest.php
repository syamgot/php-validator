<?php

namespace Tests;

use syamgot\validator\RegularExpressionValidator;


/**
 * RegularExpressionValidatorTest unit test
 * 
 * @author syamgot
 */
class RegularExpressionValidatorTest extends \PHPUnit_Framework_TestCase {
    
	/**
	 * @dataProvider providerTest
	 * 
	 */
	public function testIsValid($val, $pattern, $res) {
		self::$obj->setPattern($pattern);
		$this->assertEquals(self::$obj->isValid($val), $res);
	}
	
	/**
	 * @dataProvider providerConstruct
	 */
	public function testConstruct($param, $val, $res) {
		$v = new RegularExpressionValidator($param);
		$this->assertEquals($v->isValid($val), $res);
	}
	
	/**
	 * 
	 */	
	public static function setUpBeforeClass() {
		self::$obj = new RegularExpressionValidator();
	}
	
	/**
	 * @var RegularExpressionValidator
	 */
	protected static $obj;
	
    /**
     * 
     */
    public function providerTest() {
    	return array(
    		  array(0, "/^[0-9]+/", true)
    		, array('hogehoge', "/^[a-z0-9]+/", true)
    		, array('Hogehoge', "/^[a-z0-9]+/", false)
    	);
    }

    /**
     *
     */
    public function providerConstruct() {
    	return array(
	    	  array("/^[0-9]+$/", 0, true)
	    	, array("/^[a-z0-9]+$/", 'hogehoge', true)
    		, array("/^[a-z0-9]+$/", 'Hogehoge', false)
	    	, array(array('pattern'=>"/^[0-9]+$/"), 0, true)
	    	, array(array('pattern'=>"/^[a-z0-9]+$/"), 'hogehoge', true)
	    	, array(array('pattern'=>"/^[a-z0-9]+$/"), 'Hogehoge', false)
    	);
    }
}
