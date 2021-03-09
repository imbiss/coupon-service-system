<?php
/**
 * Contains the class-registry
 *
 * Kata - Lightweight MVC Framework <http://www.codeninja.de/>
 * Copyright 2007-2009 mnt@codeninja.de, gameforge ag
 *
 * Licensed under The GPL License
 * Redistributions of files must retain the above copyright notice.
 * @package kata_internal
 */




/**
 * Class-registry, a pseudo-singleton wrapper. Used to memorize and return all classes we did already instanciate.
 * @package kata_internal
 */
class classRegistry {

	/**
	 * array to save objects of any classed created
	 * @var array
	 */
	static protected $objects = array();

	/**
	 * return an instance of the class given in $name. If the class does not exist yet, create it.
	 *
     * @param string $name name of the class to return an instance of
     * @param string $key to create the same class more than once. uses simple caching to return consistency
     */
	static public function &getObject($name,$key='') {
		$objname = $name.(empty($key)?'':'/').$key;

		if (!isset(self::$objects[$objname])) {
		     self::$objects[$objname]=new $name;
		}
		return self::$objects[$objname];
	}

	/**
	 * return all classes in the cache. used for debugging
	 * @return array cache-array
	 */
	static public function getLoadedClasses() {
		return self::$objects;
	}

}
