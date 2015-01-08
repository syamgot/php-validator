<?php

namespace syamgot\Validator\Validators;

use syamgot\Validator\IValidator;
use syamgot\Validator\Exception\LeException;

/**
 * 指定された数値より小さいか等しいかを判定するバリデートクラスです.
 *
 * @package validator
 * @author syamgot
 */
class LeValidator implements IValidator {

	private $max;
	private $val;

	/**
	 * 
	 * 新しい LeValidator インスタンスを作成します.
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
		$this->val = (int) $val;
		if ($this->val > $this->max) {
			throw new LeException($this->val, $this->max);
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


