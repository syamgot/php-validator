<?php

// ----------------------------------------
// autoload
// 
// @see http://www.php-fig.org/psr/psr-0/
// 

function autoload($className){

	$className = ltrim($className, '\\');
	$fileName  = '';
	$namespace = '';
	if ($lastNsPos = strripos($className, '\\')) {
		$namespace = substr($className, 0, $lastNsPos);
		$className = substr($className, $lastNsPos + 1);
		$fileName  = str_replace('\\', DIRECTORY_SEPARATOR, $namespace) . DIRECTORY_SEPARATOR;
	}
	$fileName .= str_replace('_', DIRECTORY_SEPARATOR, $className) . '.php';

	//
	$fileName = __DIR__.'/../src/'.$fileName;
	
	require $fileName;
}

spl_autoload_register('autoload');

?>
