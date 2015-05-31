<?php

// подключаем файлы ядра

require_once 'config/config.php';

function __autoload($class){
	require_once CORE . strtolower($class) . '.php';
}


//require_once 'core/session.php';
//require_once 'core/model.php';
//require_once 'core/view.php';
//require_once 'core/controller.php';
//require_once 'core/hash.php';


//require_once 'core/route.php';
//Route::start(); // запускаем маршрутизатор
$route = Route::getInstance();
//$route->parseUrl();
$route->start(); //HOW TO DO IT WITH A STATIC METHOD?
