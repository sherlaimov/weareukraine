<?php
/**
 * Created by PhpStorm.
 * User: ES
 * Date: 14.08.2015
 * Time: 0:07
 */

class User {
    protected $_data = array();
    protected $_model = null;

    public function __construct($id) {

        $this->_model = new Model_User();

        if ((int) $id ) {
           $this->_data = $this->_model->getUserById($id);
            $this->_data = array_shift($this->_data);
        }
    }

    public function get($key, $defVAlue = '') {

        if ( isset($this->_data[$key]) ) {
            return $this->_data[$key];
        }

        return $defVAlue;
    }

    public function fullName() {
        //echo 'BELGO';
        return $this->get('first_name') . ' ' . $this->get('last_name');
    }

    public function isUserLoaded() {

        if ( $this->get('user_id') ) {
            return true;
        }
        return false;
    }
}