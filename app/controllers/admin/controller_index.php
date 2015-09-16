<?php

class Controller_Index extends ControllerBackend
{

    function index()
    {
        if (!Session::isLoggedIn() || $this->user->get('role') == 'default') {
            Message::add('You must be authorized to enter Admin area', Message::STATUS_ERROR);
            redirect_to('login');
        }
        $news = $this->model->get('news', 7);
        $this->view->setData('news', $news);
        $this->view->generate_view();
    }
}