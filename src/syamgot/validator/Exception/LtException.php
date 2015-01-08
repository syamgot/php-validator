<?php

namespace syamgot\Validator\Exception;

use \InvalidArgumentException;

/**
 * 
 * 
 */
class LtException extends AbValidatorsException {

	/**
	 * 
	 * 
	 */
    public function __construct($param, $max) {
		$params = array('value' => $param, 'max' => $max);
		$msg = $this->buildMessage($this->messageTmpls[$this->type], $params);
        parent::__construct($msg);
    }

	/**
	 * 
	 */
	private $messageTmpls = array(
								'{{value}} must be lower than {{max}}.' 
							);

}


