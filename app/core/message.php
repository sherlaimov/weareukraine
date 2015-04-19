<?php

class Message {

    const STATUS_NORMAL = 'alert';
    const STATUS_WARNING = 'alert alert-warning';
    const STATUS_ERROR = 'alert alert-danger';

    protected static $message = array();


    public static function add($text, $type = '') {

        if ($type === '') {
            $type = self::STATUS_NORMAL;
        }

        self::$message[] = array('text' => $text, 'type' => $type);

       $_SESSION['message'] = self::$message;
    }

    public static function removeMessage(){
        unset($_SESSION['message']);
    }

    public static  function getMessages() {
        return self::$message;
    }

}
