<?php

namespace Tests;

use syamgot\validator\Validators\AlumValidator;
use syamgot\Validator\Exception\AlumException;


/**
 * AlumValidator unit test
 * 
 * @author syamgot
 */
class AlumValidatorTest extends \PHPUnit_Framework_TestCase {
    
	/**
	 * @dataProvider providerTest
	 * 
	 */
	public function testIsValid($val, $res) {
		$state = $res === false;
		try {
			$obj = new AlumValidator();
			$state = $obj->isValid($val);
		}
		catch (AlumException $e) {
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

