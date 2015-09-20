<?php
/**
 * Created by PhpStorm.
 * User: ES
 * Date: 20.09.2015
 * Time: 19:00
 */

abstract class controllerBase {

    public  function __construct() {
       // $this->init();
        $this->loadLibrary('functions');
    }

    public function loadLibrary($name) {
        $path = FS_APP. DS . 'libs' .DS. $name . '.php';

        if (file_exists($path)) {
            include_once($path);
        } else {
            throw new Exception ('Cannot find library '.$name);
        }
    }

    //public

    abstract public function init();

    public function load_model($name) {
        //1. Initiate the model if exists
        $model_name = 'Model_' . $name;
        $model_file = strtolower($model_name) . '.php';
        if (file_exists('app/model/' . $model_file)) {
//            var_dump($model_file); die();
            include FS_APP . 'model/' . $model_file;
            return new $model_name;
        } else {
            return false;
        }
    }
}

