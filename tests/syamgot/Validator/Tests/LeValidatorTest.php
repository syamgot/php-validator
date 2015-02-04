<?php

namespace syamgot\Validator\Tests;

use syamgot\validator\Validators\LeValidator;
use syamgot\Validator\Exception\LeException;


/**
 * LeValidator unit test
 * 
 * @author syamgot
 */
class LeValidatorTest extends \PHPUnit_Framework_TestCase {
    
	/**
	 * @dataProvider providerIsValid
	 */
	public function testIsValid($max, $val, $res) {
		$state = $res === false;
		try {
			$obj = new LeValidator($max);
			$state = $obj->isValid($val);
		}
		catch (LeException $e) {
			$state = false;
		}
		$this->assertEquals($state, $res);
	}
	
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

}

