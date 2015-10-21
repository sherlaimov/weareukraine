<?php

function redirect_to($location = NULL)
{

    if ($location != NULL) {
        header("Location: $location");
        exit; //why do we have to exit?
    }
}

function shortText($string)
{
    return substr_replace($string, '...' , 30);
}

function href($url, $getParam = array())
{
// array( 'module' => 'frontend', 'controller' => 'tweets', 'action' => 'index') ;

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
        $url = explode('/', $url);
        //Написать класс Request, который обрабатывает URL параметры
        // попробовать переписать передачу параметров = http://weareukraine/news/one_news/article_id/60/page_id/82
        // href('tweets/index/news_id/1', array('one_news', 60));

    }

    if (is_array($url)) {

            if ($oRoute->isFrontEnd() === FALSE) {
                if ($url[0] == 'frontend') {
                    array_shift($url);
                } else {
                    array_unshift($url, $oRoute->getModuleName());

                }
//                    var_dump($url);
            }

            $v = URL . implode('/', $url) . $params;
//            var_dump($v);die;
            return URL . implode('/', $url) . $params;

    }



}