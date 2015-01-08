<?php

namespace syamgot\Validator\Validators;

use syamgot\Validator\IValidator;
use syamgot\Validator\Exception\GeException;

/**
 * 指定された数値より、大きいか等しい数値かを判定するバリデートクラスです.
 * 
 * @package validator
 * @author syamgot
 */
class GeValidator implements IValidator {

	private $min;
	private $val;

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
		$this->val = (int) $val;
		if ($this->val < $this->min) {
			throw new GeException($this->val, $this->min);
			return false;
		}
		return true;
	}

	/**
	 * 最小値をセットします.
	 * 
	 * @param int $val
	 */
	public function setMin($val) {
		$this->min = (int) $val;
	}

}


