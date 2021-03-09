<?php
/**
 * 
 * outlet前台入口
 */
// Report all errors except E_NOTICE
// This is the default value set in php.ini
ini_set('display_errors', 1);
ini_set('log_errors', 1);
error_reporting(E_ALL);
require_once('../../bootstrap.php');

// dispatcher 
if (isset($_GET["kata"])) {
	// URL REWRITE was used
	$kataUrl = is($_GET['kata'],'');
	// var_dump($kataUrl);
	$paramList= explode('/', $kataUrl);
	// var_dump($paramList);
    if (count($paramList) == 3) {
        // Like /foo/bar/oops
        $controllerType = isset($paramList[0])?($paramList[0]) : dispatcher::FRONTEND;
        $controllerName=isset($paramList[1])?($paramList[1]):"main";
        $actionName = isset($paramList[2])?(empty($paramList[2])?"index":$paramList[1]):"index";
    } else{
        $controllerType = dispatcher::FRONTEND;
        $controllerName=isset($paramList[0])?($paramList[0]):"main";
        $actionName = isset($paramList[1])?(empty($paramList[1])?"index":$paramList[1]):"index";
    }
} else {
	$controllerName = isset($_REQUEST["controller"]) ? ($_REQUEST["controller"]) : "main";
	$actionName = isset($_REQUEST["action"]) ? ($_REQUEST["action"]) : "index";
    $controllerType = dispatcher::FRONTEND;
}

try{		
    $d = new dispatcher();
    $d->setControllerType($controllerType)
      ->setController($controllerName)
      ->setAction($actionName)
      ->run();
} catch (Exception $e ) {
    print ($e->getMessage());
}
/* EOF */