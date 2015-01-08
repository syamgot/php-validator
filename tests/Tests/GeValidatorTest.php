<?php

namespace Tests;

use syamgot\validator\Validators\GeValidator;


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
		$obj = new GeValidator($min);
		$this->assertEquals($obj->isValid($val), $res);
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

