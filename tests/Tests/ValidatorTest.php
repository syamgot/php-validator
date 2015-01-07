<?php

namespace Tests;

use syamgot\Validator\AlumValidator;
use syamgot\Validator\DataTypeValidator;
use syamgot\Validator\GEValidator;
use syamgot\Validator\GTValidator;
use syamgot\Validator\IValidator;
use syamgot\Validator\LEValidator;
use syamgot\Validator\LTValidator;
use syamgot\Validator\NotEmptyValidator;
use syamgot\Validator\NotNullValidator;
use syamgot\Validator\RegularExpressionValidator;
use syamgot\Validator\LengthValidator;
use syamgot\Validator\Validator;
use \stdClass;

/**
 * 
 * 
 *  
 * @author syamgot
 */
class validatorTest extends \PHPUnit_Framework_TestCase {
    
	/**
	 * @dataProvider providerIsValid
	 */
	public function testIsValid($Validators, $val, $res) {
		$v = new Validator();
		foreach($Validators as $key => $value) {
			$v->addValidator($Validators[$key]);
		}
		$this->assertEquals($v->isValid($val), $res);
	}

	/**
	 * 
	 * Enter description here ...
	 * @expectedException Exception
	 */
	public function testAddValidatorException() {
		$v = new Validator();
		$v->addValidator(new stdClass());
	}
	
	/**
	 * 
	 * Enter description here ...
	 */
	public function testGetValidator() {
		$v = new Validator();
		$this->assertNull($v->getValidator('Alum'));
		$v->addValidator(new AlumValidator());
		$this->assertNotNull($v->getValidator('Alum'));
	}
	
	/**
	 * @var Validator
	 */
	protected static $obj;
	
    /**
     * $Validators, $value, $res
     * 
     * @return array
     */
    public function providerIsValid() {
    	return array(
    		
    		// クラスを生成して追加するパターン
    		  array(array(
    				  new LengthValidator(array('min' => 5, 'max' => 10, 'charset' => 'utf-8'))
    				, new AlumValidator()
    			), 'abcde12345', true)
    		, array(array(
    				  new LengthValidator(array('min' => 5, 'max' => 10, 'charset' => 'utf-8'))
    				, new AlumValidator()
    			), 'abcde12***', false)
	    	, array(array(
			    	  new LengthValidator(array('min' => 5, 'max' => 10, 'charset' => 'utf-8'))
			    	, new AlumValidator()
		    	), 'abcde12あいう', false)
		    
    		, array(array(
			    	  new GEValidator(array('min' => 0))
			    	, new LEValidator(array('max' => 1))
		    	), 0, true)
    		, array(array(
			    	  new GEValidator(array('min' => 0))
			    	, new LEValidator(array('max' => 1))
		    	), 1, true)
    		, array(array(
			    	  new GEValidator(array('min' => 0))
			    	, new LEValidator(array('max' => 1))
		    	), 2, false)
	    	, array(array(
			    	  new GEValidator(array('min' => 0))
			    	, new LEValidator(array('max' => 1))
		    	), -1, false)
		    
		    // 名前を指定して追加するパターン
    		, array(array(
	    			  array('name' => 'Length', 'min' => 5, 'max' => 10, 'charset' => 'utf-8')
			    	, array('name' => 'Alum')
		    	), 'abcde12345', true)
	    	, array(array(
	    			  array('name' => 'Length', 'min' => 5, 'max' => 10, 'charset' => 'utf-8')
			    	, array('name' => 'Alum')
		    	), 'abcde12***', false)
	    	, array(array(
	    			  array('name' => 'Length', 'min' => 5, 'max' => 10, 'charset' => 'utf-8')
			    	, array('name' => 'Alum')
		    	), 'abcde12あいう', false)
		    	
	    	, array(array(
	    			  array('name' => 'GE', 'min' => 0)
			    	, array('name' => 'LE', 'max' => 1)
		    	), 0, true)
	    	, array(array(
	    			  array('name' => 'GE', 'min' => 0)
			    	, array('name' => 'LE', 'max' => 1)
		    	), 1, true)
	    	, array(array(
	    			  array('name' => 'GE', 'min' => 0)
			    	, array('name' => 'LE', 'max' => 1)
		    	), 2, false)
    		, array(array(
    				  array('name' => 'GE', 'min' => 0)
			    	, array('name' => 'LE', 'max' => 1)
    			), -1, false)
    			
	    	, array(array(
	    			  array('name' => 'RegularExpression', 'pattern' => "/^[0-9a-z]+$/")
		    	), '000aaaa', true)
    	);
    }

}

