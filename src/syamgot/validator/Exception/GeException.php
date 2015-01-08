<?php

namespace syamgot\Validator\Exception;

use \InvalidArgumentException;

/**
 * 
 * 
 */
class GeException extends AbValidatorsException {

	/**
	 * 
	 * 
	 */
    public function __construct($param, $min) {
		$params = array('value' => $param, 'min' => $min);
		$msg = $this->buildMessage($this->messageTmpls[$this->type], $params);
        parent::__construct($msg);
    }

	/**
	 * 
	 */
	private $messageTmpls = array(
								'{{value}} must be greater equal {{min}}.' 
							);

}




