<?php

namespace syamgot\Validator\Tests;

use syamgot\validator\Validators\GeValidator;
use syamgot\Validator\Exception\GeException;


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
		$state = $res === false;
		try {
			$obj = new GeValidator($min);
			$state = $obj->isValid($val);
		}
		catch (GeException $e) {
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
    		, array(5, 5, true)
    		, array(5, 6, true)
    		, array(0, -1, false)
    		, array(0, 0, true)
    	);
    }
    
}

