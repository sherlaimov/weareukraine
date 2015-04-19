<?php

class Session {

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

    public static function end() {

        session_unset();
        //diff between session_destroy?
    }

    public static function is_logged_in() {
        return isset($_SESSION['login']);
    }

}
