<?php

namespace Tests;

use syamgot\validator\LengthValidator;


/**
 * LengthValidator unit test
 * 
 * @author syamgot
 */
class LengthValidatorTest extends \PHPUnit_Framework_TestCase {
    
	/**
	 * @dataProvider providerIsValid
	 */
	public function testIsValid($min, $max, $charset, $val, $res) {
		$v = new LengthValidator();
		$v->setMin($min);
		$v->setMax($max);
		$v->setCharset($charset);
		$this->assertEquals($v->isValid($val), $res);
	}
	
	/**
	 * @dataProvider providerConstruct
	 */
	public function testConstruct($param, $val, $res) {
		$v = new LengthValidator($param);
		$this->assertEquals($v->isValid($val), $res);
	}
	
	/**
	 * @dataProvider providerConstruct2
	 */
	public function testConstruct2($min, $max, $charset, $val, $res) {
		$v = new LengthValidator($min, $max);
		$this->assertEquals($v->isValid($val), $res);
	}

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
	    	  array(array('min'=>5, 'max'=>10, 'charset'=>'UTF-8'), 'あいうえおかきくけこ', true)
	    	, array(array('min'=>5, 'max'=>10, 'charset'=>'UTF-8'), 'あいうえ', false)
	    	, array(array('min'=>5, 'max'=>10, 'charset'=>'UTF-8'), 'あいうえおかきくけこさ', false)
    	);
    }

    /**
     * $param, $val, $res
     */
    public function providerConstruct2() {
    	return array(
	    	  array(5, 10,' UTF-8', 'あいうえおかきくけこ', true)
	    	, array(5, 10,' UTF-8', 'あいうえ', false)
	    	, array(5, 10,' UTF-8', 'あいうえおかきくけこさ', false)
	    	, array(null, 10,' UTF-8', 'あいうえおかきくけこさ', false)
    	);
    }

}

