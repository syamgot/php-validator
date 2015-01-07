<?php

namespace syamgot\Validator;

use syamgot\Validator\IValidator;

/**
 * 指定された数値より、大きいか等しい数値かを判定するバリデートクラスです.
 * 
 * @package validator
 * @author syamgot
 */
class GEValidator implements IValidator {

	private $_errorMessageTmpl = "[GEValidator] it does not match. (%s)";

	private $_min;
	private $_val;

	/**
	 * 
	 * 新しい GEValidator インスタンスを作成します.
	 * 
	 * @param mixed $param
	 */
	public function __construct($param = null) {
		if ($param === null) return;
		$val = is_array($param) && isset($param['min'])
			? (int) $param['min']
			: (int) $param;
		$this->setMin($val);
	}

	/**
	 * (non-PHPdoc)
	 * @see IValidator::isValid()
	 */
	public function isValid($val) {
		$this->_val = (int) $val;
		return ($this->_val >= $this->_min) ? true : false;
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
	 * 最小値をセットします.
	 * 
	 * @param int $val
	 */
	public function setMin($val) {
		$this->_min = (int) $val;
	}

}


