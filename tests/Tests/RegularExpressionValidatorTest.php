<?php

namespace Tests;

use syamgot\validator\RegularExpressionValidator;


/**
 * RegularExpressionValidatorTest unit test
 * 
 * @author syamgot
 */
class RegularExpressionValidatorTest extends \PHPUnit_Framework_TestCase {
    
	/**
	 * @dataProvider providerTest
	 * 
	 */
	public function testIsValid($val, $pattern, $res) {
		$obj = new RegularExpressionValidator($pattern);
		$this->assertEquals($obj->isValid($val), $res);
	}
	
    /**
     * 
     */
    public function providerTest() {
    	return array(
    		  array(0, "/^[0-9]+/", true)
    		, array('hogehoge', "/^[a-z0-9]+/", true)
    		, array('Hogehoge', "/^[a-z0-9]+/", false)
    	);
    }
}

