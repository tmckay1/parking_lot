<?php

//turn on error reporting
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

//define constants
define("WEBROOT","http://".$_SERVER['SERVER_NAME'].'/pl');
define("INCROOT", WEBROOT.'/inc');
define("IMGROOT", INCROOT.'/img');
define("DOCROOT", $_SERVER['DOCUMENT_ROOT'].'/pl');
if(isset($_GET['dbg'])){
	define("DEBUG_MODE",1);
}else{
	define("DEBUG_MODE",0);
}

//setup config
require DOCROOT . '/inc/config.php';

// Setup auto load for load the class files without manually include file by file.
require DOCROOT . '/inc/vendor/Autoload.php';
$Autoload = new \Vendor\Autoload();
$Autoload->register();
$Autoload->addNamespace('Parking', DOCROOT . '/parking');
unset($Autoload);

//setup debugger
require DOCROOT . '/inc/Debugger.php';
$debugger = new Debugger();

//define parking lot
define("PARKING_LOT_ID",1);