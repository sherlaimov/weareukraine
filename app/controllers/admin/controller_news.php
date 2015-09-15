<?php
class Controller_News extends ControllerBackend
{
    function init(){
//        var_dump($this->user);
//        $this->model = new Model_Admin();
//        var_dump($this->user->get('role') != 'admin');die;
        if( ! Session::isLoggedIn() || $this->user->get('role') == 'default') {
            Message::add('You must be authorized to enter Admin area', Message::STATUS_ERROR);
            redirect_to('login');
        }
        $this->view->setLayout('admin_view');
    }

    public function index(){

        $this->view->generate_view();
    }

/*    NEWS SECTION */

    public function news(){
        $this->model = new Model_News();
        $news = $this->model->getNews();
        $this->view->setData('news', $news);
        $this->view->generate_view('admin_news.php');

    }

    public function addNews()
    {
        $this->model = new Model_News();
            require_once('app/libs/htmlelements.php');
            if (Session::get('loggedIn') == FALSE || $this->user->get('role') == 'default') {
                Message::add('You have to be authorized to add news', Message::STATUS_WARNING);
                header('Location: ' . URL . 'login/');
                exit;
            }
            if (isset($id)) {
                if ($this->isPost()) {
                    $this->editSave($id);
                }
                $news = $this->model->selectOneNews($id);
                $this->view->setData('news', $news);
                $this->view->generate_view();
            }
            if ($_POST) {
                $this->addNews();
            }
            $this->view->generate_view('news_add.php');
    }



    public function user(){
        $this->model = new Model_User();
        $this->view->userList = $this->model->getUsers();
        $this->view->generate_view();
    }

    public function editUser($id)
    {
        $this->model = new Model_User();
        $user = $this->view->user = $this->model->getUserById($id);
        $this->view->generate_view();
    }

}