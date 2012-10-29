<?

ini_set("log_errors" , "1");
ini_set("error_log" , "php_error.log");
ini_set("display_errors" , "0");

require_once('lib/functions.php');
require_once('lib/dispatcher.php');
require_once('lib/classloader.php');

$maintenance = settings::get('maintenance');

if ($maintenance)
    dispatcher::$_url = $maintenance;
else
    dispatcher::$_url = $_SERVER['REQUEST_URI'];

if (dispatcher::$_url == "/")
	dispatcher::$_url = "/index.html";

$arouter = dispatcher::make_router();

dispatcher::$_pagename = $arouter->getpagename();

//Create an instance of the page
$apage = dispatcher::make_page();

//Run the page :)
$apage->initialize();

if ($apage->autorender)
	$apage->render($apage->layout, $apage->viewfile);

$apage->shutdown();

?>
