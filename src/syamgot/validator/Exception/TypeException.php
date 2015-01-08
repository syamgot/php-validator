<?php

namespace syamgot\Validator\Exception;

use \InvalidArgumentException;

/**
 * 
 * 
 */
class TypeException extends AbValidatorsException {

	/**
	 * 
	 * 
	 */
    public function __construct($param, $type) {
		$params = array('value' => $param, 'type' => $type);
		$msg = $this->buildMessage($this->messageTmpls[$this->type], $params);
        parent::__construct($msg);
    }

	/**
	 * 
	 */
	private $messageTmpls = array(
								'{{value}} data type must be {{type}}.' 
							);

}




