<?php

class Controller_User extends Controller{

    function init() {

        $this->model = $this->load_model('user');

        $logged = Session::get('loggedIn');
        $role = Session::get('role');
        if($logged == false || $role == 'default'){
           // Session::end();
            header('Location: ' . URL . 'login');
            exit;
        }

    }

    public function index(){
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
        //fetch individual user
        $user = $this->view->user = $this->model->getUserById($id);
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