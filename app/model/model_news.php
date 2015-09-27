<?php

class Model_News extends Model
{

    public function getNews()
    {
        return $res = $this->get('news', 7, 'ORDER BY id DESC');
    }

    public function getNewsWithAuthor()
    {
        $sql = 'SELECT news.user_id, news.title, news.body, news.created, user.first_name, user.last_name FROM news, user
        WHERE news.user_id = user.user_id ORDER BY news.id';

        $sql = 'SELECT n.user_id, n.title, n.body, n.created, u.first_name, u.last_name
        FROM news AS n
        INNER JOIN  user AS u ON n.user_id = u.user_id
        WHERE 1 ORDER BY n.id';


        try {
            $sth = $this->_mysql->query($sql);
            $row = $sth->fetch_all(MYSQL_ASSOC);
        } catch (Exception $e) {
            echo $e->getMessage();
        }
        return isset($row) ? $row : FALSE;
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

       $res = $this->query('SELECT COUNT(*) AS cnt FROM news');

        $res = array_shift($res);
        $count = $res['cnt'];
//        var_dump($count); die;
        return $count;
    }

    public function countUserNews()
    {
        $id = $_SESSION['user_id'];
        $res = $this->query('SELECT COUNT(*) FROM news WHERE user_id ='. $id);
        $res = array_pop($res);
        $count = array_values($res);
        return (int) $count[0];
    }

}