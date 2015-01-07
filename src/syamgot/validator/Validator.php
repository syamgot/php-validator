<?php

namespace syamgot\Validator;

use \InvalidArgumentException;
use \ReflectionClass;
use \ReflectionMethod;
use \ReflectionException;

/**
 * 
 * バリデートクラスです.
 * 
 * 他のバリデートクラスをセットして、一括でバリデート処理を行うことができます。
 * <code>
 * $validator = new Validator();
 * $validator->addValidator(new LengthValidator(array(5, 10, 'sjis')));
 * $validator->addValidator(new AlumValidator());
 * if(!$validator->isValid('asdfzxcvqwer****')) {
 * 	echo $validator->getMessage();
 * }
 * </code>
 * 
 * @package validator
 * @author syamgot
 *
 */
class Validator implements IValidator {

	/**
	 * @var array
	 */
	private $validators;	

	/**
	 * @var array
	 */
	private $messages;	

	public function __construct() {
		$this->validators = array();	
		$this->messages = array();	
	}

	/**
	 * 新しいバリデートクラスを追加します.
	 *
	 * 
	 * IValidator の実装クラスであれば、そのまま追加します。
	 * <code>
	 * $validator = new Validator();
	 * $validator->addValidator(new AlumValidator());
	 * </code>
	 * 
	 * Validator名を指定してインスタンスを追加できます.
	 * Validator名は、Validator 前の文字になります(例:AlumValidator -> Alum)。
	 * その他の値も、Validatorにのコンストラクタに準じて指定して、引数とすることができます。
	 * <code>
	 * $validator = new Validator();
	 * $validator->addValidator('Ge', 0)));
	 * $validator->addValidator('Le', 1)));
	 * if(!$validator->isValid(-1)) {
	 * 	echo $validator->getMessage();
	 * }
	 * </code>
	 * 
	 * 既に同じバリデートクラスのインスタンスが追加されている場合は、上書きします。
	 * 
	 * @param IValidator 
	 * @throws InvalidArgumentException
	 */
	public function addValidator() {
		try {

			$args = func_get_args();
	
			if (count($args) === 0) {
				throw new InvalidArgumentException('引数が不正です.');
			}
			else if (count($args) === 1 && is_object($args[0])) {
				if ($args[0] instanceof IValidator) {
					$this->validators[get_class($args[0])] = $args[0];
				}
				else {
					throw new InvalidArgumentException('引数が不正です.');
				}
			}
			else {
				$classname = ucfirst(array_shift($args)).'Validator';
				$classname = __NAMESPACE__."\\$classname";
	            $class = new ReflectionClass($classname);
	            $instance = $class->newInstanceArgs($args);
				$this->validators[$classname] = $instance;
			}
			return true;
		}
		catch (ReflectionException $e) {
			echo $e->getMessage();
			return false;
		}
	}

	/**
	 * 名前を指定して、バリデートクラスのインスタンスを取得します.
	 * 
	 * 追加されていなければ、nullを返します。
	 * 
	 * @param string $name
	 */
	public function getValidator($name) {
		$name = __NAMESPACE__."\\$name"."Validator";
		return isset($this->validators[$name]) ? $this->validators[$name] : null;
	}

	/**
	 *
	 *
	 */
	public function isValid($val) {
		$valid_state = true;
		$this->messages = array();
		if (is_array($this->validators)) {
			foreach ($this->validators as $Validator) {
				if (!$Validator->isValid($val)) {
					array_push($this->messages, $Validator->getMessage());
					$valid_state = false;
				}
			}
		}

		return $valid_state;
	}

	/**
	 * 直近のエラーメッセージを配列で取得します.
	 */
	public function getMessages() {
		return $this->messages;
	}

	/**
	 *
	 *
	 */
	public function getMessage() {
		$msg = "";
		foreach ($this->messages as $errmsg) {
			$msg .= $errmsg;
		}
		return $msg;
	}

	/**
	 *
	 *
	 */
	public function __call($name, $arguments) {
		try {
			$m = new ReflectionMethod(get_class(), 'addValidator');
			array_unshift($arguments,$name);
			$m->invokeArgs($this, $arguments);
		}
		catch (Exception $e) {
			echo $e->getMessage();
			return false;
		}
		return $this;
	}

}


