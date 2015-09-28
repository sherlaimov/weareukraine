<?php

class Controller_Profile extends Controller
{
    public function __construct()
    {
        parent::__construct();
        if ( ! Session::isLoggedIn() && ! isset($this->user)){
            Message::add('You must be registered to enter profile', Message::STATUS_ERROR);
            redirect_to('register');
        }
        $this->model = new Model_User();
        $this->loadLibrary('htmlelements');

    }

    public function index()
    {
        $data = $this->model->getUserById($this->user->get('user_id'));
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
            $data['password'] = Hash::create_hash('md5',(trim($_POST['password'])), HASH_KEY );

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
        }



    }


    public function test(){
        echo 'BELGO';die;
    }
}