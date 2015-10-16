<?php
class Controller_News extends ControllerBackend
{
    function init()
    {
//        var_dump($this->user);
//        $this->model = new Model_Admin();
//        var_dump($this->user->get('role') != 'admin');die;
        if (!Session::isLoggedIn() || $this->user->get('role') == 'default') {
            Message::add('You must be authorized to enter Admin area', Message::STATUS_ERROR);
            redirect_to('login');
        }
        $this->model = new Model_News();
        $this->view->setLayout('admin_view');
    }

    public function index()
    {
        $pagination = new Pagination(1, 5);
        $pagination->current_page = isset($_GET['page']) ? $_GET['page'] : 1;

        $news = $this->model->get('news');
        $news = $pagination->findByOffset();
        $this->view->setData('news', $news);
        $this->view->setData('pagination', $pagination);
        $this->view->generate_view();
    }

    public function one_news()
    {

        $news = $this->model->get_one_news();
        //print_r($news); die;
        $this->view->setData('news', $news);
        $this->view->generate_view();
    }


    public function delete($id)
    {
        $this->model->deleteNews($id);
        redirect_to((href('news')));

    }

    public function edit($id)
    {

        if ($this->isPost()) {
            $this->editSave($id);
        }

        $news = $this->model->selectOneNews($id);
        $this->view->setData('news', $news);
        $this->view->generate_view();
    }

    public function editSave($id)
    {
        $data = array();
        $data['id'] = $id;

        //var_dump($_FILES);die;

        if (!empty($_POST['title']) && !empty ($_POST['body'])) {
            $data['title'] = trim($_POST['title']);
            $data['body'] = trim($_POST['body']);
            $data['created'] = strftime("%Y-%m-%d %H:%M:%S", time());
            if (isset($_FILES['upload']) && !empty($_FILES['upload']['name'])) {
                $file = new File($_FILES['upload']);
                $imageData = $file->getImageInfo();
                $data = array_merge($data, $imageData);

                if (move_uploaded_file($data['tmp_name'], $data['file_path'])) {
                    //echo 'BELGO'; die;
                    if (isset($_POST['width'])) {
                        $value = $_POST['width'];
                        if ($file->createThumb($value, $value)) {
                            $data['thumb_name'] = $file->thumbName;
                        } else {
                            return false;
                        }
                    } else {
                        $file->createThumb(150, 150);
                        $data['thumb_name'] = $file->thumbName;
                    }
                }
            }

            $this->model->updateNews($data);
            redirect_to(href('news'));
        } else {
            Message::add('Both body and title must be filled', Message::STATUS_ERROR);
            if (count($_POST)) {
                $data = array(
                    'title' => trim($_POST['title']),
                    'body' => trim($_POST['body']),
                    'id' => trim($id));
            }
            $this->view->setData('data', $data);
            //header('Location: ' . URL . 'news/edit/' . $id);
            //exit;
        }
    }

    public function add($id = null)
    {
        $this->loadLibrary('htmlelements');
        if (Session::get('loggedIn') == FALSE || $this->user->get('role') == 'default') {
            Message::add('You have to be authorized to add news', Message::STATUS_WARNING);
            header('Location: ' . URL . 'login/');
            exit;
        }
        if (isset($id)) {
            if ($this->isPost()) {
                $this->editSave($id);
            }
//            $this->model = $this->load_model('news');
//            var_dump($this->model); die;
            $news = $this->model->selectOneNews($id);
            $this->view->setData('news', $news);
            $this->view->generate_view();
        }
        else {
            if ($_POST) {
                $this->addNews();
            }
            $this->view->generate_view();
        }

    }


    public function addNews()
    {

        $data = array(
            'title' => trim($_POST['title']),
            'body' => trim($_POST['body']),
            'user_id' => $this->user->get('user_id'),
            'created' => strftime("%Y-%m-%d %H:%M:%S", time())

        );

        if (empty($data['title']) || empty($data['body'])) {
            Message::add('Title and body can not be empty', Message::STATUS_ERROR);
            if (count($_POST)) {
                $this->view->setData('post', $data);
                /// header('Location: ' . URL . 'news/add');
            }
        } else {
            if ($_FILES['upload']) {
                $file = new File($_FILES['upload']);

                $imageData = $file->getImageInfo();
                //var_dump($imageData); die;
                $data = array_merge($data, $imageData);
                //print_r($data);
                if (move_uploaded_file($data['tmp_name'], $data['file_path'])) {
                    //echo 'BELGO'; die;
                    if (isset($_POST['width'])) {
                        $value = $_POST['width'];
                        if ($file->createThumb($value, $value)) {
                            $data['thumb_name'] = $file->thumbName;

                        } else {
                            return false;
                        }

                    } else {
                        $file->createThumb(150, 150);
                        $data['thumb_name'] = $file->thumbName;
                    }
                }
            }
            //var_dump($data); die;
            $this->model->addNews($data);
            redirect_to(URL . 'admin/news');
        }
    }


}