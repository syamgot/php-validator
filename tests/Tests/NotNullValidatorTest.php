<?php

namespace Tests;

use syamgot\validator\NotNullValidator;


/**
 * NotNullValidator unit test
 * 
 * @author syamgot
 */
class NotNullValidatorTest extends \PHPUnit_Framework_TestCase {
    
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
		self::$obj = new NotNullValidator();
	}
	
	/**
	 * @var NotNullValidator
	 */
	protected static $obj;
	
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

