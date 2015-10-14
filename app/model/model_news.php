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
        $news_id = (int) $_GET['article_id'];
        $sql = 'SELECT news.id, news.user_id, news.title, news.body, news.created, news.image_name, news.thumb,
                        comment.body, comment.created
                        FROM news, comment
                        WHERE comment_id=' . $news_id ;
//        $this->where('id', $news_id );
//        $news = $this->get('news');
//        $this->where('news_id', $news_id);
//        $comments = $this->get('comment');
        $res = $this->query($sql);
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