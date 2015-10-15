<?php

class Controller_User extends ControllerBackend {

    function init() {

        $this->model = new Model_User();
        $this->view->setLayout('admin_view');

        $logged = Session::get('loggedIn');
        if($logged == false || $this->user->get('role') == 'default'){
            redirect_to(href('login'));
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
        redirect_to(href('user'));

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
        if($this->model->editUser($data)){
            Message::add('User successfully updated', Message::STATUS_SUCCESS);
            redirect_to(href("user/edit/$id"));
        } else {
            Message::add('Could not update user', Message::STATUS_ERROR);
            redirect_to(href("user/edit/$id"));
        }
    }

    public function delete($id)
    {
        $this->model->deleteUser($id);
        redirect_to(href('user'));


    }

}