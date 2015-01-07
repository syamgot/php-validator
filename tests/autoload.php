<?php


require __DIR__.'/SplClassLoader.php';

$l = new SplClassLoader('syamgot', __DIR__ . '/../src/');
$l->register();

