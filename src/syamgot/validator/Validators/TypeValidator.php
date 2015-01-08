<?php

namespace syamgot\Validator\Validators;

use syamgot\Validator\IValidator;
use syamgot\Validator\Exception\TypeException;
use \InvalidArgumentException;

/**
 * 値の型を判定するクラスです.
 * 
 * int(integer), float, string, array, bool, null を判定することができます。
 * 
 * @package validator
 * @author syamgot
 */
class TypeValidator implements IValidator {

	private $val;
	private $type;
	private $types = array('int', 'integer', 'float', 'string', 'array', 'bool', 'null');
	
	/**
	 * 
	 * 新しい TypeValidator インスタンスを作成します.
	 * 
	 * @param string $type
	 */
	public function __construct($type) {
		$this->setDataType($type);
	}
	
	/**
	 * チェックしたいデータ型をセットします.
	 * 
	 * @param mixed $dataType
	 * @throws InvalidArgumentException チェック対象外のデータ型であれば、エラー
	 */
	public function setDataType($type) {
		if (!in_array($type, $this->types)) {
			throw new InvalidArgumentException('不正な引数です.');
		}
		$this->type = (string) $type;
	}

	/**
	 * (non-PHPdoc)
	 * @see IValidator::isValid()
	 */
	public function isValid($val) {

		$this->val = $val;
		$ereg = '/^'.$this->type.'$/i';
		
		if (preg_match($ereg, 'int') || preg_match($ereg, 'integer')) {
			$state = is_int($val);
		} else if (preg_match($ereg, 'float')) {
			$state = is_float($val);
		} else if (preg_match($ereg, 'string')) {
			$state = is_string($val);
		} else if (preg_match($ereg, 'array')) {
			$state = is_array($val);
		} else if (preg_match($ereg, 'bool')) {
			$state = is_bool($val);
		} else if (preg_match($ereg, 'null')) {
			$state = is_null($val);
		}

		if ($state === false) {
			throw new TypeException($this->val, $this->type);
			return false;
		}
		return true;

	}

}



