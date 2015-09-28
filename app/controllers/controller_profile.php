<?php

class Controller_Profile extends Controller
{
    public function __construct()
    {
        parent::__construct();
        if ( ! Session::isLoggedIn() && ! isset($this->user)){
            Message::add('You must be registered to enter profile', Message::STATUS_ERROR);
            redirect_to('register');
        }
        $this->model = new Model_User();
        $this->loadLibrary('htmlelements');

    }

    public function index()
    {
        $this->view->generate_view();
    }
}