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
        //$this->where('password ', $password);
        $this->where('login', $login);
        $res =  $this->get('user', 1);

//        $res = $this->query('SELECT * FROM user WHERE login = '.$username.' AND
//                            password = '.$password.' LIMIT 1');
//        $res = $this->query("SELECT first_name, last_name FROM user WHERE login = " . "'$login'");
//        echo 'belgo';
//        var_dump($res); die;
        return isset($res) ? (array_shift($res)) : FALSE;
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