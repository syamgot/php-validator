<?php

namespace syamgot\Validator\Exception;

use \InvalidArgumentException;
use \syamgot\Validator\Exception\AbValidatorsException;

/**
 * 
 * 
 */
//class ValidatorException extends InvalidArgumentException {
class ValidatorException extends \Exception {

	/**
	 * 
	 */
	public function getMessages() {
		$msgs = array();
		foreach ($this->exceptions as $exception) {
			array_push($msgs, $exception->getMessage());
		}
		return $msgs;
	}

	/**
	 * 
	 */
	public function addException(AbValidatorsException $exception) {
		$this->exceptions[] = $exception;
	}

	private $exceptions = array();

}



