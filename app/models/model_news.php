<?php

class Model_News extends Model {

    public function get_news(){
        $conn = $this->DB();
        //var_dump($conn); die();
        if($res = $conn->query("SELECT * FROM news ORDER BY id DESC LIMIT 10")){
            if($count = $res->num_rows){
               // echo '<h1>'. $count . '</h1>';
                $rows = $res->fetch_all(MYSQLI_ASSOC);
               //echo '<pre>', print_r($res), '</pre>';
                $res->free();
                return $rows;


            } else {
                return false;
            }
        }

        //var_dump($res->fetch_all()); die;
        //var_dump($res->fetch_object()); die;
        //$res = $res->fetch_object();


    }
    
    public function get_one_news(){
        $conn = $this->DB();
        $id = $_GET['article_id'];
        //var_dump($id);
        $res = $conn->query("SELECT * FROM news WHERE id ='$id' LIMIT 1 ");
        return $res;
    }

    public function updateNews($news){
        $conn = $this->DB();
        $title = $news['title'];
        $body = $conn->real_escape_string($news['body']);
        //$conn->prepare("INSERT INTO news (title, body) VALUES (:title, :body)");
//        $conn->mysqli_stmt_bind_param(array(
//           ':title' => $news['title'],
//            ':body' => $news['body']
//        ));
        $conn->query(" INSERT INTO news (title, body) VALUES ('$title', '$body' )") or die($conn->error);

    }

    public function deleteNews($id){
        $STH = $this->DB();
        $STH->query("DELETE FROM news WHERE id = '$id' LIMIT 1");
    }

    public function selectOneNews($id){
        $conn = $this->DB();
        //var_dump($id);
        $res = $conn->query("SELECT * FROM news WHERE id ='$id' LIMIT 1 ");
        // echo '<pr>' . print_r($res) . '</pr>';
        $belgo = $res->fetch_assoc();
        return $belgo;
    }

    public function editNews($id){
        $conn = $this->DB();
         //var_dump($id);
        $res = $conn->query("SELECT * FROM news WHERE id ='$id' LIMIT 1 ");
       // echo '<pr>' . print_r($res) . '</pr>';
        $belgo = $res->fetch_assoc();
        return $belgo;
    }

    public function editSaveNews($data){
        $STH = $this->DB();
       // extract($data);
       $STH->query('UPDATE news SET title = "'.$data['title'].'",
                    body = "'.$data['body'].'" WHERE id = '.(int) $data['id']);

    }

    public function addNews($data, $image = NULL){
        $conn = $this->DB();
        $title = $data['title'];
        $body = $conn->real_escape_string($data['body']);


        if (isset($image))
        {
            $conn->query(" INSERT INTO news (title, body, image, image_name, thumb)
                          VALUES ('$title', '$body', '$image', '" . $data['image_name'] . "', '" . $data['thumb'] ."'   )") or die($conn->error);

        } else
        {
            $conn->query(" INSERT INTO news (title, body, image_name, thumb)
                          VALUES ('$title', '$body', '" . $data['image_name'] . "', '" . $data['thumb'] . "' )") or die($conn->error);
//            $lastid = mysqli_insert_id($conn);
//            printf($lastid);
        }
    }


}