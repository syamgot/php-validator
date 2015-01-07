<?php

namespace syamgot\validator;

use syamgot\Validator\IValidator;


/**
 * 指定された数値より小さいかを判定するバリデートクラスです.
 *
 * @package validator
 * @author syamgot
 */
class LTValidator implements IValidator {

	private $_errorMessageTmpl = "[LTValidator] it does not match. (%s)";

	private $_max;
	private $_val;

	/**
	 * 
	 * 新しい LTValidator インスタンスを作成します.
	 * 
	 * @param mixed $param
	 */
	public function __construct($param = null) {
		if ($param === null) return;
		$val = is_array($param) && isset($param['max'])
			? (int) $param['max']
			: (int) $param;
		$this->setMax($val);
	}

	/**
	 * (non-PHPdoc)
	 * @see IValidator::isValid()
	 */
	public function isValid($val) {
		$this->_val = (int) $val;
		return ($this->_val < $this->_max) ? true : false;
	}

	/**
	 *
	 * 直近のエラーメッセージを返します。
	 *
	 * @return string
	 */
	public function getErrorMessage() {
		return sprintf($this->_errorMessageTmpl, $this->_val) . "\n";
	}

	/**
	 * 最大値をセットします.
	 *
	 * @param int $val
	 */
	public function setMax($val) {
		$this->_max = (int) $val;
	}
	
}

