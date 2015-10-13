<?php

function redirect_to($location = NULL)
{

    if ($location != NULL) {
        header("Location: $location");
        exit; //why do we have to exit?
    }
}

function href($url, $getParam = array())
{
// array( 'module' => 'frontend', 'controller' => 'tweets', 'action' => 'index') ;
    //дописать условие для модуля, переход из админки в фронтенд
    //DS - разделитель для файловой системы!
    'http:://weareukraine/module?/controller/action';

    $oRoute = Route::getInstance();
//  $oRoute->getControllerName().'_'.$oRoute->getActionName().'.php';
    //http://weareukraine/news/one_news?article_id=60&user_post=4&qwerty=5
    $params = '';

    if (is_array($getParam) && count($getParam)) {

        $params = array();
        foreach($getParam as $k => $v) {
            $params[] = $k . '=' . $v;
        }

        $params = '?' . implode('&', $params);

    }



    if (is_string($url)) {
        // then convert it to this type of record array('controller' => 'tweets', 'action' => 'index')
        //$arr = array('controller' => '', 'action' => '');
        $url = explode('/', $url);
//        var_dump($url);die;

        //Написать класс Request, который обрабатывает URL параметры
        // попробовать переписать передачу параметров = http://weareukraine/news/one_news/article_id/60/page_id/82
        // href('tweets/index/news_id/1', array('one_news', 60));

    }

    if (is_array($url)) {

           // $arr = array('controller' => $url[0], 'action' => $url[1]);
//            var_dump($oRoute->getModuleName());
            if ($oRoute->isFrontEnd() === FALSE) {
                if ($url[0] == 'frontend') {
                    array_shift($url);
                } else {
                    array_unshift($url, $oRoute->getModuleName());

                }
//                    var_dump($url);
            }

            $v = implode('/', $url);
//            var_dump($v);
            return URL . implode('/', $url) . $params;

    }

        /* если модуль не подключен, но я нахожусь в админке, то автоматически дописуется админ
        if (is_array($url)) {

        }*/

        //array to $url string
//    return URL . $arr['controller'] . DS . $arr['action'] . DS;

}