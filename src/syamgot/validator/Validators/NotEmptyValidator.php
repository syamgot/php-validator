<?php

namespace syamgot\validator;


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

	private $messageTmpl = "[NotEmptyValidator] it does not match. (%s)";

	private $val;

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

		$this->val = $val;
		$valid_state = true;

		if (is_bool($this->val) && $this->val === false) {
			$valid_state = false;
		} else if (is_int($this->val) && $this->val === 0) {
			$valid_state = false;
		} else if (is_float($this->val) && $this->val == 0) {
			$valid_state = false;
		} else if (is_string($this->val) && $this->val === '') {
			$valid_state = false;
		} else if (is_array($this->val) && count($this->val) === 0) {
			$valid_state = false;
		} else if (is_null($this->val) && $this->val === null) {
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
	public function getMessage() {
		return sprintf($this->messageTmpl, $this->val) . "\n";
	}

}

