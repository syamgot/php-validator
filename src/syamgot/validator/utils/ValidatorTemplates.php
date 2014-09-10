<?php

namespace syamgot\validator\utils {
	
	require_once __DIR__ . '/../Validator.php';

	use syamgot\validator\Validator;
	
	
	/**
	 * よく使う(かもしれない)バリデートインスタンスを返します.
	 * 
	 * 同様の条件は、同じインスタンスを利用します。
	 * 
	 * @package validator
	 * @author syamgot
	 *
	 */
	class ValidatorTemplates {
		
		private static $_validators;
	
		private static function getValidator($key) {
			if (!self::$_validators) self::$_validators = array();
			return isset(self::$_validators[$key]) ? self::$_validators[$key] : false;
		}
		
		/**
		 * int型を判定する、バリデータインスタンスを返します.
		 */
		static function int() {
			$validator = self::getValidator(__METHOD__);
			if (!$validator) {
				$validator = new Validator();
				$validator->addValidator((array('name' => 'DataType', 'type' => 'int')));
				self::$_validators[__METHOD__] = $validator;
			}
			return $validator;
		}
		
		/**
		 * 空でないint型を判定する、バリデートインスタンスを返します. 
		 */
		static function intNotEmpty() {
			$validator = self::getValidator(__METHOD__);
			if (!$validator) {
				$validator = new Validator();
				$validator->addValidator((array('name' => 'NotEmpty')));
				$validator->addValidator((array('name' => 'DataType', 'type' => 'int')));
				self::$_validators[__METHOD__] = $validator;
			}
			return $validator;
		}
		
		/**
		 * string型を判定する、バリデートインスタンスを返します.
		 */
		static function string() {
			$validator = self::getValidator(__METHOD__);
			if (!$validator) {
				$validator = new Validator();
				$validator->addValidator((array('name' => 'DataType', 'type' => 'string')));
				self::$_validators[__METHOD__] = $validator;
			}
			return $validator;
		}
		
		/**
		 * 空でないstring型を判定する、バリデートインスタンスを返します. 
		 */
		static function stringNotEmpty() {
			$validator = self::getValidator(__METHOD__);
			if (!$validator) {
				$validator = new Validator();
				$validator->addValidator((array('name' => 'NotEmpty')));
				$validator->addValidator((array('name' => 'DataType', 'type' => 'string')));
				self::$_validators[__METHOD__] = $validator;
			}
			return $validator;
		}
	
		/**
		 * 範囲制限のあるint型を判定する、バリデートインスタンスを返します.
		 * 
		 * @param int $min
		 * @param int $max
		 */
		static function limitedInt($min, $max) {
			
			return false;
			
			$validator = self::getValidator(__METHOD__);
			if (!$validator) {
				$validator = new Validator();
				$validator->addValidator((array('name' => 'GE', 'min' => $min)));
				$validator->addValidator((array('name' => 'LE', 'max' => $max)));
				$validator->addValidator((array('name' => 'DataType', 'type' => 'int')));
				self::$_validators[__METHOD__] = $validator;
			} else {
				$w = $validator->getValidator('GE');
				$w->setMin($min);
				$w = $validator->getValidator('LE');
				$w->setMax($max);
			}
			return $validator;
		}
		
	}
	
}	

