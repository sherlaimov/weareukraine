<?php

class Pagination extends Model_News {
    public $current_page;
    public $per_page;
    public $total_count;

    public function __construct($page = 1, $per_page = 4, $total_count = 0) {
        parent::__construct();
        $this->current_page = (int)$page;
        $this->per_page = (int)$per_page;
        $this->total_count = (int)$this->countAll();

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
        return $this->query("SELECT * FROM news ORDER BY id DESC LIMIT $this->per_page OFFSET {$this->offset()}");
    }

}

