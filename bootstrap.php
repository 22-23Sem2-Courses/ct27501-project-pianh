<?php

require_once 'libraries/Psr4AutoloaderClass.php';

$loader = new Psr4AutoloaderClass;

$loader->register();

$loader->addNamespace(
	'App\CT275',
	__DIR__ . '/src'
);
