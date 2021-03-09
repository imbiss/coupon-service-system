<?php 
/**
 * 
 * outlet后台扩展程序入口
 */
// Report all errors except E_NOTICE
// This is the default value set in php.ini
ini_set('display_errors', 1);
ini_set('log_errors', 1);
//ini_set('error_log', dirname(__FILE__) . '/error_log.txt');
error_reporting(E_ALL);

require_once ( dirname(__FILE__) . "/../../bootstrap.php");//启动bootstrap

// dispatcher
if (isset($_GET["kata"])) {
    // URL REWRITE was used
    $kataUrl = is($_GET['kata'],'');
    $paramList= explode('/', $kataUrl);

    $controllerType = dispatcher::BACKEND;
    $controllerName=isset($paramList[0])?($paramList[0]):'main';
    $actionName = isset($paramList[1])?(empty($paramList[1])?"index":$paramList[1]):"index";

} else {
    // direct call without ReWrite
    $controllerName = isset($_REQUEST["controller"]) ? ($_REQUEST["controller"]) : 'main';
    $actionName = isset($_REQUEST["action"]) ? ($_REQUEST["action"]) : "index";
}
/*
$controllerName = isset($_REQUEST["controller"]) ? ($_REQUEST["controller"]) : "main";
$actionName = isset($_REQUEST["action"]) ? ($_REQUEST["action"]) : "index";
*/
		
$d = new dispatcher();
$d->setControllerType(dispatcher::BACKEND)
  ->setController($controllerName)
  ->setAction($actionName)
  ->run();
/* EOF */
