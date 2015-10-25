<?php

class Model_News extends Model
{

    public function getNews()
    {
        return $res = $this->get('news', 7, 'ORDER BY id DESC');
    }

    public function getUserNews($user_id)
    {
        $this->where('user_id', $user_id);
        return $this->get('news', null, 'ORDER BY id DESC');
    }
    public function getNewsWithAuthor()
    {
        //same as in findByOffset()
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

    public function get_one_news($news_id, $full = false)
    {
        //$news_id = (int) $_GET['article_id'];
        $res = false;

        if ($full) {

            $sql = 'SELECT n.user_id, n.title, n.body, n.created, n.image_name, n.thumb,
                      c.body as comment_body, c.user_id,
                      u.*
        FROM news AS n
        INNER JOIN comment AS c ON n.id = c.news_id
        INNER JOIN user AS u ON u.user_id = c.user_id
        WHERE id=' . $news_id;
        $sql = 'SELECT n.id, n.user_id, n.title, n.body, n.created, n.image_name,
                        u.first_name, u.last_name
                        FROM news AS n
                        INNER JOIN user AS u ON n.user_id = u.user_id
                        WHERE id=' . $news_id;
//      news body overriden by comment body, WHY?
        return $res = $this->query($sql);

        } else {

            if ((int)$news_id) {
                $this->where('id', $news_id);
                $res = $this->get('news');
            }
        }

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
        $postData = array('title' => 'title', 'body' => 'body', 'image_name' => 'image_name', 'thumb' => 'thumb_name',
                            'user_id' => 'user_id', 'created' => 'created', 'updated' => 'updated');
        $insertData = array();
        foreach ($postData as $k => $v) {
            if (! empty($data[$v])){
                $insertData[$k] = $data[$v];
            }
        }

        //var_dump($insertData); die;
        //print_r($insertData); die;
        return $this->insert('news', $insertData);

    }


    public function deleteNews($id)
    {
        $data = array_shift($this->get_one_news($id));
        $path = FS_IMAGES . $data['image_name'];
//        var_dump($path);
        if ($data['image_name'] != null && $data['thumb'] != null) {
            File::delete(FS_IMAGES . $data['image_name']);
            unlink(FS_IMAGES . 'thumb' . DS . $data['thumb']);
        }

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
        $fields = array('title', 'body', 'image_name', 'thumb', 'created');
        $updateData = array();
        foreach($fields as $field) {
            if( ! empty ($data[$field])) {
                $updateData[$field] = $data[$field];
            }
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

    public function countUserNews($id)
    {
        $res = $this->query('SELECT COUNT(*) AS cnt FROM news WHERE user_id = ' . $id);
        return $res[0]['cnt'];
    }

    public function countCurrentUserNews()
    {
        $id = $_SESSION['user_id'];
        $res = $this->query('SELECT COUNT(*) FROM news WHERE user_id ='. $id);
        $res = array_pop($res);
        $count = array_values($res);
        return (int) $count[0];
    }

}