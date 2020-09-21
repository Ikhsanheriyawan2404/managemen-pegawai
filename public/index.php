<?php 
session_start();

//membuat konstanta ROOT
define('ROOT', dirname(dirname(__FILE__)));
define('DS', DIRECTORY_SEPARATOR);

//menyimpan data url pada variabel $url
$url = isset($_GET['url']) ? $_GET['url'] : '';

//memanggil file konfigurasi library yang dibutuhkan
// core sistem untuk model, view, dan controller
require_once (ROOT .'/config/config.php');
require_once (ROOT .'/library/model.class.php');
require_once (ROOT .'/library/view.class.php');
require_once (ROOT .'/library/controller.class.php');

// Membuat function autload
// function __autoload($className){
//    $dir = ROOT.DS.str_replace("\\", DS, $className).".php";
//    if(file_exists($dir)) require_once($dir);
// }

// Deprecated : __autoload() is deprecated, use spl_autoload_register() instead in public\index.php

spl_autoload_register(function ($className)
{
	$dir = ROOT.DS.str_replace("\\", DS, $className) . ".php";
	(file_exists($dir)) ? require_once($dir) : null;
});

//membuat function untuk mengatur error
function setReporting()
{
	if (DEVELOPMENT_ENVIRONMENT == true) {
		error_reporting(E_ALL);
		ini_set('display_error', 'On');
	} else {
		error_reporting(E_ALL);
		ini_set('display_error', 'Off');
		ini_set('log_errors', 'On');
		ini_set('error_log', ROOT.'/tmp/log/error.log');
	}
}

//membuat function utnuk memanggil controller sesuai nilai $url
function callHook()
{
	global $url;

	$urlArray       = explode('/', $url);
	$controller     = (!empty($urlArray[0])) ? $urlArray[0] : DEFAULT_CONTROLLLER;
	$controllerPath = ROOT . '/application/controllers/' . ucfirst($controller) . 'Controller.php';

	if (file_exists($controllerPath)) {
		array_shift($urlArray);
		$action    = (!empty($urlArray[0])) ? $urlArray[0] : 'index';
		array_shift($urlArray);
		$parameter = $urlArray;

		require_once $controllerPath;
		$controllerName = ucfirst($controller) . 'Controller';
		$object         = new $controllerName;

		if (method_exists($controllerName, $action)) {
			call_user_func_array([$object, $action], $parameter);
		} else die('Action not found!');
	} else die('Controller not found!');
}

setReporting();
callHook();
