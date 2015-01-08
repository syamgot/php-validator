<?php

namespace syamgot\validator\Validators;

use syamgot\Validator\IValidator;
use syamgot\Validator\Exception\LtException;


/**
 * 指定された数値より小さいかを判定するバリデートクラスです.
 *
 * @package validator
 * @author syamgot
 */
class LtValidator implements IValidator {

	private $max;
	private $val;

	/**
	 * 
	 * 新しい LtValidator インスタンスを作成します.
	 * 
	 * @param int $max
	 */
	public function __construct($max) {
		$this->setMax($max);
	}

	/**
	 * (non-PHPdoc)
	 * @see IValidator::isValid()
	 */
	public function isValid($val) {
		$this->val = (int) $val;
		if ($this->val >= $this->max) {
			throw new LtException($this->val, $this->max);
			return false;
		}
		return true;
	}

	/**
	 * 最大値をセットします.
	 *
	 * @param int $val
	 */
	public function setMax($val) {
		$this->max = (int) $val;
	}
	
}

