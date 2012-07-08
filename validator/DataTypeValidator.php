<?php

require_once __DIR__ . '/IValidator.php';

/**
 * 値の型を判定するクラスです.
 * 
 * int(integer), float, string, array, bool, null を判定することができます。
 * 
 * @package validator
 * @author syamgot
 */
class DataTypeValidator implements IValidator {

	private $_errorMessageTmpl = "[DataTypeValidator] it does not match. (%s, %s)";

	private $_var;
	private $_dataType;
	private $_types = array('int', 'integer', 'float', 'string', 'array', 'bool', 'null');
	
	/**
	 * 
	 * 新しい DataTypeValidator インスタンスを作成します.
	 * 
	 * @param mixed $param
	 */
	public function __construct($param = null) {
		if ($param === null) return;
		
		$dataType = '';
		if (is_array($param)) {
			$dataType = (isset($param['type'])) ? (string) $param['type'] : $dataType;
		} else {
			$dataType = (string) $param;
		}
		$this->setDataType($dataType);
	}
	
	/**
	 * チェックしたいデータ型をセットします.
	 * 
	 * @param mixed $dataType
	 * @throws Exception チェック対象外のデータ型であれば、エラー
	 */
	public function setDataType($dataType) {
		
		if (!in_array($dataType, $this->_types)) 
			throw new Exception(sprintf('it is an incorrect value. (%s)' , $dataType));
		
		$this->_dataType = $dataType;
	}

	/**
	 * (non-PHPdoc)
	 * @see IValidator::isValid()
	 */
	public function isValid($val) {

		$this->_var = $val;
		$ereg = '/^'.$this->_dataType.'$/i';
		
		if (preg_match($ereg, 'int') || preg_match($ereg, 'integer')) {
			$valid_state = is_int($val);
		} else if (preg_match($ereg, 'float')) {
			$valid_state = is_float($val);
		} else if (preg_match($ereg, 'string')) {
			$valid_state = is_string($val);
		} else if (preg_match($ereg, 'array')) {
			$valid_state = is_array($val);
		} else if (preg_match($ereg, 'bool')) {
			$valid_state = is_bool($val);
		} else if (preg_match($ereg, 'null')) {
			$valid_state = is_null($val);
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
		return sprintf($this->_errorMessageTmpl, $this->_var, $this->_dataType) . "\n";
	}

}


