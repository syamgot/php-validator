<?php

namespace com\syamgot\php\validator {
	
	require_once __DIR__ . '/IValidator.php';

	use com\syamgot\php\validator\IValidator;
	

	/**
	 * 値が null ではないかを判定するバリデートクラスです.
	 * 
	 * @package validator
	 * @author syamgot
	 */
	class NotNullValidator implements IValidator {
	
		private $_errorMessageTmpl = "[NotNullValidator] it does not match.";
	
		private $_val;
	
		/**
		 * 
		 * 新しい NotNullValidator インスタンスを作成します.
		 * 
		 * @param mixed $param
		 */
		public function __construct() {
		}
	
		/**
		 * (non-PHPdoc)
		 * @see IValidator::isValid()
		 */
		public function isValid($val) {
			return ($val !== null) ? true : false;
		}
	
		/**
		 *
		 * 直近のエラーメッセージを返します。
		 *
		 * @return string
		 */
		public function getErrorMessage() {
			return sprintf($this->_errorMessageTmpl) . "\n";
		}
	
	}

}

