<?php

class Controller_Login extends ControllerBackend
{

    function init()
    {
        //parent::__construct();
        //$this->model = $this->load_model('login');
        if( ! Session::isLoggedIn() || $this->user->get('role') == 'default') {
            Message::add('You must be either admin or owner to enter the admin area', Message::STATUS_ERROR);
//            redirect_to('login');
        }
        $this->model = new Model_User();
    }

    function index()
    {

        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $login = trim($_POST['login']);
            $password = trim($_POST['password']);
            $password = Hash::create_hash('md5', $password, HASH_KEY);


            if (empty($login) || empty($password)) {

                Message::add('Please, enter login and pass', Message::STATUS_ERROR);

                if (isset($_SERVER['HTTP_REFERER'])) {
                    redirect_to($_SERVER['HTTP_REFERER']);
                }


            } else {
                // $fountUser = User::authenticate($login, $password);
                $data = $this->model->authenticate($login, $password);


                if (is_array($data) && isset($data['user_id']) ) {

                    //LOGIN + SET SESSION
                    Session::set('user_id', $data['user_id']);
                    Session::login();
                    redirect_to('index');

//                    if (isset($_SERVER['HTTP_REFERER'])) {
//                        redirect_to($_SERVER['HTTP_REFERER']);
//                    }


                } else {
                    Message::add('No such user found', Message::STATUS_WARNING);
                    if (isset($_SERVER['HTTP_REFERER'])) {
                        redirect_to($_SERVER['HTTP_REFERER']);
                    }
                }
            }

        }


        $this->view->generate_view();

    }

    public function logout()
    {
        //echo '<h1>belgo</h1>';die;
        //Session::end();
        Session::set('loggedIn', false);
//        Session::logout();
        Session::end();
        //unset($_SESSION);
        //$_SESSION = array();

       redirect_to(href('login'));

    }

}
