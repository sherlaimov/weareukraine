<?php

class Controller_News extends Controller {

    function init() {

        $this->model = $this->load_model('news');

    }

    function index(){
        //$news = $this->model->get_news();
        //$this->view->allNews = $this->model->countAll();

        $pagination = new Pagination(1, 3);
        $pagination->current_page = isset($_GET['page']) ? $_GET['page'] : 1;
        //var_dump($pagination);
        $news = $pagination->findByOffset();
        $this->view->setData('news', $news);
        $this->view->setData('pagination', $pagination);
        $this->view->generate_view();
    }

    function one_news(){
        $news = $this->model->get_one_news();
        //print_r($news); die;
        $this->view->setData('news', $news);
        $this->view->generate_view();
    }

    public function delete($id){
        $this->model->deleteNews($id);
        header('Location: ' . URL . 'news');
        exit;

    }

    public function edit($id) {

        if ($this->isPost()) {
            $this->editSave($id);
        }

        $news = $this->model->selectOneNews($id);
        $this->view->setData('news', $news);
        $this->view->generate_view();
    }

    public function editSave($id){
        $data = array();
        $data['id'] = $id;

        if ( ! empty($_POST['title']) && ! empty ($_POST['body'])) {
            $data['title'] = trim($_POST['title']);
            $data['body'] = trim($_POST['body']);
            if ($_FILES['upload']) {
                //echo 'BELGO'; die; CHUDESA BLYAD!
                $imageData = $this->get_image_info();
                $data = array_merge($data, $imageData);

                $bitmap = $this->create_thumbnail($imageData['file_destination'], false, $imageData['width'], $imageData['height']);
                imagejpeg($bitmap, FS_IMAGES . 'thumb' . DS . $imageData['thumb_name']);
            }

            $this->model->updateNews($data);
            header('Location: ' . URL . 'news');
            exit;
        } else {
            Message::add('Both body and title must be filled', Message::STATUS_ERROR);
            if (count($_POST)) {
                $data = array(
                    'title' => trim($_POST['title']),
                    'body' => trim($_POST['body']),
                    'id'   => trim($id));
            }
            $this->view->setData('data', $data);
            //header('Location: ' . URL . 'news/edit/' . $id);
            //exit;
        }
    }

    public function add($id = null) {

        if (Session::get('loggedIn') == FALSE || Session::get('role') == 'default') {
            Message::add('You have to be authorized to add news', Message::STATUS_WARNING);
            header('Location: ' . URL . 'login/');
            exit;
        }
        if (isset($id)) {
            if ($this->isPost()) {
                $this->editSave($id);
            }
            $news = $this->model->selectOneNews($id);
            $this->view->setData('news', $news);
            $this->view->generate_view();
        }
        if ($_POST) {
           $this->addNews();
        }
        $this->view->generate_view();
    }


    public function addNews() {

        $data = array(
            'title' => trim($_POST['title']),
            'body' => trim($_POST['body'])
        );

        if ( empty($data['title']) || empty($data['body'])) {
            Message::add('Title and body can not be empty', Message::STATUS_WARNING);
            if( count($_POST)) {
                $this->view->setData('post', $data);
               /// header('Location: ' . URL . 'news/add');
            }
        }
        else
        {
            if ($_FILES['upload']) {
                $imageData = $this->get_image_info();
                $data = array_merge($data, $imageData);
                //print_r($data); die;
                $bitmap = $this->create_thumbnail($imageData['file_destination'], false, $imageData['width'], $imageData['height']);
                imagejpeg($bitmap, FS_IMAGES . 'thumb' . DS . $imageData['thumb_name']);
                //$data = array_merge($data, $this->get_image_info());
            }

            $this->model->addNews($data);
            redirect_to(URL . 'news');
        }
    }


    function get_image_info()
    {
        $file = $_FILES['upload'];
        $image_name = $_FILES['upload']['name'];
        $image_type = $file['type'];
        $image_size = $_FILES['upload']['size'];
        $tmp_name = $_FILES['upload']['tmp_name'];
        $error = $_FILES['upload']['error'];

        $fileInfo = pathinfo($image_name);

        $file_ext = explode('.', $image_name);
        $file_ext = strtolower(end($file_ext));


        if ($image_size == FALSE) {
            Message::add('That is not an image', Message::STATUS_WARNING);
        }

        $allowed = array('jpg', 'jpeg', 'png', 'gif');
        if (in_array($file_ext, $allowed)) {

            if ($error > 0) {
                die("Error uploading file! Code $error.");
            } else {

                $file_name_tmp = md5($fileInfo['filename'] . rand(0, 10000)); //uniqid('', true);
                $file_name_new = $file_name_tmp . '.' . $file_ext;

                $data['file_destination'] = $file_destination = FS_IMAGES . $file_name_new;

                if (move_uploaded_file($tmp_name, $file_destination)) {
                    $data['image_name'] = $file_name_new;
                    $data['file_path'] = $file_destination;

                    if (isset($_POST['width'])) {
                        $data['width'] = $_POST['width'];
                        $data['height'] = $data['width'];
                    } else {
                        $data['width'] = 150;
                        $data['height'] = 150;
                    }

                    $thumbnailName = $file_name_tmp . '_' . $data['width'] . '_' . $data['height'] . '.jpg';
                    $data['thumb_name'] = $thumbnailName;
                    //echo $data['thumb']; die;
                    //$bitmap = $this->create_thumbnail($file_destination, false, $data['width'], $data['height']);
                    //imagejpeg($bitmap, FS_IMAGES . 'thumb' . DS . $thumbnailName);
                    return $data;
                }
            }
        }
    }


    public function create_thumbnail($path, $save, $width, $height)
    {
        $info = getimagesize($path);
//        echo $path . '<br/>';
//        print_r($info);
//        echo '<br/>';
        $fileInfo = pathinfo($path);
        //print_r($fileInfo);die;


        $size = array($info[0], $info[1]);

        if($info['mime'] == 'image/png'){
            $src = imagecreatefrompng($path);
        } elseif($info['mime'] == 'image/jpeg'){
            $src = imagecreatefromjpeg($path);
        } elseif($info['mime'] == 'image/gif'){
            $src = imagecreatefromgif($path);
        } else {
            return false;
        }

        $testGD = get_extension_funcs("gd"); // Grab function list
        if (!$testGD){ echo "<br>GD not even installed."; exit; }
        //echo"<pre>".print_r($testGD,true)."</pre>";
        //echo get_loaded_extensions("gd");
        $thumb = imagecreatetruecolor($width, $height);
        $src_aspect = $size[0] / $size[1];
        //echo $src_aspect;
        $thumb_aspect = $width / $height;

        //$src = imagecreate(50, 50);
        //print_r($src);

        if($src_aspect < $thumb_aspect)
        {
            //narrower

            //determine scale factor
            $scale = $width / $size[0]; //desired thumbnail width divided by actual width
            $new_size = array($width, $width / $src_aspect);
            $src_pos = array(0, ($size[1] * $scale - $height) / $scale / 2); //x and y axis

        } elseif ($src_aspect > $thumb_aspect)
        {
            //wider
            $scale = $height / $size[1];
            $new_size = array($height * $src_aspect, $height);
            $src_pos = array(($size[0] * $scale - $width) / $scale / 2, 0);

        } else
        {
            //same shape
            $new_size = array($width, $height);
            $src_pos = array(0, 0);
        }

        $new_size[0] = max($new_size[0], 1);
        $new_size[1] = max($new_size[1], 1);

        imagecopyresampled($thumb,$src, 0, 0, $src_pos[0], $src_pos[1], $new_size[0], $new_size[1], $size[0], $size[1]);

        return $thumb;

    }

}