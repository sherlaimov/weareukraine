<?php

class Pagination extends Model_News {
    public $current_page;
    public $per_page;
    public $total_count;

    public function __construct($page = 1, $per_page = 4, $total_count = 0) {
        parent::__construct();
        $this->current_page = (int)$page;
        $this->per_page = (int)$per_page;
        if( Session::get('user_id') && Session::isLoggedIn()){
            $this->total_count = (int)$this->countUserNews();
        } else {
            $this->total_count = (int)$this->countAll();
        }


    }

    public function offset(){
        //page 2 has an offset of 20 (2-1) * 20
        return ($this->current_page - 1) * $this->per_page;
    }

    public function totalPages(){
        return ceil($this->total_count/$this->per_page);

    }

    public function prevPage(){
        return $this->current_page - 1;
    }

    public function nextPage(){
        return $this->current_page + 1;
    }

    public function hasPrevPage(){
        return $this->prevPage() >= 1 ? true : false;
    }

    public function hasNextPage(){
        return $this->nextPage() <= $this->totalPages() ? true : false;
    }

    public function findByOffset(){
//        return $this->query("SELECT * FROM news ORDER BY id DESC LIMIT $this->per_page OFFSET {$this->offset()}");
        return $this->query('SELECT news.id, news.user_id, news.title, news.body, news.created, news.image_name, news.thumb,
                            user.first_name, user.last_name
                            FROM news, user
                            WHERE news.user_id = user.user_id ORDER BY news.id LIMIT '
         . $this->per_page . ' OFFSET ' . $this->offset());

    }

    public function findByOffsetandUser($user_id) {
        //$user_id = Session::get('user_id');
        if ((int) $user_id ) {
            return $this->query("SELECT * FROM news WHERE user_id = $user_id ORDER BY id DESC LIMIT $this->per_page OFFSET {$this->offset()}");
        }
        $sql = 'SELECT news.user_id, news.title, news.body, news.created, user.first_name, user.last_name FROM news, user
        WHERE news.user_id = user.user_id ORDER BY news.id';

        $sql = 'SELECT n.user_id, n.title, n.body, n.created, u.first_name, u.last_name
        FROM news AS n
        INNER JOIN  user AS u ON n.user_id = u.user_id
        WHERE 1 ORDER BY n.id';
        return false;
    }

}

