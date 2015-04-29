<?php
session_start();

//error reporting
ini_set('error_reporting',E_ALL ^ (E_NOTICE | E_WARNING | E_DEPRECATED));
//makes the URL neat and small
$_SERVER["PHP_SELF"]  = basename($_SERVER["PHP_SELF"]);

//Paths to important system files
define('ROOT', dirname(dirname(__FILE__)));
define('ERRORHANDLER_VIEW',ROOT.'/system/errorPages/errorHandler.view.php');
define('DATABASEERROR_VIEW',ROOT.'/system/errorPages/dataBaseError.view.php');
define('PHONEBOOK_SQL',ROOT.'/public/phonebook.sql.txt');
define('LOGFILE',ROOT.'/system/logFiles/logfile.txt');

//default values
define ('DEFAULT_CONTROLLER','home');
define ('DEFAULT_METHOD','index');

//Eager load all configuration files
foreach (glob(ROOT.'/system/config/*.php') as $filename) {
	require_once $filename;
}

//General and program errors reported here....
set_error_handler('errorHandler',E_ALL ^ (E_NOTICE | E_WARNING | E_DEPRECATED));
function errorHandler($errno, $errstr, $errfile, $errline)
{
	$TPL = array(	'errorNumber' 		=> $errno,
		'errorMessage' 		=> $errstr,
		'errorLineNumber' 	=> $errline,
		'errorFileName' 	=> $errfile,
		'time' 				=> date("F j, Y, g:i a"));

	include ERRORHANDLER_VIEW;
	exit;
}


//Lazy load classes/controllers as needed using __autoload function
//Edited by Tom 04-03-15
function __autoload ($className)
{
	//System Classes
	if (file_exists(ROOT . '/system/classes/' . strtolower($className) . '.php'))
		require(ROOT . '/system/classes/' . strtolower($className) . '.php');
	/*1.  "Controller file  ClassFileName  could not be lazy loaded"  - happens if the
	controller requested  doesn't exist in directory. */

	//Application Controllers
	else if(file_exists(ROOT . '/application/controllers/' . strtolower($className). '.php'))
		require (ROOT . '/application/controllers/' . strtolower($className). '.php');
	//Application Models
	else if(file_exists(ROOT . '/application/models/' . strtolower($className). '.php'))
		require (ROOT . '/application/models/' . strtolower($className). '.php');

	/*"Controller Class is ClassFileName not named correctly in file "  - happens if
		the class name "Example" doesn't exist in the file named "example.php".
			(note case of 1st letter in file name and class name)
	*/
	else {

	}

}
/*
require_once  ROOT . '/system/classes/' . 'controller' . '.php';
require_once  ROOT . '/system/classes/' . 'database' . '.php';
require_once  ROOT . '/system/classes/' . 'model' . '.php';
require_once  ROOT . '/system/classes/' . 'view' . '.php';
require_once  ROOT . '/application/controllers/' . 'example' . '.php';
require_once  ROOT . '/application/models/' . 'example_m' . '.php';
*/

//default conditions
$controllerName = (isset($_REQUEST["c"]) and empty($_REQUEST["c"]) == false )
	?  $_REQUEST["c"] : DEFAULT_CONTROLLER;
$methodName 	= (isset($_REQUEST["m"]) and empty($_REQUEST["m"]) == false )
	?  $_REQUEST["m"] : DEFAULT_METHOD;

//Class name is firstletter in capitol letters
$controllerName = ucfirst($controllerName);

//Instantiate controller class. Shouldn't fail, since we checked in auto_load
$controllerObj = new $controllerName;

//call controller and method 
if ((int)method_exists($controllerObj, $methodName)):
	call_user_func(array($controllerObj,$methodName));
else:
	trigger_error("Non-existent  method has been called: $controllerName, $methodName");
endif;



?>