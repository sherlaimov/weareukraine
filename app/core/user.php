<?php

class User {
    protected $_data = array();
    protected $_model = null;

    public function __construct($id) {

        $this->_model = new Model_User();

        if ((int) $id ) {
           $this->_data = $this->_model->getUserById($id);
        }
    }

    public function getId() {
        return $this->get('user_id', false);
    }

    public function get($key, $defValue = '') {

        if ( isset($this->_data[$key]) ) {
//            var_dump($this->_data[$key]);
            return $this->_data[$key];
        }

        return $defValue;
    }

    public function getData()
    {
        return $this->_data;
    }

    public function fullName() {
//        echo 'BELGO';
        return $this->get('first_name') . ' ' . $this->get('last_name');
    }

    public function isUserLoaded() {

        if ( $this->get('user_id') ) {
            return true;
        }
        return false;
    }
}