<?php

class Route
{
    public $controller = 'index';
    protected $_controllerName = false;
    protected $method = 'index';
    protected $_module = '';
    protected $_prefix = '';
    protected $params = [];
    protected $_moduleList = array('admin' => ['prefix' => 'admin', 'enable' => true ], 'frontend' => ['prefix' => '', 'enable' => false]);
    static protected $_instance = null;

    protected function __construct() {

    }

    public function getControllerName() {
        return $this->_controllerName;
    }

    public function getActionName() {
        return $this->method;
    }

    public function getModuleName() {
        return $this->_module;
    }

    public function isFrontend() {
        return $this->_module == 'frontend' ? true : false;
    }

    public function getModulePrefix() {


            if ( ! empty($this->_moduleList[$this->_module]['prefix'] ) ) {
                return $this->_moduleList[$this->_module]['prefix'] . DS;
            }

        return '';
    }

    private function __clone(){

    }

    static public function getInstance() {
        if (self::$_instance === null) {
           self::$_instance = new static;
        }
        return self::$_instance;
    }


    public function parseUrl(){        
        if(isset($_GET['url'])){

            $url = rtrim($_GET['url'], '/');
            $url = filter_var($url, FILTER_SANITIZE_URL);
            $url = explode('/', $url);
            //$routes = explode('/', $_SERVER['REQUEST_URI']);
            //var_dump($url);
            return $url;
        }
    }

    public function start()
	{
        $this->_prefix = 'controller_';

        $url = $this->parseUrl();

        if ( isset( $this->_moduleList[ $url[0] ]) && $this->_moduleList[ $url[0] ]['enable'] ) {
            $this->_module = $url[0];
            array_shift($url);
        } else {
            $this->_module = 'frontend';
        }

            if ( isset($url[0]) ) {

                $controller_name =  $url[0];
                unset($url[0]);

            } else {

                $controller_name =  $this->controller;

            }

        if ( ! file_exists(FS_CONTROLLERS . $this->getModulePrefix() .  $this->_prefix  . $controller_name . '.php'))
        {
            $controller_name = '404';
        }

        require_once FS_CONTROLLERS .  $this->getModulePrefix() .  $this->_prefix  . $controller_name . '.php';

        if ( isset($url[1]) ) {

            if(method_exists( $this->_prefix  . $controller_name, $url[1])){

                $this->method = $url[1];

                unset($url[1]);

            } else {
                $controller_name = '404';
                require_once FS_CONTROLLERS . $this->_prefix  . $controller_name .'.php';
            }
        }

        $this->_controllerName = $controller_name;

        $className = $this->_prefix . $controller_name;
        $this->controller = new $className();
        //print_r($url); die;
        $this->params = $url ? array_values($url) : [];

            //MAGIC TAKES PLACE HERE!!

            call_user_func_array(array($this->controller, $this->method), $this->params);

	       //
	}

    
}



