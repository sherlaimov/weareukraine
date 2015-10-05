<?php

class Model_User extends Model {

    protected static $table_name = 'user';
    protected static $db_fields = array('user_id', 'login', 'password', 'role', 'first_name', 'last_name');
    public $user_id;
    public $login;
    public $password;
    public $first_name;
    public $last_name;
    public $comment_id;


    public function __construct() {

        parent::__construct();

    }

    public function fullName(){
        if(isset($this->first_name) && isset($this->last_name)){
            return $this->first_name . ' ' . $this->last_name;
        } else {
            return 'First and last names are not set';
        }
    }


    public function authenticate($login='', $password=''){
        $sql = 'SELECT * FROM user WHERE login=' . "'$login' " . 'AND password=' . "'$password'" . ' LIMIT 1';
        try {
            $sth = $this->_mysql->query($sql);
            $row = $sth->fetch_array(MYSQL_ASSOC);
        } catch (Exception $e) {
            echo $e->getMessage();
        }
        return isset($row) ? $row : FALSE;
    }

    public function registerUser($data = array()){
        $insertData = array(
            'login' => $data['login'],
            'password' => $data['password'],
            'first_name' => $data['first_name'],
            'last_name' => $data['last_name']
        );
        $this->insert('user', $insertData);
        return true;
    }

    public function getUsers(){

       return $this->query("SELECT user_id, login, role FROM user");

    }


    public function insertUser($data)
    {
        $insertData = array(
            'login' => $data['login'],
            'password' => $data['password'],
            'role' => $data['role']
        );

       return ($this->insert('user', $insertData)) ? TRUE : FALSE;

    }

    public function getUserById($id)
    {
        $this->where('user_id', $id);
        $user = $this->get('user');

        if (is_array($user) && isset($user[0])) {
            return $user[0];
        }
        return false;

       // $STH = $STH->query("SELECT user_id, login, role FROM users WHERE user_id = '$id'")

    }

    public function editUser($data)
    {
        $var = $_GET['url'];
        $var = explode('/', $var);
//        var_dump($var[0]);
        if ($this->isAdmin($data['user_id']) && $var[0] != 'profile') {
            $updateData = array(
                'login' => $data['login'],
                'password' => $data['password'],
                'role' => $data['role']
            );
        } else {

            $updateData = array(
                'login' => $data['login'],
                'first_name' => $data['first_name'],
                'last_name' => $data['last_name'],
            );

            if (isset($data['image_name']) && isset($data['thumb_name'])){
                $updateData['profile_image'] = $data['image_name'];
                $updateData['profile_thumb'] = $data['thumb_name'];
            }

            if( ! empty($data['new_password'])) {
                $updateData['password'] = $data['new_password'];
            }
        }


        $this->where('user_id', $data['user_id']);
        return ($this->update('user', $updateData)) ? TRUE : FALSE;

    }

    public function isAdmin($id)
    {
        $data = $this->getUserById($id);
        if( $data['role'] == 'admin' || $data['role'] == 'owner') {
            return TRUE;
        }
        return FALSE;

    }
    public function deleteUser($id)
    {

       $res = $this->query("SELECT role FROM user WHERE user_id = $id");
       $res = array_shift($res);
        if($res['role'] == 'owner') {
            return false;
        } else {
            $this->where('user_id', $id);
            return ($this->delete('user')) ? true : false;

        }

    }


}