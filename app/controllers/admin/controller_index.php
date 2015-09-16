<?php

class Controller_Index extends ControllerBackend
{

    function index()
    {
        echo 'belgo';
//        $this->view->setLayout('admin_view');
        $this->view->generate_view();
    }
}