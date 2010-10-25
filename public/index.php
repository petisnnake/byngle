<?php
define('DS', DIRECTORY_SEPARATOR);
define('ROOT', dirname(dirname(__FILE__)));

require(ROOT . DS . 'config' . DS . 'config.php');

function setReporting()	
{
	if(DEVELOPMENT_ENVIORMENT == true)
	{
		error_reporting(E_ALL);
		ini_set('display_errors', 'On');	
	}
	else
	{
		error_reporting(E_ALL);
		ini_set('display_errors', 'Off');
		ini_set('log_errors', 'On');
		ini_set('error_log', ROOT . DS . 'tmp' . DS . 'logs' . DS . 'error.log');
	}	
}

setReporting();

if(isset($_GET['url']))
{
	$url = explode('/', $_GET['url']);
	$controller_url = array_shift($url);
	$action = array_shift($url);
	$query = $url;
	
	$controller = ucwords($controller_url);
	$model = rtrim($controller, 's');
	$controller = ucwords($controller_url) . 'Controller';
	if(!$action)
	{
		$action = 'index';
	}
}
else
{
	$controller_url = 'index';
	$controller = 'IndexController';
	$model = 'Index';
	$action = 'index';
	$query = array();
}

/** Autoloading all classes that are required **/
function __autoload($className)
{
	if(file_exists(ROOT . DS . 'lib' . DS . strtolower($className) . '.class.php'))
	{
		require_once(ROOT . DS . 'lib' . DS . strtolower($className) . '.class.php');		
	}
	else if(file_exists(ROOT . DS . 'application' . DS . 'controllers' . DS . strtolower($className) . '.php'))
	{
		require_once(ROOT . DS . 'application' . DS . 'controllers' . DS . strtolower($className) . '.php');		
	}
	else if(file_exists(ROOT . DS . 'application' . DS . 'models' . DS . strtolower($className) . '.php'))
	{
		require_once(ROOT . DS . 'application' . DS . 'models' . DS . strtolower($className) . '.php');		
	}
	else 
	{
		echo "__autoload error";		
	}
}

/** Loading the controller and the action **/
$dispatch = new $controller($model, $controller_url, $action);
if(method_exists($controller, $action))
{
	call_user_func_array(array($dispatch, $action), $query);	
}
else 
{
	echo "controller call_user_func_array error";	
}

//echo 'controller = ' . $controller . '; model = ' . $model . '; action = ' . $action . '; query string = ' . implode('/', $query);
?>