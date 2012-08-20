<?php

namespace com\syamgot\php\validator {
	
	require_once __DIR__ . '/IValidator.php';

	use com\syamgot\php\validator\IValidator;
	
	
	/**
	 * アルファベットと数字のみを含む文字列かどうかを判定するバリデートクラスです.
	 * 
	 * @package validator
	 * @author syamgot
	 */
	class AlumValidator implements IValidator {
	
		private $_errorMessageTmpl = "[AlumValidator] it does not match. (%s)";
	
		private $_var;
	
		/**
		 * 
		 * 新しい AlumValidator インスタンスを作成します.
		 * 
		 */
		public function __construct() {}
	
		/**
		 * (non-PHPdoc)
		 * @see IValidator::isValid()
		 */
		public function isValid($val) {
	
			$this->_var = (string) $val;
			$valid_state = true;
			$valid_state = (preg_match("/[^a-zA-Z_0-9]+/", $this->_var)) ? false : true;
			return $valid_state;
	
		}
	
		/**
		 * 
		 * 直近のエラーメッセージを返します。
		 * 
		 * @return string 
		 */
		public function getErrorMessage() {
			return sprintf($this->_errorMessageTmpl, $this->_var) . "\n";
		}
	
	}
	
}

