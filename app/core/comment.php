<?php

class Comment extends Model
{

    protected static $table_name = 'comment';
    protected static $db_fields = array('comment_id', 'news_id', 'created', 'user_id', 'body');

    public $comment_id;
    public $news_id;
    public $created;
    public $user_id;
    public $body;

    public static function make($news_id, $user_id, $body = '')
    {
         if (!empty($news_id) && !empty($user_id) && !empty ($body)) {

            $comment = new Comment();

            $comment->news_id = (int)$news_id;
            $comment->created = strftime("%Y-%m-%d %H:%M:%S", time());
            $comment->user_id = $user_id;
            $comment->body = $body;
//            var_dump($comment);
            return $comment;
        } else {
            return false;
        }
    }

    public static function getComments($news_id)
    {
        $sql = 'SELECT * FROM ' . self::$table_name;
        $sql .= ' WHERE news_id=' . $news_id;
        //$sql .= ' ORDER BY ASC';
        self::where('comment_id', $news_id);
        return self::get(self::$table_name, null, 'ORDER BY DESC');
    }

    public function insertComment(){
        $data = array(  'news_id'   => $this->news_id,
                        'created'   => $this->created,
                        'user_id'    =>  $this->user_id,
                        'body'      => $this->body
        );
        return $this->insert('comment', $data);
    }
}