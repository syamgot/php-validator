<?php

namespace syamgot\Validator\Exception;

/**
 * 
 * 
 */
class RegexpException extends AbValidatorsException {

	/**
	 * 
	 */
    public function __construct($param, $pattern) {
		$params = array('value' => $param, 'pattern' => $pattern);
		$msg = $this->buildMessage($this->messageTmpls[$this->type], $params);
        parent::__construct($msg);
    }

	/**
	 * 
	 */
	private $messageTmpls = array(
								  '{{value}} does not match pattern {{pattern}}.' 
							);

}


