<?php

namespace syamgot\validator\Validators;

use syamgot\Validator\IValidator;
use syamgot\Validator\Exception\LengthException;


/**
 * 文字列の長さを判定するバリデートクラスです.
 * 
 * 最小値、最大値を指定することができます。
 * 
 * @package validator
 * @author syamgot
 *
 */
class LengthValidator implements IValidator {

	private $messageTmpl = "[LengthValidator] it does not match. (%s)";

	private $min;
	private $max;
	private $charset;
	private $val;

	/**
	 * 新しい LengthValidator インスタンスを作成します.
	 * 
	 * 
	 * @param int $min 
	 * @param int $max
	 * @param string $charset 
	 */
	public function __construct($min, $max, $charset = null) {
		if ($charset === null) {
			$charset = mb_internal_encoding();
		}
		$this->setMin($min);
		$this->setMax($max);
		$this->setCharset($charset);
	}

	/**
	 * (non-PHPdoc)
	 * @see IValidator::isValid()
	 */
	public function isValid($val) {

		$this->val = (string) $val;
		$len = mb_strlen($this->val, $this->charset);
		if ($this->min > $len) {
			throw new LengthException($this->val, $this->min, $this->max, LengthException::LOWER);
			return false;
		}
		else if ($this->max < $len) {
			throw new LengthException($this->val, $this->min, $this->max, LengthException::GREATER);
			return false;
		}
		return true;
	}

	/**
	 *
	 * 直近のエラーメッセージを返します。
	 *
	 * @return string
	 */
	public function getMessage() {
		return sprintf($this->messageTmpl,  $this->val) . "\n";
	}
	
	/**
	 * 最小値をセットします.
	 * 
	 * @param int $val
	 */
	public function setMin($val) {
		$this->min = (int) $val;
	}
	
	/**
	 * 最大値をセットします.
	 *
	 * @param int $val
	 */
	public function setMax($val) {
		$this->max = (int) $val;
	}

	/**
	 * 文字エンコーディングをセットします.
	 *
	 * @param int $val
	 */
	public function setCharset($val) {
		$this->charset = (string) $val;
	}
	
}


