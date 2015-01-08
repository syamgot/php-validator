<?php

namespace syamgot\Validator\Exception;

use \InvalidArgumentException;
use \ErrorException;

/**
 * 
 * 
 */
class AbValidatorsException extends InvalidArgumentException {

	/**
	 * 
	 */
    public function __toString() {
        return __CLASS__ . ": [{$this->code}]: {$this->message}\n";
    }

	/**
	 * 
	 * 
	 */
	public function getType() {
		return $this->type;
	}
	
	protected $type = 0;

	/**
	 * 
	 * @param string $tmpl
	 * @param array $params 
	 * @return string
	 */
	protected function buildMessage($tmpl, array $params) {
		$msg = $tmpl;
		foreach ($params as $key => $val) {
			$val = is_array($val) ? 'Array' : strval($val);
			$msg = preg_replace('/{{'.$key.'}}/i', $val, $msg);
		}
		return $msg;
	}

}


