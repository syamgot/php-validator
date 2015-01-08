<?php

namespace Tests;

use syamgot\Validator\Validators\NotEmptyValidator;


/**
 * NotEmptyValidator unit test
 * 
 * @author syamgot
 */
class NotEmptyValidatorTest extends \PHPUnit_Framework_TestCase {
    
	/**
	 * @dataProvider providerTest
	 * 
	 */
	public function testIsValid($val, $res) {
		$this->assertEquals(self::$obj->isValid($val), $res);
	}
	
	/**
	 * 
	 */	
	public static function setUpBeforeClass() {
		self::$obj = new NotEmptyValidator();
	}
	
	/**
	 * @var NotEmptyValidator
	 */
	protected static $obj;
	
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

