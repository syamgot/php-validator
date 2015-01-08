<?php

namespace syamgot\Validator\Exception;

/**
 * 
 * 
 */
class AlumException extends AbValidatorsException {

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
								  '{{value}} must be alphabet or number.' 
							);

}

