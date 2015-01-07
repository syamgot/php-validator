<?php

namespace syamgot\validator;


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

	private $_min;
	private $_max;
	private $_harset;
	private $_str;

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

		$this->_str = (string) $val;
		$valid_state = true;
		$len = mb_strlen($this->_str, $this->_harset);
		return $this->_min <= $len && $this->_max >= $len;

	}

	/**
	 *
	 * 直近のエラーメッセージを返します。
	 *
	 * @return string
	 */
	public function getMessage() {
		return sprintf($this->messageTmpl,  $this->_str) . "\n";
	}
	
	/**
	 * 最小値をセットします.
	 * 
	 * @param int $val
	 */
	public function setMin($val) {
		$this->_min = (int) $val;
	}
	
	/**
	 * 最大値をセットします.
	 *
	 * @param int $val
	 */
	public function setMax($val) {
		$this->_max = (int) $val;
	}

	/**
	 * 文字エンコーディングをセットします.
	 *
	 * @param int $val
	 */
	public function setCharset($val) {
		$this->_harset = (string) $val;
	}
	
}


