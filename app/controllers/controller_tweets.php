<?php

class Controller_Tweets extends Controller
{
    public function __construct()
    {
        parent::__construct();
//        $this->loadLibrary('tmhOAuth');
       // $this->loadLibrary('tweets_json');
//        require_once(FS_APP . DS . 'libs/cacert.pem');
    }

    public function gettweets()
    {
        $connection = new tmhOAuth(array(
            'consumer_key' => 'T7GjB1rlXQ7zVI4JEObESroZk',
            'consumer_secret' => 'cT1abZvYAoZAths2eU255DELDdjsnMiEJbHpxGwgqNNQoXj3pK',
            'user_token' => '263744389-a6qGXvoL2rNiWb5SH1AN9SLlAXxG8cLpjQMaCpfG', //access token
            'user_secret' => 'mCZAOxSSzAZqtj1dGVQkviuJ1ZaILHdMiJWm10ZwALqKJ' //access token secret
        ));

// set up parameters to pass
        $parameters = array();

        if ($_GET['count']) {
            $parameters['count'] = strip_tags($_GET['count']);
        }

        if ($_GET['screen_name']) {
            $parameters['screen_name'] = strip_tags($_GET['screen_name']);
        }

        if ($_GET['twitter_path']) { $twitter_path = $_GET['twitter_path']; }  else {
            $twitter_path = '1.1/statuses/user_timeline.json';
        }

        $http_code = $connection->request('GET', $connection->url($twitter_path), $parameters );

        if ($http_code === 200) { // if everything's good
            $response = strip_tags($connection->response['response']);

            if ($_GET['callback']) { // if we ask for a jsonp callback function
                echo $_GET['callback'],'(', $response,');';
            } else {
                echo $response;
            }
        } else {
            echo "Error ID: ",$http_code, "<br>\n";
            echo "Error: ",$connection->response['error'], "<br>\n";
        }
        die;
    }

    public function index() {
        $this->view->generate_view();
    }
}