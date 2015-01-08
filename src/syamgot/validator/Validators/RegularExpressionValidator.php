<?php

namespace syamgot\Validator\Validators;

use syamgot\Validator\IValidator;
use syamgot\Validator\Exception\RegularExpressionException;


/**
 * 正規表現で判定するバリデートクラスです.
 * 
 * @package validator
 * @author syamgot
 */
class RegularExpressionValidator implements IValidator {

	private $pattern;
	private $val;

	/**
	 * 
	 * 新しい RegularExpressionValidator インスタンスを作成します.
	 * 
	 */
	public function __construct($pattern) {
		$this->setPattern($pattern);
	}

	/**
	 * (non-PHPdoc)
	 * @see IValidator::isValid()
	 */
	public function isValid($val) {
		$this->val = (string) $val;
		if (preg_match($this->pattern, $this->val) === 0) {
			throw new RegularExpressionException($this->val, $this->pattern);
			return false;
		}
		return true;
	}

	/**
	 * 正規表現で判定するパターンをセットします.
	 * 
	 * @param string $val
	 */
	public function setPattern($val) {
		$this->pattern = (string) $val;
	}
}


