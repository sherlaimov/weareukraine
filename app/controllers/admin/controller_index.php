<?php

class Controller_Index extends ControllerBackend
{

    public function index()
    {
        if (!Session::isLoggedIn() || $this->user->get('role') == 'default') {
            Message::add('You must be authorized to enter Admin area', Message::STATUS_ERROR);
            redirect_to('login');
        }
        $news = $this->model->get('news', 7);
        $this->view->setData('author', $this->authorName($this->user->get('user_id')));
        $this->view->setData('news', $news);
        $this->view->generate_view();
    }

    public function authorName($user_id)
    {
        $this->model->where('user_id', $user_id);
        var_dump($this->model->get('user'));
    }
}