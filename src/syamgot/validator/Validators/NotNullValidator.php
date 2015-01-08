<?php

namespace syamgot\Validator\Validators;

use syamgot\Validator\IValidator;


/**
 * 値が null ではないかを判定するバリデートクラスです.
 * 
 * @package validator
 * @author syamgot
 */
class NotNullValidator implements IValidator {

	private $messageTmpl = "[NotNullValidator] it does not match.";

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
	public function getMessage() {
		return sprintf($this->messageTmpl) . "\n";
	}

}



