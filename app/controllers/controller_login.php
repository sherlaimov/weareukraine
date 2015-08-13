<?php

class Controller_Login extends Controller
{

    public $output = array();

    function init()
    {
        //parent::__construct();
        $this->model = $this->load_model('login');
        //$this->login();
    }

    function index()
    {

        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $login = trim($_POST['login']);
            $password = trim($_POST['password']);
            $password = Hash::create_hash('md5', $password, HASH_KEY);


            if (empty($login) || empty($password)) {

                Session::set('loginFail', true);

                if ($_SESSION['loginFail'] == true) {
                    Message::add('Please, enter login and pass', Message::STATUS_ERROR);

                }

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
               /*
                    Session::set('role', $data['role']);
                    $user = new User($login, $data['password']);
                    Session::set('userObj', $user);
                */
                    if (isset($_SERVER['HTTP_REFERER'])) {
                        redirect_to($_SERVER['HTTP_REFERER']);
                    }


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

        if (isset($_SERVER['HTTP_REFERER'])) {
            redirect_to($_SERVER['HTTP_REFERER']);
        } else {
            redirect_to(' /');
        }

    }

}
