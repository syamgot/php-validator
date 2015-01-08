<?php

namespace Tests;

use syamgot\Validator\Validators\AlumValidator;


/**
 * AlumValidator unit test
 * 
 * @author syamgot
 */
class AlumValidatorTest extends \PHPUnit_Framework_TestCase {
    
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
		self::$obj = new AlumValidator();
	}
	
	/**
	 * @var AlumValidator
	 */
	protected static $obj;
	
    /**
     * 
     */
    public function providerTest() {
    	return array(
    		  array('adifahi0208', true)
    		, array('aidsfia((***!', false)
    		, array('aaあああ', false)
    	);
    }


}

