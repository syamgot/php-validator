<?php

namespace syamgot\Validator\Tests;

use syamgot\validator\Validators\NotNullValidator;
use syamgot\Validator\Exception\NotNullException;


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
		$state = $res === false;
		try {
			$obj = new NotNullValidator();
			$state = $obj->isValid($val);
		}
		catch (NotNullException $e) {
			$state = false;
		}
		$this->assertEquals($state, $res);
	}
	
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

