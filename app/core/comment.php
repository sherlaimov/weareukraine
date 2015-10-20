<?php

class Comment extends Model
{

    protected $table_name = 'comment';
    protected static $db_fields = array('comment_id', 'news_id', 'created', 'updated', 'user_id', 'body');

    public $comment_id;
    public $news_id;
    public $created;
    public $user_id;
    public $body;


    public function __construct()
    {
        parent::__construct();

    }

    public function make($news_id, $user_id, $body)
    {
        if ( ! empty ($news_id) && ! empty ($user_id) && ! empty ($body)){
            $this->news_id = (int) $news_id;
            $this->created = strftime("%Y-%m-%d %H:%M:%S", time());
            $this->user_id = $user_id;
            $this->body = $body;
            //How to use that afterwards?
            $this->comment_id = $this->_mysql->insert_id;
            $this->insertComment();
        }
    }

//    public static function make($news_id, $user_id, $body)
//    {
//         if (!empty($news_id) && !empty($user_id) && !empty ($body)) {
//
//            $comment = new Comment();
//
//            $comment->news_id = (int)$news_id;
//            $comment->created = strftime("%Y-%m-%d %H:%M:%S", time());
//            $comment->user_id = $user_id;
//            $comment->body = $body;
//             $comment->comment_id = $this->_mysql->insert_id;
//
//            return $comment;
//        } else {
//            return false;
//        }
//    }

    public function insertComment(){
        $data = array(  'news_id'   => $this->news_id,
                        'created'   => $this->created,
                        'user_id'    =>  $this->user_id,
                        'body'      => $this->body
        );
        return $this->insert('comment', $data);
    }
//Strict standards: Non-static method Model::where() should not be called statically
//Перенесена в model_user.php
//  DUPLICATE IN MODEL_COMMENTS
    public function countUserComments($id)
    {
        $res = $this->query('SELECT COUNT(*) AS cnt FROM comment WHERE user_id = ' . $id);
        return $res[0]['cnt'];
    }
    public function getUserComments($id)
    {
        $this->where('user_id', $id);
        return $this->get('comment');
    }
    public function getNewsComments($news_id)
    {
        //        var_dump($news_id); die;
        $sql = 'SELECT c.user_id, c.body, c.created,
                u.first_name, u.last_name, u.profile_thumb
                FROM comment as c
                INNER JOIN user as u ON c.user_id = u.user_id
                WHERE c.news_id=' . $news_id;
        //Вытащить с пользователем?
        //не могу два раза использовать where!
//        $sql = 'SELECT * FROM comment WHERE news_id=' . $news_id;
        return $this->query($sql);
    }

}