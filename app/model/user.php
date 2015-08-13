<?php

class UserTemp  extends Model {
    protected static $table_name = 'user';
    protected static $db_fields = array('user_id', 'login', 'password', 'role', 'first_name', 'last_name');
    public $user_id;
    public $login;
    public $password;
    public $first_name;
    public $last_name;
    public $comment_id;


    public function __construct($login, $password){
        parent::__construct();
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
}

    public function fullName(){
        if(isset($this->first_name) && isset($this->last_name)){
            return $this->first_name . ' ' . $this->last_name;
        } else {
            return 'First and last names are not set';
        }
    }

    public function setUser(){
        $this->user_id = Session::get('user_id');
        $this->login = Session::get('login');

    }


    public static function authenticate($username='', $password=''){
        $res = self::query("SELECT * FROM user WHERE login = '$username' AND
                            password = '$password' LIMIT 1");

//        $sql = "SELECT * FROM user ";
//        $sql .= "WHERE login = '$username' ";
//        $sql .= "AND password = '$password' ";
//        $sql .= "LIMIT 1";
//        $result_array = self::find_by_sql($sql); //returns OBJECT
        // var_dump($result_array); die();
        print_r($res); die;
        return !empty($result_array) ? array_shift($result_array): false; //WHY DO ARRAY_SHIFT?
    }


}