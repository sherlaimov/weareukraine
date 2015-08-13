<?php
class Controller_Admin extends Controller
{
    function init(){
        $this->model = $this->load_model('admin');
        $this->view->setLayout('admin_view');
    }

    function index(){

       // $pagination = new Pagination(1, 3);
        //$pagination->current_page = isset($_GET['page']) ? $_GET['page'] : 1;
        //var_dump($pagination);
       // $news = $pagination->findByOffset();
        $news = $this->model->get('news');
        $this->view->setData('news', $news);
        //$this->view->setData('pagination', $pagination);
        $this->view->generate_view();
    }


}