<?php

class AppView 
{
	protected $controller = null;
	protected $didConstructHelpers = false;
	protected $action=null;
	protected $helperClasses = null;

	/**
	 * name of the element that is currently rendered inside the view via $this->renderElement
	 * @var string
	 */
	protected $elementName='';
	
	const BACKENDVPATH = "views";
	const FRONTENDVPATH = "viewsFront";
    const PARTNERPATH = "viewsPartner";
    const APIPATH = "viewsApi";

    /**
     * @var null|string
     */
    protected $_viewPathName = NULL;

   /**
	 * array of helpers you can access inside the view via $this->helpername
	 * @var array
	 */
	public $helpers=array("Html");
		
	public function __construct(&$controller)
	{  
		$this->controller = $controller;
		// 根据控制器类型设置view路径
		switch($controller->type) {
			case dispatcher::FRONTEND:
				$this->_viewPathName = self::FRONTENDVPATH;
				break;
				
			case dispatcher::BACKEND:
				$this->_viewPathName = self::BACKENDVPATH;
				break;

            case dispatcher::PARTNER:
                $this->_viewPathName = self::PARTNERPATH;
                break;

            case dispatcher::API:
                $this->_viewPathName = self::APIPATH;
                break;
			
			default:
				throw new Exception("AppView says: Unknown controller type: \"$controller->type\"");
				break;
		}	
	}

    /**
     * Set the view path name
     * @param $pathName
     * @return mixed
     */
    public function setViewPathName($pathName)
    {
        $this->_viewPathName = $pathName;
        return $this;
    }
	
	private function _getRoot()
	{
			$root = ROOT;
			$root .= "plugins/";
			return $root;
	}
	
	public function render($actionName, $layout="default")
	{	
		$this->helpers = $this->controller->helpers;
		 
		$this->action=$actionName;
		$this->_constructHelpers();
		 
		//$output = "";
		// get the view vars out of the controller 
		extract($this->controller->viewVars);
		// use help classes
		extract($this->helperClasses);
		$controllerName = substr(get_class($this->controller),0,-10);
		
		$viewfile = dirname(__FILE__) . "/../".$this->_viewPathName."/" . $controllerName . "/" .$actionName . ".php";
 		if (!file_exists($viewfile)) {
			throw new Exception("Cant find view [" . $viewfile . "] of controller [" . get_class($this->controller) ."], Path is [" . $viewfile . "]" );
		}else {
			ob_start();
			require($viewfile);
			$out=ob_get_clean();
		}
		return $this->renderLayout($out, $layout);
		
	}
	
	public function renderLayout(&$contentForLayout, $layout = "default")
	{
		extract(array(
			'body'=>$contentForLayout,
			'title_for_layout'=>$this->controller->pageTitle,
            // add custom headers
            'custom_headers' => $this->controller->customHeaders,
		));
		$layoutFile = dirname(__FILE__) . "/../".$this->_viewPathName."/layout/" .$layout . ".php";
		if (!file_exists($layoutFile)) {
			throw new Exception("Can not find layout $layout");
		} else {
			ob_start();
			require($layoutFile);
			return ob_get_clean();
		}
		return $contentForLayout;
	}
	
	/**
	 * construct all helpers we found in our helpers property
	 */
	protected function _constructHelpers() {
		if ($this->didConstructHelpers) {
		  return;
		}
		kataUse('helper');

		foreach ($this->helpers as $name) {
			$root = ROOT;
			$root .= "";
			$name=strtolower($name);
			$classname=ucfirst(strtolower($name)).'Helper';
			
			/*
			if (!class_exists($classname)) {
				if (!file_exists($root.'views'.DS.'helpers'.DS.$name.'.php')) {
					throw new Exception('Cant find Helper ['.$name.'] used by View ['.$this->action.'] of Controller ['.get_class($this->controller).']');
				}
				require($root.'views'.DS.'helpers'.DS.$name.'.php');
			}
			*/
			
			
			require($root. $this->_viewPathName .DS.'helpers'.DS.$name.'.php');
			
			$h = classRegistry::getObject($classname);
			$h->webroot=&$this->webroot;
			$h->action=&$this->action;
			$h->params=&$this->controller->params;
			$h->base=&$this->base;
			$h->basePath=&$this->basePath;
			$h->vars=&$this->controller->viewVars;
			$this->helperClasses[$name]=$h;
		}

		$this->didConstructHelpers = true;
	}

	
	/**
	 * render a element and return the resulting html. an element is kind of like a mini-view you can use inside a 
	 * view (via $this->renderElement()).
	 * it has (like a view) access to all variables a normal view has
	 * @param string $name name of the element (see views/elements/) without .thtml
	 * @param an array of variables the element can access in global namespace
	 */
	 
	public function renderElement($name,$params=array()) {
		$this->elementName=$name;
		extract($this->controller->viewVars);
		extract($params);
		extract($this->helperClasses);
		$GLOBALS['__THIS'] = $this;
		
		$element = ROOT. $this->_viewPathName . DS.'elements'.DS.$this->elementName.".php";
		//$root = $this->_getRoot();
		//$element = $root . 'views' . DS . 'elements' . DS . $this->elementName . ".php";
		if (!file_exists($element)) {
			throw new Exception('Cant find element ['.$this->elementName.']' . "(".$element.")");
		}else {
			ob_start();
			require($element);
			return ob_get_clean();
		}
		return null;
	}




}
/* EOF */