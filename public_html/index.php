<?php

// initialize the framework, set constants, etc.
initFramework();
// find and execute the proper controller
executeController();

function initFramework()
{
	// Parse the configuration file
	$config = parse_ini_file('./config.ini',true);
	
	date_default_timezone_set('America/New_York');
	
	/* Error reporting is set to show all except notices */
	error_reporting(E_ALL ^ E_NOTICE);
	
	// define site name
	define("PF_SITE_NAME", $config['siteName']);
	
	/*
	* Turn on error reporting for testing purposes. However, make sure this is off 
	* when the site is live as it could possibly be a security issue.
	*/
	ini_set('display_errors', $config['debugMode']);
	
	// Define some paths
	define("PF_ROOT_PATH", $config['paths']['rootDir']);
	define("PF_ROOT_URL", $config['paths']['url']);
}

function executeController()
{
	// The first step is to break up the user request given in the
	// Uri and figure out the path to the controller.
	$request = trim($_GET['request'], "/ ");
	
	if ($request != '') {
	    // Using the URL segments, construct the name of the class.
	    // Note: The class name is mapped to the directory structure.
	    $reqSegments = explode("/", $request);
	}
	
	$controllerName = 'App_Pages_';
	$controllerName .= ($reqSegments[0])?$reqSegments[0]:'Index';
	$controllerName .= '_Controller';
	
	$actionName = ($reqSegments[1])?$reqSegments[1]:'index';

	if (class_exists($controllerName)) {
		if (method_exists($controllerName, $actionName)) {
			$controller = new $controllerName();
			$controller->$actionName();
		} else {
			die('Page not found');
		}
	} else {
		die('Page not found');
	}
}


/*
* Plaxforms autoload function. It is called automatically by PHP if a class
* needs to be called. This function defines the algorithm to perform the search.
*/
function __autoload($className)
{ 
    /*
    * All class names are mapped to their respective directory locations relative
    * to the root folder. For example the class "App_User_Action_Login" will be
    * stored in "/app/user/action/login.php". We will use this scheme to locate all
    * classes.
    */
    $className = trim($className);
    
    /* 
    * Quick way to do the conversion is to replace all the "_" with "/" and concatinate
    * the path to the root dir, and the ".php" extension.
    *
    * eg: App_Index_Action_Index => .../root/App/Index/Action/Index.php 
    */
    $classFile = strtolower(PF_ROOT_PATH . "/" . str_replace("_", "/", $className) . ".php");

    /* Attempt to load the class file */
    if (file_exists($classFile) == true) {
        require_once($classFile);
        return true;
    } else {
        return false;
    }
}


?>
