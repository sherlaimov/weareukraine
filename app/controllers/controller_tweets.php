<?php

class Controller_Tweets extends Controller
{
    public function __construct()
    {
        parent::__construct();
//        $this->loadLibrary('tmhOAuth');
        $this->loadLibrary('tweets_json');
//        require_once(FS_APP . DS . 'libs/cacert.pem');
    }

    public function index()
    {
        $this->view->generate_view();
    }
}