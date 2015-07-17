<?php

class Model_News extends Model
{

    public function get_news()
    {
        return $res = $this->get('news');
    }

    public function get_one_news()
    {
        $this->where('id', $_GET['article_id']);
        $res = $this->get('news');
        return $res;
    }

    public function insertNews($news)
    {

        $insertData = array(
            'title' => $news['title'],
            'body' => $news['body']
        );
        return ($this->insret('news', $insertData)) ? true : false;
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
        $updateData = array(
            'title' => $data['title'],
            'body' => $data['body']
        );
        return $this->update('news', $updateData);
    }

    public function addNews($data, $image = NULL)
    {
        $insertData = array(
            'title' => $data['title'],
            'body' => $data['body'],
            'image_name' => $data['image_name'],
            'thumb' => $data['thumb']
        );

        //print_r($insertData); die;
        return $this->insert('news', $insertData);

    }
}