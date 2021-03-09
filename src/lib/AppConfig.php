<?php
/**
 * 德联大巴后台扩展配置
 * 
 * @var unknown_type
 */
define("DS", "/");
define("ROOT", dirname(__FILE__) . "/../");
define("LIB", dirname(__FILE__) . DS );
define("DEBUG", 0);
define("TMPPATH", dirname(__FILE__) . "/../temp/");
define("KATATMP", dirname(__FILE__) . "/../temp/");
require_once (LIB.  "class_registry.php");
require_once (LIB . "kata_functions.php");
require_once (LIB . "basics.php");



/**
 * validation string define to check if string is not empty
 * @deprecated 31.04.2009
 */
define('VALID_NOT_EMPTY', '/.+/');
/**
 * @deprecated 31.04.2009
 * validation string define to check if string is numeric
 */
define('VALID_NUMBER', '/^[0-9]+$/');

/**
 * @deprecated 31.04.2009
 * validation string define to check if string is an email-address
 */
define('VALID_EMAIL', '/\\A(?:^([a-z0-9][a-z0-9_\\-\\.\\+]*)@([a-z0-9][a-z0-9\\.\\-]{0,63}\\.(com|org|net|biz|info|name|net|pro|aero|coop|museum|[a-z]{2,4}))$)\\z/i');

/**
 * @deprecated 31.04.2009
 * validation string define to check if string is a numeric year
 */
define('VALID_YEAR', '/^[12][0-9]{3}$/');


/* locale auf Holländisch setzen 
 * mac: de_DE
 * live: de_DE.utf8
 * */
/*
$i = 0;
$lc_all = array("de_DE.utf8", "de_DE");
for($i=0; $i<sizeof($lc_all); $i++) {
	if (setlocale (LC_ALL, $lc_all[$i])) {
		//echo $lc_all[$i] . "OK";
		break;
	} 
}
if ($i>=sizeof($lc_all)){ 
	throw new Exception('Set Local Failed.');
}
*/

//date.timezone
/**
 * timezone to use, or a strict error will raise its ugly head
 */
define('TZ','Europe/Berlin');
date_default_timezone_set(TZ);

/* set currency format */
//setlocale(LC_MONETARY, 'de_DE@euro');

// define("MONEY_FORMAT", "%=*^-14#8.2i"); //％ EUR ^不显示千分位，=*使用*作为填充符， -右对齐 14位
define("MONEY_FORMAT",  "%= 14#8.2i"); // 3,36 EUR
define("MONEY_FORMAT_SHORT", "%= -!14#8.2n"); //3,36 EUR
define("MONEY_LOCAL_MONETARY", 'de_DE.utf8'); // define the setlocal string

 

/* FOR PHP ON WIN32 THAT  */
if (!function_exists('money_format')) {
	require_once (dirname(__FILE__) . '/../vendors/money_format.php');
}

// autoload
$path = dirname(__FILE__) . '/../vendors/';
set_include_path(get_include_path() . PATH_SEPARATOR . $path);

/*
require_once ('Zend/Loader/Autoloader.php');
Zend_Loader_Autoloader::resetInstance();
$loader = Zend_Loader_Autoloader::getInstance();
$loader->registerNamespace('Zend_');
$loader->registerNamespace('phpmailer_');
*/


/* EOF */