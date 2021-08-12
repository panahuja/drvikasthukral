<?php

session_start();

define( 'DB_HOST', 'localhost' ); // set database host

define( 'DB_USER', 'drvikas_drvikast' ); // set database user

define( 'DB_PASS', ';@1#MaNbC!=w' ); // set database password

define( 'DB_NAME', 'drvikas_drvikasthukral' ); // set database name

define( 'SEND_ERRORS_TO', 'webkeon.sushil@gmail.com' ); //set email notification email address

define( 'DISPLAY_DEBUG', true ); //display db errors?

//Initiate the class

define('APPX_URL', 'http://www.drvikasthukral.com/');

define('APP_URL', 'http://www.drvikasthukral.com/blog/');

define('APPC_URL', 'http://www.drvikasthukral.com/blog/securelogin/');

define('APP_PATH', '');

define('CLASSES', APP_PATH.'classes/');

define('IMAGES_PATH', APP_PATH.'images/');

define('IMAGES_URL', APP_URL.'images/');

define('CSS_PATH', APP_PATH.'css/');

define('CSS_URL', APP_URL.'css/');

define('JS_PATH', APP_PATH.'js/');

define('JS_URL', APP_URL.'images/');

define('EXE', '.html');

include(CLASSES.'connect.class.php');

include(CLASSES.'functions.class.php');

date_default_timezone_set('Asia/Calcutta');

ini_set('session.gc_maxlifetime', 30);

?>

