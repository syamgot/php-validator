<?php

namespace syamgot\Validator;

use \InvalidArgumentException;

/**
 * 
 * バリデートクラスです.
 * 
 * 他のバリデートクラスをセットして、一括でバリデート処理を行うことができます。
 * <code>
 * $validator = new Validator();
 * $validator->addValidator(new LengthValidator(array('min' => 5, 'max' => 10, 'charset' => 'sjis')));
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
	 * 追加の方法は、二通りあります。
	 * 
	 * IValidator の実装クラスであれば、そのまま追加します。
	 * <code>
	 * $validator = new Validator();
	 * $validator->addValidator(new AlumValidator());
	 * </code>
	 * 
	 * 適切な添え字で生成した連想配列で、インスタンスを生成して追加することもできます。
	 * クラス名は、Validator_ 以下の文字になります(例:AlumValidator -> Alum)。
	 * 連想配列に 'name' と添え字をつけた値にクラス名を指定して、利用します。
	 * その他の値も、バリデートクラスに準じるように値を入れることで、引数とすることができます。
	 * <code>
	 * $validator = new Validator();
	 * $validator->addValidator((array('name' => 'GE', 'min' => 0)));
	 * $validator->addValidator((array('name' => 'LE', 'max' => 1)));
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
	public function addValidator($val) {
		if (is_array($val)) {
			$classname = $val['name'].'Validator';
			unset($val['name']);
			//require_once __DIR__ . "/$classname.php";
			$classname = __NAMESPACE__."\\$classname";
			$this->validators[$classname] = new $classname($val);
		} else if ($val instanceof IValidator) {
			$this->validators[get_class($val)] = $val;
		} else {
			throw new InvalidArgumentException('引数は配列型か、IValidatorインタフェース実装したクラスでなければなりません.');
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

}


