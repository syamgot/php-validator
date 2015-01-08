<?php

namespace Tests;

use syamgot\validator\Validators\RegularExpressionValidator;
use syamgot\Validator\Exception\RegularExpressionException;


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
		$state = $res === false;
		try {
			$obj = new RegularExpressionValidator($pattern);
			$state = $obj->isValid($val);
		}
		catch (RegularExpressionException $e) {
			//echo $e->getMessage()."\n";
			$state = false;
		}
		$this->assertEquals($state, $res);
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

