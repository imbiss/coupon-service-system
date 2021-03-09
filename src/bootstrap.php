<?php
/**
 * Bootstrap
 *
 */

use Doctrine\ORM\Tools\Setup;
use Doctrine\ORM\EntityManager;
use Monolog\Logger;
use Monolog\Handler\StreamHandler;



$lib = dirname(__FILE__) . "/lib/";

require_once ( $lib . "../config/core.php");
require_once ( $lib . "AppConfig.php" );
require_once ( $lib . "kata_functions.php");
require_once ( $lib . "class_registry.php");
require_once ( $lib . "dbo_interface.php");
require_once ( $lib . "dbo_mysql.php");
require_once ( $lib . "model.php");
require_once ( $lib . "AppModel.php");
require_once ( $lib . "AppView.php");
require_once ( $lib . "AppController.php");
require_once ( $lib . "dispatcher.php");

require_once dirname(__FILE__) . '/vendors/Zend/Loader/Autoloader.php';

/* STEP 1: Start Zend Autoload */
Zend_Loader_Autoloader::resetInstance();
$loader = Zend_Loader_Autoloader::getInstance();
$loader->registerNamespace('Zend_');
$loader->registerNamespace('Outlet_');



/* STEP 2: Create registry (global) */
$registry = new Zend_Registry(array(), ArrayObject::ARRAY_AS_PROPS);
Zend_Registry::setInstance($registry);



/* STEP 3: Load config */
$config = new Zend_Config(array(),true);
$configAppIni = new Zend_Config_Ini(dirname(__FILE__)  . "/config/application.ini", APPENV);
$config->merge($configAppIni);
Zend_Registry::set("app_config", $config);


/* STEP 5: Add shop config  */
define('APP_DB_DRIVER', Zend_Registry::getInstance()->app_config->resources->database->driver);
define('APP_DB_HOST', Zend_Registry::getInstance()->app_config->resources->database->host);
define('APP_DB_USERNAME', Zend_Registry::getInstance()->app_config->resources->database->username);
define('APP_DB_PASSWORD', Zend_Registry::getInstance()->app_config->resources->database->password);
define('APP_DB_NAME', Zend_Registry::getInstance()->app_config->resources->database->dbname);
define('APP_DB_PREFIX', Zend_Registry::getInstance()->app_config->resources->database->prefix);
define('APP_DB_ENCODING', Zend_Registry::getInstance()->app_config->resources->database->encoding);
require_once ( $lib . "../config/database.php");

/* STEP 6 Composer Autoload */
require_once dirname(__FILE__) . '/vendor/autoload.php';


/* STEP 6: Doctrine configuration */
// Create a simple "default" Doctrine ORM configuration for Annotations
//$isDevMode = true;
//$config = Setup::createAnnotationMetadataConfiguration(array(__DIR__."/doctrine/src"), $isDevMode);
// or if you prefer yaml or XML
//$config = Setup::createXMLMetadataConfiguration(array(__DIR__."/config/xml"), $isDevMode);
//$config = Setup::createYAMLMetadataConfiguration(array(__DIR__."/config/yaml"), $isDevMode);

// database configuration parameters
/*$conn = array(
    'driver' => 'pdo_mysql',
    'path' => __DIR__ . '/db.mysql',
);
*/
// obtaining the entity manager
//$entityManager = EntityManager::create($conn, $config);

// create a log channel
$log = new Logger('appLogger');
$log->pushHandler(new StreamHandler(Zend_Registry::getInstance()->app_config->logger->output->path , Logger::DEBUG));
Zend_Registry::set("AppLog", $log);
$log->addInfo('Applicaiton start.');



