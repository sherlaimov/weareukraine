<?php

class Message {

    const STATUS_NORMAL = 'alert';
    const STATUS_WARNING = 'alert alert-warning';
    const STATUS_ERROR = 'alert alert-danger';

    protected static $message = array();


    public static function add($text, $type = '', $session = true) {

        if ($type === '') {
            $type = self::STATUS_NORMAL;
        }

        self::$message[] = array('text' => $text, 'type' => $type);

       if ($session) {
           $_SESSION['message'] = self::$message;
       }
    }

    public static function removeMessage() {
        self::$message = array();
        unset($_SESSION['message']);
    }

    public static function getMessages($removeMessage = true) {

        if (isset($_SESSION['message']) && is_array($_SESSION['message'])) {
            $messages = array_merge(self::$message, $_SESSION['message']);
        } else {
            $messages = self::$message;
        }

        if ($removeMessage) {
            self::removeMessage();
        }

        return $messages;
    }

}
