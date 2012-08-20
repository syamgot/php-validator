<?php

require_once __DIR__ . '/../src/com/syamgot/php/validator/AlumValidator.php';
require_once __DIR__ . '/../src/com/syamgot/php/validator/DataTypeValidator.php';
require_once __DIR__ . '/../src/com/syamgot/php/validator/GEValidator.php';
require_once __DIR__ . '/../src/com/syamgot/php/validator/GTValidator.php';
require_once __DIR__ . '/../src/com/syamgot/php/validator/LEValidator.php';
require_once __DIR__ . '/../src/com/syamgot/php/validator/LTValidator.php';
require_once __DIR__ . '/../src/com/syamgot/php/validator/NotEmptyValidator.php';
require_once __DIR__ . '/../src/com/syamgot/php/validator/NotNullValidator.php';
require_once __DIR__ . '/../src/com/syamgot/php/validator/StrLengthValidator.php';
require_once __DIR__ . '/../src/com/syamgot/php/validator/Validator.php';

use com\syamgot\php\validator\AlumValidator;
use com\syamgot\php\validator\DataTypeValidator;
use com\syamgot\php\validator\GEValidator;
use com\syamgot\php\validator\GTValidator;
use com\syamgot\php\validator\IValidator;
use com\syamgot\php\validator\LEValidator;
use com\syamgot\php\validator\LTValidator;
use com\syamgot\php\validator\NotEmptyValidator;
use com\syamgot\php\validator\NotNullValidator;
use com\syamgot\php\validator\RegularExpressionValidator;
use com\syamgot\php\validator\StrLengthValidator;
use com\syamgot\php\validator\Validator;


/**
 * 
 * 
 *  
 * @author syamgot
 */
class validatorTest extends PHPUnit_Framework_TestCase {
	
	/** **************************************************
	*
	* Tests
	*
	************************************************** */
    
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
	 */
	public function testAddValidatorException() {
		try {
			$v = new Validator();
			$v->addValidator(new stdClass());
		} catch (InvalidArgumentException $e) {
			return;
		}
		$this->fail('期待通りの例外が発生しませんでした。');
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
	
	/** **************************************************
	*
	* setup and teardown
	*
	************************************************** */
	
	/**
	 * 
	 */	
	public static function setUpBeforeClass() {}
	
	/**
	 *
	 */
	protected function setUp() {}
	
	/**
	 * 
	 */
	protected function tearDown() {}
	
	/**
	 * 
	 */
	public static function tearDownAfterClass() {}
	
	
	/** **************************************************
	*
	* Static Methods
	*
	************************************************** */
	
	/**
	 * @var Validator
	 */
	protected static $obj;
	
	
	/** **************************************************
	 * 
	 * Data Providers
	 * 
	 ************************************************** */
	
    /**
     * $Validators, $value, $res
     * 
     * @return array
     */
    public function providerIsValid() {
    	return array(
    		
    		// クラスを生成して追加するパターン
    		  array(array(
    				  new StrLengthValidator(array('min' => 5, 'max' => 10, 'charset' => 'utf-8'))
    				, new AlumValidator()
    			), 'abcde12345', true)
    		, array(array(
    				  new StrLengthValidator(array('min' => 5, 'max' => 10, 'charset' => 'utf-8'))
    				, new AlumValidator()
    			), 'abcde12***', false)
	    	, array(array(
			    	  new StrLengthValidator(array('min' => 5, 'max' => 10, 'charset' => 'utf-8'))
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
	    			  array('name' => 'StrLength', 'min' => 5, 'max' => 10, 'charset' => 'utf-8')
			    	, array('name' => 'Alum')
		    	), 'abcde12345', true)
	    	, array(array(
	    			  array('name' => 'StrLength', 'min' => 5, 'max' => 10, 'charset' => 'utf-8')
			    	, array('name' => 'Alum')
		    	), 'abcde12***', false)
	    	, array(array(
	    			  array('name' => 'StrLength', 'min' => 5, 'max' => 10, 'charset' => 'utf-8')
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

