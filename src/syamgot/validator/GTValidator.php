<?php

namespace syamgot\Validator;

use syamgot\validator\IValidator;


/**
 * 指定された数値より大きいかを判定するバリデートクラスです.
 * 
 * @package validator
 * @author syamgot
 */
class GTValidator implements IValidator {

	private $errorMessageTmpl = "[GTValidator] it does not match. (%s)";

	private $_min;
	private $_val;

	/**
	 * 
	 * 新しい GTValidator インスタンスを作成します.
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
		return ($this->_val > $this->_min) ? true : false;
	}

	/**
	 * 
	 * 直近のエラーメッセージを返します。
	 * 
	 * @return string 
	 */
	public function getErrorMessage() {
		return sprintf($this->errorMessageTmpl, $this->_val) . "\n";
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



