<?php

function redirect_to($location = NULL){

    if($location != NULL){
        header("Location: $location");
        exit; //why do we have to exit?
    }
}

function href($url) {
    'http:://weareukraine/module?/controller/action';
//    $url = $_GET['url'];
//    $url = $_SERVER['REQUEST_URI'];
//    var_dump($url);
    return URL . $url;
}

