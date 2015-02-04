<?php

namespace syamgot\Validator\Tests;

use syamgot\validator\Validators\LtValidator;
use syamgot\Validator\Exception\LtException;

/**
 * LtValidator unit test
 * 
 * @author syamgot
 */
class LtValidatorTest extends \PHPUnit_Framework_TestCase {
    
	/**
	 * @dataProvider providerIsValid
	 */
	public function testIsValid($max, $val, $res) {
		$state = $res === false;
		try {
			$obj = new LtValidator($max);
			$state = $obj->isValid($val);
		}
		catch (LtException $e) {
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
    		, array(5, 5, false)
    		, array(5, 6, false)
    		, array(0, -1, true)
    		, array(0, 0, false)
    	);
    }

}

