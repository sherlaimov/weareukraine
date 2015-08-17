<?php

class Model_News extends Model
{

    public function get_news()
    {
        return $res = $this->get('news', 7, 'ORDER BY id DESC');
    }

    public function get_one_news()
    {
        $this->where('id', $_GET['article_id']);
        $res = $this->get('news');
        return $res;
    }

    public function addNews($data, $image = NULL)
    {
        //var_dump($data);die;
        $insertData = array(
            'title' => $data['title'],
            'body' => $data['body'],
            'image_name' => $data['image_name'],
            'thumb' => $data['thumb_name'],
            'user_id' => $data['user_id'],
            'created' => $data['created']

        );
        //var_dump($insertData); die;
        //print_r($insertData); die;
        return $this->insert('news', $insertData);

    }


    public function deleteNews($id)
    {
        $this->where('id', $id);
        return $this->delete('news');
    }

    public function selectOneNews($id)
    {
        $this->where('id', $id);
        return $this->get('news', 1);

    }

    public function updateNews($data)
    {
        $this->where('id', $data['id']);

        if ($data['image_name']) {
            $updateData = array(
                'title' => $data['title'],
                'body' => $data['body'],
                'image_name' => $data['image_name'],
                'thumb' => $data['thumb_name'],
                'created' => $data['created']
            );
        } else {
            $updateData = array(
                'title' => $data['title'],
                'body' => $data['body'],
                'created' => $data['created']

            );
        }

        return $this->update('news', $updateData);
    }

    public function countAll(){

       $res = $this->query("SELECT COUNT(*) FROM news");
        $res = array_shift($res);
        $count = array_values($res)[0];
        return $count;

    }

}