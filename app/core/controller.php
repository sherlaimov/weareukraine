<?php

class Controller extends controllerBase {

    public $model;
    public $view;
    public $output;
    public $content_view;
    public $user = false;

    function __construct() {

        parent::__construct();

        $this->view = new View();
        //$this->content_view = $this->parseUrl();
        $this->model = new Model();
        Session::init();

        if ( Session::isLoggedIn() && (int) Session::get('user_id') ) {
            $this->user = new User( Session::get('user_id'));
            $this->view->user = $this->user;
        } else {
            $this->user = $this->view->user = new User(0);
        }

        $this->view->setLayout('template_view');

        //$this->login();
        $this->init();

    }
    
    public function init() {
        
    }

//    public function getUser($id)
//    {
//
//        $this->model->where('id', $id);
//        return $this->model->get('user', 1);
//    }


}
