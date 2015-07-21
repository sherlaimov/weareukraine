<?php

class Session {
    private static $loggedIn = false;
    public static $userId;
    public static $userRole;


    public static function init() {
        session_start();
    }

    public static function set($key, $value) {
        $_SESSION[$key] = $value;
    }

    public static function get($key) {
        if (isset($_SESSION[$key])) {
            return $_SESSION[$key];
        }
    }

    public static function login($userData) {
        if($userData) {
            self::$userId = $_SESSION['user_id'] = $userData['user_id']; //no User class here but in login.php there IS!
            self::$loggedIn = $_SESSION['loggedIn'] = true;
        }
    }

    private function check_login(){
        if(isset($_SESSION['user_id'])){ //WHERE DO WE SET THE $_SESSION VALUE?
            $this->user_id = $_SESSION['user_id'];
            $this->logged_in = true;
        } else {
            unset($this->user_id);
            $this->logged_in = false;
        }
    }

    public static function logout(){
        unset($_SESSION['user_id']);
        unset(self::$userId);
        self::$loggedIn = $_SESSION['loggedIn'] = false;
    }


    public static function end() {

        session_unset();
        //diff between session_destroy?
    }

    public static function isLoggedIn() {
        return self::$loggedIn;
    }

}
