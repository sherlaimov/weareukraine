<?php

class Controller_News extends Controller {

    function init() {

        //$this->model = $this->load_model('news');
        $this->model = new Model_News();

    }

    function index(){

        $pagination = new Pagination(1, 3);
        $pagination->current_page = isset($_GET['page']) ? $_GET['page'] : 1;
        //var_dump($pagination);
        $news = $pagination->findByOffset();
        $this->view->setData('news', $news);
        $this->view->setData('pagination', $pagination);
        $this->view->generate_view();
    }

    function one_news(){
        $news = $this->model->get_one_news();
        //print_r($news); die;
        $this->view->setData('news', $news);
        $this->view->generate_view();
    }

    public function delete($id){
        $this->model->deleteNews($id);
        header('Location: ' . URL . 'news');
        exit;

    }

    public function edit($id) {

        if ($this->isPost()) {
            $this->editSave($id);
        }

        $news = $this->model->selectOneNews($id);
        $this->view->setData('news', $news);
        $this->view->generate_view();
    }

    public function editSave($id){
        $data = array();
        $data['id'] = $id;

        //var_dump($_FILES);die;

        if ( ! empty($_POST['title']) && ! empty ($_POST['body'])) {
            $data['title'] = trim($_POST['title']);
            $data['body'] = trim($_POST['body']);
            if (isset($_FILES['upload']) && ! empty($_FILES['upload']['name'])) {
                //echo 'BELGO'; die;
                $imageData = $this->get_image_info();
                $data = array_merge($data, $imageData);

                $bitmap = $this->create_thumbnail($imageData['file_destination'], false, $imageData['width'], $imageData['height']);
                imagejpeg($bitmap, FS_IMAGES . 'thumb' . DS . $imageData['thumb_name']);
            }

            $this->model->updateNews($data);
            header('Location: ' . URL . 'news');
            exit;
        } else {
            Message::add('Both body and title must be filled', Message::STATUS_ERROR);
            if (count($_POST)) {
                $data = array(
                    'title' => trim($_POST['title']),
                    'body' => trim($_POST['body']),
                    'id'   => trim($id));
            }
            $this->view->setData('data', $data);
            //header('Location: ' . URL . 'news/edit/' . $id);
            //exit;
        }
    }

    public function add($id = null) {
        require_once('app/libs/htmlelements.php');
        if (Session::get('loggedIn') == FALSE || Session::get('role') == 'default') {
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
        $this->view->generate_view();
    }


    public function addNews() {

        $data = array(
            'title' => trim($_POST['title']),
            'body' => trim($_POST['body'])
        );

        if ( empty($data['title']) || empty($data['body'])) {
            Message::add('Title and body can not be empty', Message::STATUS_WARNING);
            if( count($_POST)) {
                $this->view->setData('post', $data);
               /// header('Location: ' . URL . 'news/add');
            }
        }
        else
        {
            if ($_FILES['upload']) {
                $file = new File($_FILES['upload']);

                $imageData = $file->getImageInfo();
                //var_dump($imageData); die;
                $data = array_merge($data, $imageData);
                //print_r($data); die;
                if (move_uploaded_file($data['tmp_name'], $data['file_path'])) {
                    //echo 'BELGO'; die;
                    if (isset($_POST['width'])) {
                        $value = $_POST['width'];
                        $file->createThumb($value, $value);
                        $data['thumb_name'] = $file->thumbName;
                    } else {
                        $file->createThumb(150, 150);
                        $data['thumb_name'] = $file->thumbName;
                    }
                }
            }
            //var_dump($data); die;
            $this->model->addNews($data);
            redirect_to(URL . 'news');
        }
    }




}