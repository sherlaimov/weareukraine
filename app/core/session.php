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
        return false;
    }

    public static function login($flag = true) {
        $_SESSION['loggedIn'] = $flag;
    }

    public static function logout(){
        unset($_SESSION['user_id']);
        unset(self::$userId);
        $_SESSION['loggedIn'] = false;
    }


    public static function end() {
        session_unset();
        //diff between session_destroy?
    }

    public static function isLoggedIn() {

        if (isset($_SESSION['loggedIn'])) {
            return $_SESSION['loggedIn'];
        }

        return false;
    }

    public static function isAuthorized(){
        //echo (self::get('loggedIn', TRUE)) ? 'BELGO' : null;
        //var_dump(self::$userId);
        if (self::get('loggedIn') == true && self::get('role') === 'admin' || self::get('role') === 'owner'){
            return true;
        } else {
            return false;
        }
    }

}
