<?php

class Controller_Register extends Controller
{
    public function init(){
        if( Session::isLoggedIn() && $this->user->getId() !== 0) {
            redirect_to(href('login'));
        }
        $this->model = new Model_User();
    }

    public function index(){
//        var_dump($_POST);die;
        if($_SERVER['REQUEST_METHOD'] == 'POST') {
            //echo 'belgo'; die;
            $login = trim($_POST['login']);
            $firstName = trim($_POST['first_name']);
            $lastName = trim($_POST['last_name']);
            $password = trim($_POST['password']);
            $passConfirm = trim($_POST['password_confirm']);

//            var_dump($this->model->loginTaken($login));die;
            if($this->model->loginTaken($login)) {
                Message::add('Login taken', Message::STATUS_ERROR);
                $this->view->generate_view();
                return false;
            }
            if ($password !== $passConfirm) {
                Message::add('Password has not been confirmed', Message::STATUS_ERROR);
                $this->view->generate_view();
                return false;
            }
            if(empty($login) || empty($password) || empty($firstName) || empty($lastName)){
                Message::add('Please fill out all the required fields', Message::STATUS_ERROR);
                redirect_to(href('register'));
                return false;
            }



            $password = Hash::create_hash('md5', $password, HASH_KEY);
            $data = array(
                'login' => $login,
                'password' => $password,
                'first_name' => $firstName,
                'last_name' => $lastName
            );
            $this->model->registerUser($data);
            $data = $this->model->authenticate($login, $password);
            if (is_array($data) && isset($data['user_id']) ) {

                //LOGIN + SET SESSION
                Session::set('user_id', $data['user_id']);
                Session::login();
                redirect_to('login');

            }

        }

        $this->view->generate_view();
    }


}