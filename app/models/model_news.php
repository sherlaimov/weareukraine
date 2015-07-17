<?php

class Model_News extends Model {

    public function get_news(){
      return $res = $this->get('news');
    }
    
    public function get_one_news(){
        $this->where('id', $_GET['article_id']);
        $res = $this->get('news');
        return $res;
    }

    public function updateNews($news){

        $updateData = array(
            'title' => $news['title'],
            'body'  => $news['body']
        );
        return ($this->insret('news', $updateData)) ? true : false;
    }


    public function deleteNews($id){
        $this->where('id', $id);
        return $this->delete('news');
    }

    public function selectOneNews($id){
        $this->where('id', $id);
        return  $this->get('news', 1);

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
        }
    }


}