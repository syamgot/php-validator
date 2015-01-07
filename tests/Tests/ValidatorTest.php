<?php

namespace Tests;

use syamgot\Validator\AlumValidator;
use syamgot\Validator\DataTypeValidator;
use syamgot\Validator\GEValidator;
use syamgot\Validator\GtValidator;
use syamgot\Validator\IValidator;
use syamgot\Validator\LeValidator;
use syamgot\Validator\LtValidator;
use syamgot\Validator\NotEmptyValidator;
use syamgot\Validator\NotNullValidator;
use syamgot\Validator\RegularExpressionValidator;
use syamgot\Validator\LengthValidator;
use syamgot\Validator\Validator;
use \stdClass;
use \ReflectionMethod;

/**
 * 
 * 
 *  
 * @author syamgot
 */
class validatorTest extends \PHPUnit_Framework_TestCase {
    
	/**
	 * 
	 */
	public function testAddValidatorChain() {

		$v = new Validator();
		$v->alum()->length(3,5,'UTF-8');
		$this->assertFalse($v->isValid('ab'));
		$this->assertFalse($v->isValid('abcdef'));
		$this->assertTrue($v->isValid('abc'));
		$this->assertTrue($v->isValid('abcde'));
		$this->assertFalse($v->isValid('+_-'));

		$v = new Validator();
		$v->length(3,5,'UTF-8');
		$this->assertFalse($v->isValid('あい'));
		$this->assertFalse($v->isValid('あいうえおか'));
		$this->assertTrue($v->isValid('あいう'));
		$this->assertTrue($v->isValid('あいうえお'));
				
	}

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
	 * @dataProvider providerAddValidatorByArgs
	 */
	public function testAddValidatorByArgs($params) {
		$m = new ReflectionMethod('syamgot\Validator\Validator', 'addValidator');
		$v = new Validator();
		foreach ($params as $param) {
			$m->invokeArgs($v, $param);
		}
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
    				  new LengthValidator(5, 10, 'utf-8')
    				, new AlumValidator()
    			), 'abcde12345', true)
    		, array(array(
    				  new LengthValidator(5, 10, 'utf-8')
    				, new AlumValidator()
    			), 'abcde12***', false)
	    	, array(array(
			    	  new LengthValidator(5, 10, 'utf-8')
			    	, new AlumValidator()
		    	), 'abcde12あいう', false)
		    
    		, array(array(
			    	  new GeValidator(0)
			    	, new LeValidator(1)
		    	), 0, true)
    		, array(array(
			    	  new GeValidator(0)
			    	, new LeValidator(1)
		    	), 1, true)
    		, array(array(
			    	  new GeValidator(0)
			    	, new LeValidator(1)
		    	), 2, false)
	    	, array(array(
			    	  new GeValidator(0)
			    	, new LeValidator(1)
		    	), -1, false)
	    	, array(array(
			    	  new RegularExpressionValidator('/^[0-9a-z]+$/')
		    	), '000aaaa', true)
    	);
    }

	public function providerAddValidatorByArgs() {
    	return array(
		    
		    // 名前を指定して追加するパターン
    		  array(array(
	    			  array('Length', 5, 10, 'utf-8')
			    	, array('Alum')
			))
	    	, array(array(
	    			  array('name' => 'Length', 'min' => 5, 'max' => 10, 'charset' => 'utf-8')
			    	, array('name' => 'Alum')
			))
	    	, array(array(
	    			  array('name' => 'Length', 'min' => 5, 'max' => 10, 'charset' => 'utf-8')
			    	, array('name' => 'Alum')
			))
		    	
	    	, array(array(
	    			  array('name' => 'Ge', 'min' => 0)
			    	, array('name' => 'Le', 'max' => 1)
			))
    			
	    	, array(array(
	    			  array('name' => 'Ge', 'min' => 0)
			    	, array('name' => 'Le', 'max' => 1)
			))
    			
	    	, array(array(
	    			  array('name' => 'Ge', 'min' => 0)
			    	, array('name' => 'Le', 'max' => 1)
			))
    			
    		, array(array(
    				  array('name' => 'Ge', 'min' => 0)
			    	, array('name' => 'Le', 'max' => 1)
			))
	    	, array(array(
	    			  array('name' => 'RegularExpression', 'pattern' => "/^[0-9a-z]+$/")
			))
    	);
	}

}

