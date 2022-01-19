<?php

define('DS', DIRECTORY_SEPARATOR);
define('ROOT', dirname(__FILE__));


if (file_exists(ROOT . DS . 'vendor' . DS . 'autoload.php')){
	require(ROOT . DS . 'vendor' . DS . 'autoload.php');
}

require(ROOT . DS . 'application' . DS . 'config' . DS . 'config.php');

require(ROOT . DS . 'application' . DS . 'libs' . DS . 'application.php');
require(ROOT . DS . 'application' . DS . 'libs' . DS . 'controller.php');

new Application();

