<?php
define('BASEPATH', "/veterans_app/dev/VeteransAPI/");
define('USER_DATABASE', 'db/user.db');
define('SECRET_KEY', 'dIjf7u7h2A1yceuHHk87ff675GmS2Gad');
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