<?php

namespace syamgot\Validator\Validators;

use syamgot\Validator\IValidator;
use syamgot\Validator\Exception\NotNullException;

/**
 * 値が null ではないかを判定するバリデートクラスです.
 * 
 * @package validator
 * @author syamgot
 */
class NotNullValidator implements IValidator {

	private $val;

	/**
	 * (non-PHPdoc)
	 * @see IValidator::isValid()
	 */
	public function isValid($val) {
		$this->val = $val;
		$res = is_null($val) === false;
		if ($res === false) {
			throw new NotNullException($this->val);
		}
		return $res;
	}

}



