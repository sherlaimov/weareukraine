<?php

//DB constants
define('DB_USER', 'root');
define('DB_PSWD', '');
define('DB_HOST', 'localhost');
define('DB_NAME', 'mvc');


defined('PUBLIC_URL')
|| define('PUBLIC_URL', (isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] ?
        'https' : 'http') . "://" . $_SERVER['SERVER_NAME'] . ($_SERVER['SERVER_PORT'] != 80 ?
        ":{$_SERVER['SERVER_PORT']}" : '') . rtrim(dirname($_SERVER['SCRIPT_NAME']), '/'));

define('DS', DIRECTORY_SEPARATOR);
define('URL', 'http://weareukraine/');
define('HASH_KEY', 'secret');

define('ROOT',   realpath( dirname(__FILE__) . '/../../') . DS );
//echo ROOT . '<br/>';

define('FS_APP', ROOT. 'app' . DS);

define('CORE', 'core/'); //how do I define this correctly?

define('FS_IMAGES', ROOT . 'public/images' . DS);

define('WS_IMAGES', URL . 'public/images/');


define('VIEWS', FS_APP. 'views' . DS);

define('FS_CONTROLLERS', FS_APP . 'controllers' . DS );