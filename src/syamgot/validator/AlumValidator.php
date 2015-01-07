<?php

namespace syamgot\Validator;

use syamgot\Validator\IValidator;

/**
 * アルファベットと数字のみを含む文字列かどうかを判定するバリデートクラスです.
 * 
 * @package validator
 * @author syamgot
 */
class AlumValidator implements IValidator {

	private $errorMessageTmpl = "[AlumValidator] it does not match. (%s)";

	private $val;

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

		$this->val = (string) $val;
		$valid_state = true;
		$valid_state = (preg_match("/[^a-zA-Z_0-9]+/", $this->val)) ? false : true;
		return $valid_state;

	}

	/**
	 * 
	 * 直近のエラーメッセージを返します。
	 * 
	 * @return string 
	 */
	public function getErrorMessage() {
		return sprintf($this->errorMessageTmpl, $this->val) . "\n";
	}

}
	

