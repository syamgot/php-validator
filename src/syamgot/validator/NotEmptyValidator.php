<?php

namespace syamgot\validator;

use syamgot\validator\IValidator;


/**
 * 値が空ではないかを判定するバリデートクラスです.
 *
 * 判定する値の型により、何を空と判定するかが変わります。
 * 値が以下の場合、False を返します.
 * boolean : False 
 * integer : 0
 * float   : 0
 * string  : ''
 * array   : 件数が0 
 * null    : Null
 * 
 * @package validator
 * @author syamgot
 * 
 */
class NotEmptyValidator implements IValidator {

	private $_errorMessageTmpl = "[NotEmptyValidator] it does not match. (%s)";

	private $_var;

	/**
	 * 
	 * 新しい NotEmptyValidator インスタンスを作成します.
	 * 
	 */
	public function __construct() {
	}

	/**
	 * (non-PHPdoc)
	 * @see IValidator::isValid()
	 */
	public function isValid($val) {

		$this->_var = $val;
		$valid_state = true;

		if (is_bool($this->_var) && $this->_var === false) {
			$valid_state = false;
		} else if (is_int($this->_var) && $this->_var === 0) {
			$valid_state = false;
		} else if (is_float($this->_var) && $this->_var == 0) {
			$valid_state = false;
		} else if (is_string($this->_var) && $this->_var === '') {
			$valid_state = false;
		} else if (is_array($this->_var) && count($this->_var) === 0) {
			$valid_state = false;
		} else if (is_null($this->_var) && $this->_var === null) {
			$valid_state = false;
		}

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

