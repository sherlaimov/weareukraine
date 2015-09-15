<?php

class Controller_Index extends Controller
{

    function index()
    {
        $this->view->setLayout('admin_view');
        $this->view->generate_view();
    }
}