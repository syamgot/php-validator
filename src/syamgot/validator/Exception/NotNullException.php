<?php

namespace syamgot\Validator\Exception;

/**
 * 
 * 
 */
class NotNullException extends AbValidatorsException {

	/**
	 * 
	 */
    public function __construct($param) {
		$params = array('value' => strval($param));
		$msg = $this->buildMessage($this->messageTmpls[$this->type], $params);
        parent::__construct($msg);
    }

	/**
	 * 
	 */
	private $messageTmpls = array(
								  '{{value}} must not be null.' 
							);

}



