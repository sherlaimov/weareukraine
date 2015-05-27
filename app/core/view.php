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
            $url = isset($_GET['url']) ? rtrim($_GET['url'], '/') : null;
            $url = filter_var($url, FILTER_SANITIZE_URL);
            $url = explode('/', $url);

            if (! empty($url[0])) {
                $content_view = $url[0].'_';

                if ( ! empty($url[1])) {
                    $content_view .= $url[1];
                } else {
                    $content_view .= 'index';
                }

            } else {
                $content_view = 'main_index';
            }

            $content_view .= '.php';

            //echo '<h1>'. $content_view . '</h1>';

            if(! file_exists(VIEWS . $content_view)){
               //echo 'BELGO file doesnt exist ' . '<br/>';
                header('Location: ' . URL);
            }

        } else {
            $content_view = $fileName;
        }

       //print_r($this->data);

        //extract($this->data);
       $data = $this->data;
        //var_dump($data);
        include 'app/views/' . $this->layout . '.php';

    }

    public function transferNews($news){
        //var_dump($news);
        $this->data = $news;

    }

    public function setData($name, $value) {

        $this->data[] = $this->data[$name] = $value;
    }



	
}
