<?php

class Route
{
    public $controller = 'main';
    protected $method = 'index';
    protected $params = [];
    
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
            
        $url = $this->parseUrl();

            if ( isset($url[0]) ) {

                $controller_name = 'controller_' . $url[0];
                unset($url[0]);

            } else {

                $controller_name = 'controller_' . $this->controller;

            }



        if ( ! file_exists(FS_CONTROLLERS . $controller_name . '.php'))
        {
            $controller_name = 'controller_404';

        }

        require_once FS_CONTROLLERS . $controller_name . '.php';
        //$this->controller = new $this->controller();
       // echo $this->controller;

//            $this->controller->index();

        if ( isset($url[1]) ) {

            if(method_exists($controller_name, $url[1])){
                //$this->controller->method();????
                $this->method = $url[1];

                unset($url[1]);

                //echo "exists";

                //print_r($this->controller);
                //$this->controller->$url[1]();
            } else {
                $controller_name = 'controller_404';
                require_once FS_CONTROLLERS . $controller_name .'.php';
            }
        }

        $this->controller = new $controller_name();

        $this->params = $url ? array_values($url) : [];

        /*
            if(isset($url[2])){
                if(method_exists($this->controller, $url[1])){
                // echo '<h1> BELGOGOGOGO </h1>';die;
                //$this->method = $url[1];
                $this->controller->$url[1]($url[2]);
                }
            }
        */
            //var_dump($this->params);
            //MAGIC TAKES PLACE HERE!!

            call_user_func_array(array($this->controller, $this->method), $this->params);

	       //
	}

    
}



