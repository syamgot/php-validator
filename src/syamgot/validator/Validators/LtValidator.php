<?php

namespace syamgot\validator\Validators;

use syamgot\Validator\IValidator;


/**
 * 指定された数値より小さいかを判定するバリデートクラスです.
 *
 * @package validator
 * @author syamgot
 */
class LtValidator implements IValidator {

	private $messageTmpl = "[LtValidator] it does not match. (%s)";

	private $_max;
	private $_val;

	/**
	 * 
	 * 新しい LtValidator インスタンスを作成します.
	 * 
	 * @param int $max
	 */
	public function __construct($max) {
		$this->setMax((int) $max);
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
	public function getMessage() {
		return sprintf($this->messageTmpl, $this->_val) . "\n";
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

