<?php

namespace syamgot\Validator\Tests;

use syamgot\Validator\Validators\NotEmptyValidator;
use syamgot\Validator\Exception\NotEmptyException;


/**
 * NotEmptyValidator unit test
 * 
 * @author syamgot
 */
class NotEmptyValidatorTest extends \PHPUnit_Framework_TestCase {
    
	/**
	 * @dataProvider providerTest
	 * 
	 */
	public function testIsValid($val, $res) {
		$state = $res === false;
		try {
			$obj = new NotEmptyValidator();
			$state = $obj->isValid($val);
		}
		catch (NotEmptyException $e) {
			$state = false;
		}
		$this->assertEquals($state, $res);
	}
	
    /**
     * 
     */
    public function providerTest() {
    	return array(
    		  array(false, false)
    		, array(true, true)
    		, array(0, false)
    		, array(1, true)
    		, array(0.0, false)
    		, array(0.1, true)
    		, array('', false)
    		, array('hoge', true)
    		, array(array(), false)
    		, array(array('hoge'), true)
    		, array(null, false)
    	);
    }


}

