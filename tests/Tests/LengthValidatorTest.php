<?php

namespace Tests;

use syamgot\validator\Validators\LengthValidator;
use syamgot\Validator\Exception\LengthException;

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
		$state = $res === false;
		try {
			$obj = new LengthValidator($min, $max, $charset);
			$obj->setMin($min);
			$obj->setMax($max);
			$obj->setCharset($charset);
			$state = $obj->isValid($val);
		}
		catch (LengthException $e) {
			//echo $e->getMessage();
			$state = false;
		}
		$this->assertEquals($state, $res);
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

}

