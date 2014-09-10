<?php

use syamgot\validator\StrLengthValidator;


/**
 * StrLengthValidator unit test
 * 
 * @author syamgot
 */
class StrLengthValidatorTest extends PHPUnit_Framework_TestCase {
	
	/** **************************************************
	*
	* Tests
	*
	************************************************** */
    
	/**
	 * @dataProvider providerIsValid
	 */
	public function testIsValid($min, $max, $charset, $val, $res) {
		self::$obj->setMin($min);
		self::$obj->setMax($max);
		self::$obj->setCharset($charset);
		$this->assertEquals(self::$obj->isValid($val), $res);
	}
	
	/**
	 * @dataProvider providerConstruct
	 */
	public function testConstruct($param, $val, $res) {
		$v = new StrLengthValidator($param);
		$this->assertEquals($v->isValid($val), $res);
	}

	/** **************************************************
	*
	* setup and teardown
	*
	************************************************** */
	
	/**
	 * 
	 */	
	public static function setUpBeforeClass() {
		self::$obj = new StrLengthValidator();
	}
	
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
	 * @var StrLengthValidator
	 */
	protected static $obj;
	
	
	/** **************************************************
	 * 
	 * Data Providers
	 * 
	 ************************************************** */
	
    /**
     * $min, $max, $charset, $val, $res
     */
    public function providerIsValid() {
    	return array(
    		  array(5, 10, 'utf-8', 'あいうえおかきくけこ', true)
    		, array(5, 10, 'utf-8', 'あいうえ', false)
    		, array(5, 10, 'utf-8', 'あいうえおかきくけこさ', false)
    		, array(5, 10, 'utf-8', 'あいうえおabcdeさ', false)
    		
    		, array(-1, 99, 'utf-8', 'あいうえおかきくけこさ', true)
    		
    		, array(5, 10, 'sjis', mb_convert_encoding('あいうえおかきくけこ', 'sjis', 'utf-8'), true)
    		, array(5, 10, 'sjis', mb_convert_encoding('あいうえ', 'sjis', 'utf-8'), false)
    		, array(5, 10, 'sjis', mb_convert_encoding('あいうえおかきくけこさ', 'sjis', 'utf-8'), false)
    		, array(5, 10, 'sjis', mb_convert_encoding('あいうえおabcdeさ', 'sjis', 'utf-8'), false)
    	);
    }
    
    /**
     * $param, $val, $res
     */
    public function providerConstruct() {
    	return array(
	    	  array(array('min'=>5, 'max'=>10, 'charset'=>'utf-8'), 'あいうえおかきくけこ', true)
	    	, array(array('min'=>5, 'max'=>10, 'charset'=>'utf-8'), 'あいうえ', false)
	    	, array(array('min'=>5, 'max'=>10, 'charset'=>'utf-8'), 'あいうえおかきくけこさ', false)
    	);
    }


}

