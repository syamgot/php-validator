<?php

namespace syamgot\Validator\Tests;

use syamgot\validator\Validators\AlnumValidator;
use syamgot\Validator\Exception\AlnumException;


/**
 * AlnumValidator unit test
 * 
 * @author syamgot
 */
class AlnumValidatorTest extends \PHPUnit_Framework_TestCase {
    
	/**
	 * @dataProvider providerTest
	 * 
	 */
	public function testIsValid($val, $res) {
		$state = $res === false;
		try {
			$obj = new AlnumValidator();
			$state = $obj->isValid($val);
		}
		catch (AlnumException $e) {
			$state = false;
		}
		$this->assertEquals($state, $res);
	}

    /**
     * 
     */
    public function providerTest() {
    	return array(
    		  array('adifahi0208', true)
    		, array('aidsfia((***!', false)
    		, array('aaあああ', false)
    	);
    }


}

