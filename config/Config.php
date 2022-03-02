<?php
define('BASEPATH', "/kf6012/coursework/part1/");
define('USER_DATABASE', 'db/user.sqlite');
define('SECRET_KEY', 'ZJeThkqVXc61X0HwMy7dgOt404eyvrtu');
define('DEVELOPMENT_MODE', true);

ini_set('display_errors', DEVELOPMENT_MODE);
ini_set('display_startup_errors', DEVELOPMENT_MODE);

include 'config/Autoload.php';
spl_autoload_register("autoload");

include 'config/HTMLExceptionHandler.php';
include 'config/JSONExceptionHandler.php';
set_exception_handler("JSONExceptionHandler");

include 'config/ErrorHandler.php';
set_error_handler("ErrorHandler");
