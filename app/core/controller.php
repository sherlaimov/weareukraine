<?php

class Controller {

    public $model;
    public $view;
    public $output;
    public $content_view;

    function __construct() {
        
        $this->view = new View();
        //$this->content_view = $this->parseUrl();
        $this->model = new Model();
        $this->view->setLayout('template_view');

        Session::init();
        //$this->login();
        $this->init();
    }
    
    public function init() {
        
    }


    public function load_model($name) {
        //1. Initiate the model if exists
        $model_name = 'Model_' . $name;
        $model_file = strtolower($model_name) . '.php';
        if (file_exists('app/models/' . $model_file)) {
            //var_dump($model_file); die();
            include 'app/models/' . $model_file;
            return new $model_name;
        } else {
            return false;
        }
    }


}
