<?php

namespace Tests;

use syamgot\validator\Validators\GtValidator;


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
		$obj = new GtValidator($min);
		$this->assertEquals($obj->isValid($val), $res);
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

