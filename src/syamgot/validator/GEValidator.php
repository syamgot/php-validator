<?php

namespace syamgot\Validator;

/**
 * 指定された数値より、大きいか等しい数値かを判定するバリデートクラスです.
 * 
 * @package validator
 * @author syamgot
 */
class GeValidator implements IValidator {

	private $messageTmpl = "[GeValidator] it does not match. (%s)";

	private $_min;
	private $_val;

	/**
	 * 
	 * 新しい GeValidator インスタンスを作成します.
	 * 
	 * @param int $min
	 */
	public function __construct($min) {
		$this->setMin((int) $min);
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
	public function getMessage() {
		return sprintf($this->messageTmpl, $this->_val) . "\n";
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


