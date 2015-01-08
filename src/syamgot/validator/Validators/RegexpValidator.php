<?php

namespace syamgot\Validator\Validators;

use syamgot\Validator\IValidator;
use syamgot\Validator\Exception\RegexpException;


/**
 * 正規表現で判定するバリデートクラスです.
 * 
 * @package validator
 * @author syamgot
 */
class RegexpValidator implements IValidator {

	private $pattern;
	private $val;

	/**
	 * 
	 * 新しい RegexpValidator インスタンスを作成します.
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
			throw new RegexpException($this->val, $this->pattern);
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


