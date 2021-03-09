<?php
//require_once (dirname(__FILE__) . "/../lib/controller.php" );

class AppController //extends Controller
{
	/**
	 * which models to use. Array of Modelnames in CamelCase, eg. array('User','Ship')
	 * 
	 * @var array
	 */
	public $uses= array();
	public $helpers= array('html');	
	public $components= array();

    /**
     * The customer header
     *
     * @var null | string
     */
    public $customHeaders = null;
	
	public $autoRender = true;
		
	/**
	 * The vars used in view. 
	 * @var unknown_type
	 */
	public $viewVars = array();
	
	
	public $output = "";
	public $base; // the absolute url of kata, including http(s),path and last slash. append controllername and actionname to this and you have a full url
	
	protected $action = "";
    protected $viewClass = null;
    protected $layout = "default";



    /**
	 * string with a pagetitle to render to the current layout ($title_for_layout inside the view)
	 * 
	 * @var string
	 */
	public $pageTitle = '';
	
	/**
	 * 控制器类型，前台控制器或者后台控制器
	 * @var string
	 */
	public $type = NULL;
    
    public function __construct()
    {
    	// load models in $use
    	$this->_constructClasses();
    	 
   		if(is_subclass_of($this, 'AppController')) {   		
			$appVars= get_class_vars('AppController');
			$uses= $appVars['uses'];
			$merge= array('components', 'helpers');

			if(!empty($this->uses) &&($uses == $this->uses)) {
				//array_unshift($this->uses, $this->modelClass);
			}
			elseif(!empty($this->uses)) {
				$merge[]= 'uses';
			}

			foreach($merge as $var) {
				if(isset($appVars[$var]) && !empty($appVars[$var]) && is_array($this-> {
					$var })) {
					$this-> {
						$var }
					= array_merge($this-> {
						$var }, array_diff($appVars[$var], $this-> {
						$var }));
				}
			}			
		}
    }
    
	
	
	/**
	 * loads all models this controller needs
	 * 
	 * @param void
	 * @return object
	 */
	protected function _constructClasses() {
		if(!is_array($this->uses)) {
			throw new Exception('$uses must be an array');
		}
		kataUse('Model');
		foreach($this->uses as $u) {
			loadModel($u);
			$this-> $u= classRegistry :: getObject($u);
		}
		
		$this->_constructComponents($this);
		return $this;
	}
	
	/**
	 * loads all components this controller needs
	 * 
	 * @param object $object the class-handle of the current controller
	 */
	function _constructComponents(& $object) {
		if(isset($object->components)) {
			if(!is_array($object->components)) {
				throw new Exception('$components must be an array');
			}
			foreach($object->components as $comname) {
				$classname= $comname.'Component';
				$object-> $comname= classRegistry :: getObject($classname);
				$object-> $comname->startup($object);
				//FIXME avoid endless recursion
				//$this->_constructComponents($object-> $comname);
			}
		}
	}
	
	

	
	public function setAction($action)
	{		
		$this->action = $action;
		return $this;
	}
	
	public function set($name, $value= null) {
		$this->viewVars[$name]= $value;
		return $this;
	}
	
	/**
	 * Render the view
	 * @return unknown_type
	 */
	public function render($actionName)
	{
        $this->output = $this->renderView($actionName);
		return true;
	}
	
	/**
	 * redirect the request
	 * @param $action
	 * @param $controller
	 * @return unknown_type
	 */
//	public function redirect($action, &$controller = null)
//	{
//		$controllerClass = get_class($controller);
//		
//		$d = new dispatcher();
//		$d->setAction($action) //set action
//		  ->setController(substr($controllerClass, 0, -10)) // set controller
//		  ->run(); // run 
//		return; 
//	}	
	
	public function redirect($url, $status=null, $die=true )
	{
	    if(!is_numeric($status) ||($status < 100) ||($status > 505)) {
			$status= 303;
		}

		$this->autoRender= false;
		if(function_exists('session_write_close')) {
			session_write_close();
		}
		
		$pos= strpos($url, '://');
		if($pos === false) { // is relative url, construct rest
			$url= $this->base.$url;
		}
		
	    header('HTTP/1.1 '.$status);
		header('Location: '.$url);
		if($die) {
			if(DEBUG<1) {
				echo '<html><head><title>Redirect</title>'.
				'<meta http-equiv="refresh" content="1; url='.$url.'">'.
				'</head>'.
				'<body>Redirect to <a href="'.$url.'">'.$url.'</a></body>'.
				'<script type="text/javascript">window.setTimeout(\'document.location.href="'.$url.'";\',1100);</script>';
				'</html>';
			}
			die;
		}
	}
	
	/**
	 * set the pagetitle for the current layout
	 * 
	 * @param string $n title
	 */
	public function setPageTitle($n) {
		$this->pageTitle= $n;
        return $this;
	}
	
	
	/**
	 * Render the template
	 * @return unknown_type
	 */
	protected function renderView($action)
	{
		$this->initViewClass();
		$this->autoRender= false;
		$html = $this->viewClass->render($action, $this->layout);
		return $html;
	}
	
	protected function initViewClass()
	{
		$this->viewClass = new AppView($this);
		return;
	}
	
	
	public function setLayout($l)
	{
		$this->layout = $l;
		return $this;
	}
	
/**
	 * 设置控制器类型
	 *
	 */
	public function setType($type)
	{
		$this->type = $type;
		return $this;
	}
	
	public function beforeAction()
	{
	}



}
/* EOF */