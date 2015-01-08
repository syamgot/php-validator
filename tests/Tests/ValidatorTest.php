<?php

namespace Tests;

use syamgot\Validator\Validators\AlumValidator;
use syamgot\Validator\Validators\DataTypeValidator;
use syamgot\Validator\Validators\GEValidator;
use syamgot\Validator\Validators\GtValidator;
use syamgot\Validator\Validators\IValidator;
use syamgot\Validator\Validators\LeValidator;
use syamgot\Validator\Validators\LtValidator;
use syamgot\Validator\Validators\NotEmptyValidator;
use syamgot\Validator\Validators\NotNullValidator;
use syamgot\Validator\Validators\RegularExpressionValidator;
use syamgot\Validator\Validators\LengthValidator;
use syamgot\Validator\Validator;
use syamgot\Validator\Exception\ValidatorException;
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
/*
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
*/				
	}

	/**
	 * @dataProvider providerIsValid
	 */
	public function testIsValid($Validators, $val, $res) {

		// 結果を反転
		$state = $res === false;
		try {
			$v = new Validator();
			foreach($Validators as $key => $value) {
				$v->addValidator($Validators[$key]);
			}
			$v->isValid($val);
			$state = true;
		} 
		catch (ValidatorException $e) {
			// var_dump( $e->getMessages() );
			$state = false;
		}

		$this->assertEquals($state, $res);
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
	 * @dataProvider providerAddValidatorException 
	 */
	public function testAddValidatorException($val) {
		try {
			$v = new Validator();
			$v->addValidator($val);
		}
		catch (ValidatorException $e) {
			$this->assertTrue(true);
			// echo $e->getMessage();
		}
		
	}

    /**
     * 
     * @return array
     */
    public function providerAddValidatorException() {
    	return array(
			  array(new stdClass())
//			, array('hoge')
			, array('')
		);
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
			    	  new LengthValidator(5, 8, 'utf-8')
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

