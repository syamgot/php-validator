<?php

namespace syamgot\Validator\Validators;

use syamgot\Validator\IValidator;

/**
 * 
 * 
 * @package validator
 * @author syamgot
 */
abstract class AbValidator implements IValidator {

	/**
	 * 
	 * 直近のエラーメッセージを返します。
	 * 
	 * @return string 
	 */
	public function getMessage() {
		return sprintf($this->messageTmpl, $this->val);
	}

	/**
	 * メッセージのテンプレートをセットします.
	 *
	 * @param string $tmpl
	 */
	public function setTmpl($tmpl) {
		$this->messageTmpl = $tmpl;
		return $this;
	}

	protected $messageTmpl = 'it does not match. (%s)';

	protected $val;

}
	

