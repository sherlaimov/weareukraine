<?php
class Controller_Admin extends Controller
{
    function init(){
        $this->model = new Model_Admin();
        $this->view->setLayout('admin_view');
    }

    public function index(){

//        $pagination = new Pagination(1, 3);
//        $pagination->current_page = isset($_GET['page']) ? $_GET['page'] : 1;
//        $news = $pagination->findByOffset();
        $news = $this->model->get('news');
        $this->view->setData('news', $news);
//        $this->view->setData('pagination', $pagination);
        $this->view->generate_view();
    }

    public function news(){

        $news = $this->model->get('news');
        $this->view->setData('news', $news);
        $this->view->generate_view();
    }

    public function user(){
        $this->view->userList = $this->model->getUsers();
        $this->view->generate_view();
    }

    public function editUser($id)
    {
        //fetch individual user
        $user = $this->view->user = $this->model->getUserById($id);
        $this->view->generate_view();
    }

}