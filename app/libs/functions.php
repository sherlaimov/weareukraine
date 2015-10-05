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
    if (is_string($url)) {
       // then convert it to this type of record array('controller' => 'tweets', 'action' => 'index')
    }
    /*
    if (is_array($url)) {

    }*/

    //array to $url string
    return URL . $url;
}

