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

            if(isset($url[0])){
                $controller_name = 'controller_' . $url[0];

            } else {
                $controller_name = 'controller_' . $this->controller;
            }
            

        if(file_exists('app/controllers/' . $controller_name . '.php'))
        {
                $this->controller = $controller_name;
                //var_dump($this->controller);
            //1. Initiate controller, main by default

            unset($url[0]); //why removing it from the array?

        } else {
            $this->controller = 'controller_' . $this->controller;
        }

        require_once 'app/controllers/' . $this->controller . '.php';

        $this->controller = new $this->controller();
       // echo $this->controller;

//            $this->controller->index();

        if(isset($url[1])){
            if(method_exists($this->controller, $url[1])){
                //$this->controller->method();????
                $this->method = $url[1];
                unset($url[1]);

                //print_r($this->controller);
                //$this->controller->$url[1]();
            }
        }

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

	public function ErrorPage404()
	{
        $host = 'http://'.$_SERVER['HTTP_HOST'].'/';
        header('HTTP/1.1 404 Not Found');
		header("Status: 404 Not Found");
		header('Location:'.$host.'404');
    }
    
}



