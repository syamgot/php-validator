<?php

namespace syamgot\Validator;

use \syamgot\Validator\Exception\AbValidatorsException;
use \syamgot\Validator\Exception\ValidatorException;
use \ReflectionClass;
use \ReflectionMethod;
use \ReflectionException;
use \ErrorException;
use \InvalidArgumentException;

/**
 * 
 * バリデートクラスです.
 * 
 * 他のバリデートクラスをセットして、一括でバリデート処理を行うことができます。
 * <code>
 * $validator = new Validator();
 * $validator->addValidator(new LengthValidator(array(5, 10, 'sjis')));
 * $validator->addValidator(new AlnumValidator());
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
	private $validators = array();

	/**
	 * 新しいバリデートクラスを追加します.
	 *
	 * 
	 * IValidator の実装クラスであれば、そのまま追加します。
	 * <code>
	 * $validator = new Validator();
	 * $validator->addValidator(new AlnumValidator());
	 * </code>
	 * 
	 * Validator名を指定してインスタンスを追加できます.
	 * Validator名は、Validator 前の文字になります(例:AlnumValidator -> Alnum)。
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
	 * @throws ValidatorException
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
				$classname = (string) array_shift($args);
				$classname = (preg_match('/^not/i',$classname))
								? 'Not'.ucfirst((substr($classname,3)))
								: ucfirst($classname);
				if ($classname === '') {
					throw new InvalidArgumentException('引数が不正です.');
				}	
				$classname = $classname.'Validator';
				$classname = 'syamgot\Validator\Validators\\'.$classname;
	            $class = new ReflectionClass($classname);
	            $instance = $class->newInstanceArgs($args);
				$this->validators[$classname] = $instance;
			}
			return true;
		}
		catch (ReflectionException $e) {
			throw new ValidatorException($e->getMessage());
			return false;
		}
		catch (ErrorException $e) {
			throw new ValidatorException($e->getMessage());
			return false;
		}
		catch (InvalidArgumentException $e) {
			throw new ValidatorException($e->getMessage());
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
		$name = ucfirst($name).'Validator';
		$name = 'syamgot\Validator\Validators\\'.$name;
		return isset($this->validators[$name]) ? $this->validators[$name] : null;
	}

	/**
	 *
	 *
	 * @param mixed $val チェックする値
	 * @param boolean $throw エラーが出た時に例外を発行しない
	 * @throw ValidatorException チェックでエラーが出た時
	 * @return boolean
	 */
	public function isValid($val, $throw = true) {

		$exception = null;

		if (is_array($this->validators)) {
			foreach ($this->validators as $Validator) {
				try {
					$Validator->isValid($val);
				}
				catch (AbValidatorsException $e) {
					if ($exception === null) {
						$exception = new ValidatorException('validation error accrued.');
					}
					$exception->addException($e);
				}
			}
		}

		if ($exception !== null) {
			if ($throw === true) {
				throw $exception;
			}
			return false;
		}

		return true;
	}

	/**
	 *
	 * @throws ValidatorException
	 */
	public function __call($name, $arguments) {
		try {
			$m = new ReflectionMethod(get_class(), 'addValidator');
			array_unshift($arguments,$name);
			$m->invokeArgs($this, $arguments);
		}
		catch (Exception $e) {
			throw new ValidatorException($e->getMessage());
		}
		return $this;
	}

	/**
	 *
	 * @throws ValidatorException
	 */
	static public function __callStatic($name, $arguments) {
		$validator = new static();
		return $validator->__call($name, $arguments);
	}

}




