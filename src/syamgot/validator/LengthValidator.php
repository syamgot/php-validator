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
	 * 
	 * 新しい LengthValidator インスタンスを作成します.
	 * 
	 * 
	 * $param('min' = 0, 'max' => 10, 'charset' => 'UTF-8') 
	 *  or 
	 * $min, $max, $charset 
	 * 
	 * 
	 * @param mixed $param
	 */
	public function __construct() {

		$args = func_get_args();
		if (count($args) === 0) return;

		if (count($args) === 1 && is_array($args[0])) {
			$params = $args[0];
			$this->setMin((isset($params['min'])) ? (int) $params['min'] : 0);
			$this->setMax((isset($params['max'])) ? (int) $params['max'] : PHP_INT_MAX);
			$this->setCharset((isset($params['charset'])) ? $params['charset'] : mb_internal_encoding());
		}
		else {
			$this->setMin((isset($args[0])) ? (int) $args[0] : 0);
			$this->setMax((isset($args[1])) ? (int) $args[1] : PHP_INT_MAX);
			$this->setCharset((isset($args[2])) ? $args[2] : mb_internal_encoding());
		}
		
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


