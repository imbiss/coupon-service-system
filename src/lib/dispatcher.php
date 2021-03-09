<?php

class dispatcher {

	protected $_controller = "";
	protected $_action = "";
	protected $_controllerPath = "";
	protected $_controllerType = NULL;
	private $starttime;
	public $params;
	
	const BACKENDCPATH  = "controllers";
	const FRONTENDCPATH = "controllersFront";
    const PARTNERPATH   = "controllersPartner";
    const APIPATH = "controllersApi";

	
	const FRONTEND = "frontend";
	const BACKEND  = "backend";
    const PARTNER = "partner";
    const API = "api";

	
	public function __construct()
	{
		$this->starttime = microtime(true);
		// set default controller path
	    //$this->_controllerPath = dirname(__FILE__) . "/../".self::BACKENDCPATH."/";
		
	}
	
	/**
	 * destructor, outputs Total Render time if DEBUG>0
	 */
	public function __destruct() {
		if (DEBUG > 0) {
			kataDebugOutput('Total Render Time (including Models) ' . (microtime(true) - $this->starttime) . ' secs');
			kataDebugOutput('Memory used ' . number_format(memory_get_usage(true)) . ' bytes');
			kataDebugOutput('Parameters ' . print_R($this->params, true));
			if (function_exists('xdebug_get_profiler_filename')) {
				$fn = xdebug_get_profiler_filename();
				if (false !== $fn) {
					kataDebugOutput('profilefile:' . $fn);
				}
			}
			kataDebugOutput('Loaded classes: ' . implode(' ', array_keys(classRegistry :: getLoadedClasses())));
		}
	}
	
	/**
	 * 设置控制器路径
	 * @param string 前端或者是后端或者Partner
	 * @return object $this
	 */
	public function setControllerType($type)
	{
        switch ($type) {
			case self::FRONTEND:
				$this->_controllerPath = dirname(__FILE__) . "/../".self::FRONTENDCPATH."/";
				$this->_controllerType = self::FRONTEND;
				break;
				
			case self::BACKEND:
				$this->_controllerPath = dirname(__FILE__) . "/../".self::BACKENDCPATH."/";
				$this->_controllerType = self::BACKEND;
				break;
                
            case self::PARTNER:
            	$this->_controllerPath = dirname(__FILE__) . "/../".self::PARTNERPATH."/";
				$this->_controllerType = self::PARTNER;
                break;

            case self::API:
                $this->_controllerPath = dirname(__FILE__) . "/../".self::APIPATH."/";
                $this->_controllerType = self::API;
                break;
                
			default:
				throw new Exception("Unknown Controller Type. \"$type\". FILE:" . __FILE__ . ", line:" . __LINE__);
				break;	
		}
		return $this;
	}
	
	public function setController($c)
	{   
		$this->_controller = $c;
		return $this;
	}
	
	public function setAction($a)
	{   
		$this->_action = $a;
		return $this;
	}
	
	public function run()
	{		
       try {
            $classControllerName = $this->_controller. "Controller";
            $controllerFile = $this->_controllerPath . $classControllerName . ".php";
            if (!file_exists($controllerFile)) {
                //var_dump($_REQUEST);
                throw new Exception("The '$controllerFile' file not found!");
            }
            require_once ($controllerFile);
            //constructController
            $c = new $classControllerName;
            $c->setType($this->_controllerType) //设置控制器类型flag
              ->setAction($this->_action);
            // call beforeAction
            $c->beforeAction();

             // call the action in controller
            $parameters = array();
            call_user_func_array(array (& $c,$this->_action), $parameters);
            // render view
            if ($c->autoRender) {
               $c->render($this->_action);
            }
            echo $c->output;
       } catch (\Exception $e) {
           echo $e->getMessage();
           die();
       }
	}
}
/* EOF */