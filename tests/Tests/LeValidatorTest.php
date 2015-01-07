<?php

namespace Tests;

use syamgot\validator\LeValidator;


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
		$obj = new LeValidator($max);
		$this->assertEquals($obj->isValid($val), $res);
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

