<?php

namespace com\syamgot\php\validator {
	
	require_once __DIR__ . '/IValidator.php';

	use com\syamgot\php\validator\IValidator;
	
	
	/**
	 * 正規表現で判定するバリデートクラスです.
	 * 
	 * @package validator
	 * @author syamgot
	 */
	class RegularExpressionValidator implements IValidator {
	
		private $_errorMessageTmpl = "[RegularExpressionValidator] it does not match. (%s)";
	
		private $_pattern;
		private $_var;
	
		/**
		 * 
		 * 新しい RegularExpressionValidator インスタンスを作成します.
		 * 
		 */
		public function __construct($param = null) {
			if ($param === null) return;
			
			$val = is_array($param) && isset($param['pattern'])
				? (string) $param['pattern']
				: (string) $param;
			$this->setPattern($val);
		}
	
		/**
		 * (non-PHPdoc)
		 * @see IValidator::isValid()
		 */
		public function isValid($val) {
	
			$this->_var = (string) $val;
			return preg_match($this->_pattern, $this->_var) > 0 ? true : false;
	
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
	
		/**
		 * 正規表現で判定するパターンをセットします.
		 * 
		 * @param string $val
		 */
		public function setPattern($val) {
			$this->_pattern = (string) $val;
		}
	}

}

