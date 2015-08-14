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
       /*
        $this->where('login', $login);
        $this->where('password', $password);
        $user = $this->get('user');

        foreach($user as $v) {
            $this->user_id = $v['user_id'];
            $this->login = $v['login'];
            $this->password = $v['password'];
            $this->role = $v['role'];
            $this->first_name = $v['first_name'];
            $this->last_name = $v['last_name'];
            $this->comment_id = $v['comment_id'];
        }
       */
    }

    public function fullName(){
        if(isset($this->first_name) && isset($this->last_name)){
            return $this->first_name . ' ' . $this->last_name;
        } else {
            return 'First and last names are not set';
        }
    }


    public function authenticate($username='', $password=''){
        $this->where('login', $username);
        $this->where('password', $password);
        $result =  $this->get('user', 1);

//        $res = self::query('SELECT * FROM user WHERE login = '.$username.' AND
//                            password = '.$password.' LIMIT 1');
        return isset($result) ? (array_shift($result)) : FALSE;
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
        return $this->get('user');
       // $STH = $STH->query("SELECT user_id, login, role FROM users WHERE user_id = '$id'");


    }

    public function editUser($data)
    {
        $updateData = array(
            'login' => $data['login'],
            'password' => $data['password'],
            'role' => $data['role']
        );
        $this->where('user_id', $data['user_id']);
        return ($this->update('user', $updateData)) ? TRUE : FALSE;

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