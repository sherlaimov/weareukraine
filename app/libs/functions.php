<?php

function redirect_to($location = NULL){

    if($location != NULL){
        header("Location: $location");
        exit; //why do we have to exit?
    }
}

function href($url, $getParam = array()) { // array( 'module' => '', 'controller' => 'tweets', 'action' => 'index') ;
    'http:://weareukraine/module?/controller/action';
//    $url = $_GET['url'];
//    $url = $_SERVER['REQUEST_URI'];
//    var_dump($url);
    //$getParam = $_GET request value
    if (is_string($url)) {
       // then convert it to this type of record array('controller' => 'tweets', 'action' => 'index')
    }
    /* если модуль не подключен, но я нахожусь в админке, то автоматически дописуется админ
    if (is_array($url)) {

    }*/

    //array to $url string
    return URL . $url;
}

