<?php

class Controller_User extends ControllerBackend {

    function init() {

        $this->model = new Model_User();
        $this->view->setLayout('admin_view');

        $logged = Session::get('loggedIn');
        if($logged == false || $this->user->get('role') == 'default'){
            header('Location: ' . URL . 'admin/login');
            exit;
        }

    }

    public function index() {

        $this->view->userList = $this->model->getUsers();

        $this->view->generate_view();
    }

    public function create()
    {
        $data = array();
        $data['login'] = trim($_POST['login']);
        $data['password'] = trim($_POST['password']);
        $data['role'] = trim($_POST['role']);

        $this->model->insertUser($data);
        header('Location: ' . URL . 'user');

    }

    public function edit($id)
    {
//        die('works');
        //fetch individual user
//        var_dump($this->user);die;
        $user = $this->view->user = $this->model->getUserById($id);
//        var_dump($user);
        $this->view->generate_view();
    }

    public function editSave($id){

        $data = array();
        $data['user_id'] = $id;
        $data['login'] = trim($_POST['login']);
        $data['password'] = Hash::create_hash('md5',(trim($_POST['password'])), HASH_KEY );
        $data['role'] = trim($_POST['role']);
        ///print_r($data); die;
        $this->model->editUser($data);
        header('Location: ' . URL . 'user');
    }

    public function delete($id)
    {
        $this->model->deleteUser($id);
        header('Location: ' . URL . 'user');


    }

}