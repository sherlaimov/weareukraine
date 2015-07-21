<?php

class User extends Model {
    protected static $table_name = 'user';
    protected static $db_fields = array('user_id', 'login', 'password', 'role', 'first_name', 'last_name');
    public $user_id;
    public $login;
    public $password;
    public $first_name;
    public $last_name;

    public function full_name(){
        if(isset($this->first_name) && isset($this->last_name)){
            return $this->first_name . ' ' . $this->last_name;
        } else {
            return 'First and last names are not set';
        }
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