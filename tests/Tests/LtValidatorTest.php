<?php

namespace Tests;

use syamgot\validator\LtValidator;


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
		$obj = new LtValidator($max);
		$this->assertEquals($obj->isValid($val), $res);
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

