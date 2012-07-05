<?php

require_once __DIR__ . '/IValidator.php';

/**
 * 文字列の長さを判定するバリデートクラスです.
 * 
 * 最小値、最大値を指定することができます。
 * 
 * @package validator
 * @author syamgot
 *
 */
class StrLengthValidator implements IValidator {

	private $_errorMessageTmpl = "[StrLengthValidator] it does not match. (%s)";

	private $_min;
	private $_max;
	private $_charset;
	private $_str;

	/**
	 * 
	 * 新しい StrLengthValidator インスタンスを作成します.
	 * 
	 * @param mixed $param
	 */
	public function __construct($params = null) {
		if ($params === null) return;
		
		$this->setMin((isset($params['min'])) ? (int) $params['min'] : ~PHP_INT_MAX);
		$this->setMax((isset($params['max'])) ? (int) $params['max'] : PHP_INT_MAX);
		$this->setCharset((isset($params['charset'])) ? $params['charset'] : mb_internal_encoding());
		
	}

	/**
	 * (non-PHPdoc)
	 * @see IValidator::isValid()
	 */
	public function isValid($val) {

		$this->_str = (string) $val;
		$valid_state = true;
		$len = mb_strlen($this->_str, $this->_charset);

		if ($this->_min > 0 && $this->_min > $len) {
			$valid_state = false;
		}

		if ($this->_max < $len) {
			$valid_state = false;
		}

		return $valid_state;

	}

	/**
	 *
	 * 直近のエラーメッセージを返します。
	 *
	 * @return string
	 */
	public function getErrorMessage() {
		return sprintf($this->_errorMessageTmpl,  $this->_str) . "\n";
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
		$this->_charset = (string) $val;
	}
	
}

