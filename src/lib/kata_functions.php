<?php

/**
 * several functions needed by kata
 *
 * Kata - Lightweight MVC Framework <http://www.codeninja.de/>
 * Copyright 2007-2009 mnt@codeninja.de, gameforge ag
 *
 * Licensed under The GPL License
 * Redistributions of files must retain the above copyright notice.
 * @package kata_internal
 */
require_once (dirname(__FILE__) . "/AppConfig.php");
/**
 * include files depending on name, if class is needed 
 *
 * @param string $cname classname
 */
function kataAutoloader($classname) {
	$cname= strtolower($classname);
	switch ($cname) {
		case 'appmodel' :
			if (file_exists(ROOT.'models'.DS.'app_model.php')) {
				require ROOT.'models'.DS.'app_model.php';
			} else {
				require LIB.'models'.DS.'app_model.php';
			}
			break;

		case 'appcontroller' :
			if (file_exists(ROOT.'controllers'.DS.'app_controller.php')) {
				require ROOT.'controllers'.DS.'app_controller.php';
			} else {
				require LIB.'controllers'.DS.'app_controller.php';
			}
			break;

		case 'scaffoldcontroller' :
			require LIB.'controllers'.DS.'scaffold_controller.php';
			break;

			/*** GF_SPECIFIC ***/
		case substr($classname, 0, 3) == 'GF_' or substr($classname, 0, 5) == 'Zend_' or substr($classname, 0, 6) == 'ZendX_' :
			require str_replace('_', '/', $classname).'.php';
			break;
			/*** /GF_SPECIFIC ***/
			
		case substr($cname, -9, 9) == 'component' :
			$cname= substr($cname, 0, -9);
			/**
            if (file_exists(LIB.'controllers'.DS.'components'.DS.$cname.'.php')) {
				require LIB.'controllers'.DS.'components'.DS.$cname.'.php';
				break;
			} */
            $fileUnderLib = LIB.'components'.DS.$cname.'.php';
            if (file_exists($fileUnderLib)) {
                require $fileUnderLib;
                break;
            }
			require ROOT.'controllers'.DS.'components'.DS.$cname.'.php';
			break;

		case substr($cname, -6, 6) == 'helper' :
			$cname= substr($cname, 0, -6);
			if (file_exists(LIB.'views'.DS.'helpers'.DS.$cname.'.php')) {
				require LIB.'views'.DS.'helpers'.DS.$cname.'.php';
				break;
			}
			require ROOT.'views'.DS.'helpers'.DS.$cname.'.php';
			break;

		case substr($cname, -7, 7) == 'utility' :
			if (file_exists(LIB.'utilities'.DS.$cname.'.php')) {
				require LIB.'utilities'.DS.$cname.'.php';
				break;
			}
			require ROOT.'utilities'.DS.$cname.'.php';
			break;

		case file_exists(LIB.$cname.'.php') :
			kataUse($cname);
			break;

		case 'memcache' :
			break;

	}
}
spl_autoload_register('kataAutoloader');


/**
 * internal function to send kata debug info to the browser. just define your own function if you want firebug or something like it
 */
if (!function_exists('kataDebugOutput')) {
	/**
	 * @ignore
	 * @param mixed $var variable to dump
	 * @param bool $isTable if variable is an array we use a table to display each line
	 */
	function kataDebugOutput($var= null, $isTable= false) {
		if (DEBUG < 2) {
			return;
		}
		if ($isTable) {
			echo '<table style="text-align:left;direction:ltr;border:1px solid red;color:black;background-color:#e8e8e8;border-collapse:collapse;text-align:left;direction:ltr;">';
			foreach ($var as $row) {
				echo '<tr>';
				foreach ($row as $col) {
					echo '<td style="border:1px solid red;padding:2px;">'.$col.'</td>';
				}
				echo '</tr>';
			}
			echo '</table>';
		} else {
			echo '<pre style="text-align:left;direction:ltr;border:1px solid red;color:black;background-color:#e8e8e8;padding:3px;text-align:left;direction:ltr;">'.$var.'</pre>';
		}
	}
}


/**
 * return the shortend path of the file currently begin executed
 * @return string
 */
function kataGetLineInfo() {
	return;
	$nestLevel= -1;
	$bt= debug_backtrace();
	while ($nestLevel++ < count($bt)) {
		if (empty ($bt[$nestLevel]['file']))
			continue;
		foreach (array (
				LIB,
				ROOT.'utilities'.DS
			) as $test) {
			if (substr($bt[$nestLevel]['file'], 0, strlen($test)) == $test)
				continue 2;
		}
		break;
	}
	return basename($bt[$nestLevel]['file']).':'.$bt[$nestLevel]['line'];
}


/**
 * return stacktrace-like information about the given variable
 * @return string
 */
function kataGetValueInfo($val) {
	if (is_null($val)) {
		return 'null';
	}
	if (is_array($val)) {
		return 'array['.count($val).']';
	}
	if (is_bool($val)) {
		return ($val ? 'true' : 'false');
	}
	if (is_float($val) || is_int($val) || is_long($val) || is_real($val)) {
		return 'num:'.$val;
	}
	if (is_string($val)) {
		return 'string['.strlen($val).']='.substr($val, 0, 16);
	}
	if (is_resource($val)) {
		return 'resource'.get_resource_type($val);
	}
	if (is_object($val)) {
		return 'object';
	}
	return '?';
}


/**
 * create a directory in TMPPATH and check if its writable
 */
function kataMakeTmpPath($dirname) {
	if (!file_exists(KATATMP.$dirname.DS)) {
		if (!mkdir(KATATMP.$dirname, 0770, true)) {
			throw new Exception("kataMakeTmpPath: cant create temporary path " . KATATMP . $dirname);
		}
	}
	if (!is_writable(KATATMP.$dirname)) {
		throw new Exception("kataMakeTmpPath: ".KATATMP."$dirname is not writeable");
	}
}


/**
 * load files from the from LIB-directory
 * @param string filename without .php
 */
function kataUse() {
	$args= func_get_args();
	foreach ($args as $arg) {
		require_once (LIB.strtolower($arg).'.php');
	}
}


/**
 * This file is part of the array_column library
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 *
 * @copyright Copyright (c) 2013 Ben Ramsey <http://benramsey.com>
 * @license http://opensource.org/licenses/MIT MIT
 */

if (!function_exists('array_column')) {

    /**
     * Returns the values from a single column of the input array, identified by
     * the $columnKey.
     *
     * Optionally, you may provide an $indexKey to index the values in the returned
     * array by the values from the $indexKey column in the input array.
     *
     * @param array $input A multi-dimensional array (record set) from which to pull
     * a column of values.
     * @param mixed $columnKey The column of values to return. This value may be the
     * integer key of the column you wish to retrieve, or it
     * may be the string key name for an associative array.
     * @param mixed $indexKey (Optional.) The column to use as the index/keys for
     * the returned array. This value may be the integer key
     * of the column, or it may be the string key name.
     * @return array
     */
    function array_column($input = null, $columnKey = null, $indexKey = null)
    {
        // Using func_get_args() in order to check for proper number of
        // parameters and trigger errors exactly as the built-in array_column()
        // does in PHP 5.5.
        $argc = func_num_args();
        $params = func_get_args();

        if ($argc < 2) {
            trigger_error("array_column() expects at least 2 parameters, {$argc} given", E_USER_WARNING);
            return null;
        }

        if (!is_array($params[0])) {
            trigger_error('array_column() expects parameter 1 to be array, ' . gettype($params[0]) . ' given', E_USER_WARNING);
            return null;
        }

        if (!is_int($params[1])
            && !is_float($params[1])
            && !is_string($params[1])
            && $params[1] !== null
            && !(is_object($params[1]) && method_exists($params[1], '__toString'))
        ) {
            trigger_error('array_column(): The column key should be either a string or an integer', E_USER_WARNING);
            return false;
        }

        if (isset($params[2])
            && !is_int($params[2])
            && !is_float($params[2])
            && !is_string($params[2])
            && !(is_object($params[2]) && method_exists($params[2], '__toString'))
        ) {
            trigger_error('array_column(): The index key should be either a string or an integer', E_USER_WARNING);
            return false;
        }

        $paramsInput = $params[0];
        $paramsColumnKey = ($params[1] !== null) ? (string) $params[1] : null;

        $paramsIndexKey = null;
        if (isset($params[2])) {
            if (is_float($params[2]) || is_int($params[2])) {
                $paramsIndexKey = (int) $params[2];
            } else {
                $paramsIndexKey = (string) $params[2];
            }
        }

        $resultArray = array();

        foreach ($paramsInput as $row) {

            $key = $value = null;
            $keySet = $valueSet = false;

            if ($paramsIndexKey !== null && array_key_exists($paramsIndexKey, $row)) {
                $keySet = true;
                $key = (string) $row[$paramsIndexKey];
            }

            if ($paramsColumnKey === null) {
                $valueSet = true;
                $value = $row;
            } elseif (is_array($row) && array_key_exists($paramsColumnKey, $row)) {
                $valueSet = true;
                $value = $row[$paramsColumnKey];
            }

            if ($valueSet) {
                if ($keySet) {
                    $resultArray[$key] = $value;
                } else {
                    $resultArray[] = $value;
                }
            }

        }

        return $resultArray;
    }

}

/**
 * Global function to return an instance of applicaiton logger object
 * @return Monolog\Logger
 * @throws Zend_Exception
 */
function logger()
{
    return \Zend_Registry::get("AppLog");
}

