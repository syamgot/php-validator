<?php

namespace Tests;

use syamgot\validator\Validators\GtValidator;
use syamgot\Validator\Exception\GtException;

/**
 * GtValidator unit test
 * 
 * @author syamgot
 */
class GtValidatorTest extends \PHPUnit_Framework_TestCase {
    
	/**
	 * @dataProvider providerIsValid
	 */
	public function testIsValid($min, $val, $res) {
		$state = $res === false;
		try {
			$obj = new GtValidator($min);
			$state = $obj->isValid($val);
		}
		catch (GtException $e) {
			$state = false;
		}
		$this->assertEquals($state, $res);
	}
	
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

}

