<?php

class Controller_Index extends ControllerBackend
{

    public function index()
    {
        if ( ! Session::isLoggedIn() || $this->user->get('role') == 'default') {
            Message::add('You must be authorized to enter Admin area', Message::STATUS_ERROR);
            redirect_to(href('login'));
        }
        $model = $this->load_model('news');
//        $news = $model->getNews();
        $news = $model->getNewsWithAuthor();
        $news['totalNews'] = $model->countAll();
        $this->view->setData('news', $news);
        $this->view->generate_view();
    }

    public function authorName($user_id)
    {
        $this->model->where('user_id', $user_id);
//        var_dump($this->model->get('user'));die;
    }
}