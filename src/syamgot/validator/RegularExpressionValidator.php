<?php

namespace syamgot\Validator;


/**
 * 正規表現で判定するバリデートクラスです.
 * 
 * @package validator
 * @author syamgot
 */
class RegularExpressionValidator implements IValidator {

	private $messageTmpl = "[RegularExpressionValidator] it does not match. (%s)";

	private $_pattern;
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
		return preg_match($this->_pattern, $this->val) > 0 ? true : false;

	}

	/**
	 * 
	 * 直近のエラーメッセージを返します。
	 * 
	 * @return string 
	 */
	public function getMessage() {
		return sprintf($this->messageTmpl, $this->val) . "\n";
	}

	/**
	 * 正規表現で判定するパターンをセットします.
	 * 
	 * @param string $val
	 */
	public function setPattern($val) {
		$this->_pattern = (string) $val;
	}
}


