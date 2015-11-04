<?php

class Controller_Profile extends Controller
{
    public function __construct()
    {
        parent::__construct();

        $this->model = new Model_User();
        $this->loadLibrary('htmlelements');

    }

    public function index()
    {
          //$this->model->getUserById($this->user->get('user_id'));
        if ( ! Session::isLoggedIn()){
            Message::add('You must be registered to enter profile', Message::STATUS_ERROR);
//            header('Location: profile');
//            exit;
            redirect_to(href('register'));
        }
        $user_id = $this->user->get('user_id');
        $comment = new Comment();
        $data['userComments'] = $comment->getUserComments($user_id);
        $data['commentsCount'] = $comment->countUserComments($user_id);
        $newsModel = new Model_News();
        $data['news'] = $newsModel->getUserNews($user_id);
        $data['newsCount'] = $newsModel->countUserNews($user_id);
        $data = array_merge($data, $this->user->getData());
        $this->view->setData('user', $data);
        $this->view->generate_view();
    }

    public function user()
    {
        $id = (int)trim($_GET['user_id']);
        $data = $this->model->getUserById($id);
//        $commentsModel = new Model_Comments();
//        $data['commentsCount'] = $commentsModel->countUserComments($id);
        $comment = new Comment();
        $data['commentsCount'] = $comment->countUserComments($id);
        $newsModel = new Model_News();
        $data['newsCount'] = $newsModel->countUserNews($id);
        $this->view->setData('user', $data);
        $this->view->generate_view();

    }

    public function update($id)
    {

        $data = array();
        if ($this->isPost()) {
            $data = array('first_name' => trim($_POST['first_name']),
                'last_name' => trim($_POST['last_name']),
                'login' => trim($_POST['login']),
                'user_id' => $id);
            if( ! empty($_POST['old_password']) && ! empty($_POST['new_password'])){
                if ($this->user->get('password') == Hash::create_hash('md5',(trim($_POST['old_password'])), HASH_KEY )) {
                    $data['new_password'] = Hash::create_hash('md5',(trim($_POST['new_password'])), HASH_KEY );
                    Message::add('Password successfully changed', Message::STATUS_SUCCESS);
                } else {
                    Message::add('Incorrect old password', Message::STATUS_ERROR);
//                    return false; Нужен ли здесь редирект?
                    redirect_to('profile');
                }
            }


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
            $this->model->editUser($data);
//            print_r((href('profile'))); die;
            redirect_to(href('profile'));
        }



    }


    public function addNews()
    {
        if($this->isPost()){
            $model = new Model_News();
            $data = array(
                'title' => trim($_POST['title']),
                'body' => trim($_POST['body']),
                'user_id' => $this->user->get('user_id'),
                'created' => strftime("%Y-%m-%d %H:%M:%S", time())

            );

            if (empty($data['title']) || empty($data['body'])) {
                Message::add('Title and body can not be empty', Message::STATUS_WARNING);
                if (count($_POST)) {
                    $this->view->setData('post', $data);
                    /// header('Location: ' . URL . 'news/add');
                }
            } else {
                if ($_FILES['upload']) {

                    $destination = FS_IMAGES;
                    try {
                        $file = new fileWizard($destination);
                        $file->upload();
                        $data = array_merge($data, $file->getImageInfo());
                    } catch (Exception $e) {
                        Message::add($e->getMessage(), Message::STATUS_ERROR);
                    }

                }
                //var_dump($data); die;
                $model->addNews($data);
                redirect_to(URL . 'news');
            }
        }

    }
}