<?php

namespace syamgot\validator\Validators;

use syamgot\Validator\IValidator;
use syamgot\Validator\Exception\NotEmptyException;


/**
 * 値が空ではないかを判定するバリデートクラスです.
 *  
 * @see http://php.net/manual/ja/function.empty.php 
 */
class NotEmptyValidator implements IValidator {

	private $val;

	/**
	 * (non-PHPdoc)
	 * @see IValidator::isValid()
	 */
	public function isValid($val) {

		$this->val = $val;
		$res = empty($val) === false;
		if ($res === false) {
			throw new NotEmptyException($this->val);
		}
		return $res;

	}

}

