<?php

namespace syamgot\Validator\Exception;

use \InvalidArgumentException;

/**
 * 
 * 
 */
class LengthException extends AbValidatorsException {

	/**
	 * 
	 * 
	 * @throws \InvalidArgumentException
	 */
    public function __construct($param, $min, $max, $type) {

		if ($type > self::LOWER || $type < self::GREATER) {
			throw new InvalidArgumentException('不正な引数です.');
		}

		$this->type = $type;
		$params = array('value' => $param, 'max' => $max, 'min' => $min);
		$msg = $this->buildMessage($this->messageTmpls[$this->type], $params);
        parent::__construct($msg);
    }

	/**
	 * 
	 */
	private $messageTmpls = array(
								  self::GREATER => '{{value}} must be lower than {{max}}.' 
								, self::LOWER => '{{value}} must be greater than {{min}}.'
							);

	const GREATER = 0;
	const LOWER = 1;

}

