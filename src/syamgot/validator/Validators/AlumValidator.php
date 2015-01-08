<?php

namespace syamgot\Validator\Validators;

use syamgot\Validator\IValidator;
use syamgot\Validator\Exception\AlumException;

/**
 * アルファベットと数字のみを含む文字列かどうかを判定するバリデートクラスです.
 * 
 * @package validator
 * @author syamgot
 */
class AlumValidator implements IValidator {

	private $messageTmpl = "[AlumValidator] it does not match. (%s)";

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
		$state = ctype_alnum($this->val);
		if ($state === false) {
			throw new AlumException($this->val);
		}
		return $state;

	}

	/**
	 * 
	 * 直近のエラーメッセージを返します。
	 * 
	 * @return string 
	 */
	public function getMessage() {
		return sprintf($this->messageTmpl, $this->val) . "\n";
	}

}
	

