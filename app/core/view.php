<?php

class View

{
    public $content_view;
    protected $data = array();
    protected $layout = '';
    function __construct() {


    }

    public function setLayout($name) {
        $this->layout = $name;
    }


    function generate_view($fileName = '')
    {
        if ($fileName == '') {

            $oRoute = Route::getInstance();


            $content_view = $oRoute->getControllerName().'_'.$oRoute->getActionName().'.php';


            if ( ! file_exists(VIEWS . $content_view)){
               //echo 'BELGO file doesnt exist ' . '<br/>';
                header('Location: ' . URL ); //sends to index_index.php
            }

        } else {
            $content_view = $fileName;
        }



        //extract($this->data);
       $data = $this->data;
        //print_r($this->data); die;

        include 'app/views/' . $this->layout . '.php';

    }


    public function setData($name, $value) {

        $this->data[$name] = $value;
    }

    public function setArr(array $value) {
        $this->data = $value;
    }

    public function getArr() {
        return $this->data;
    }



	
}
