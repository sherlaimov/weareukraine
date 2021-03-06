<?php //die(__FILE__); ?>
<h1>News Admin</h1>
<p>
    This is our brand-new epic news section;
</p>
<button class="btn btn-default day" data-class="day">Day</button>
<button class="btn btn-default night" data-class="night">Night</button>

<?php

//var_dump($this->user);
//var_dump($data);

$pagination = $data['pagination'];
//var_dump($pagination);

//var_dump(Session::isAuthorized());
echo Session::isLoggedIn() ? '<p><a href="'. URL . 'admin/news/add" class="btn btn-success pull-right">Add News</a></p>' : null;


?>

<?php

foreach($data['news'] as $news) {

        echo '<h1>' . '<a href="news/one_news?article_id=' . $news['id'] . '">' . $news['title'] . '</a>' . '</h1>';
        echo '<p>By ' . $news['first_name'] . ' ' . $news['last_name'] . '</p>';
        echo '<span class="post-date">' . $news['created'] . '</span>';
        echo '<p>' . $news['body'] . '</p>';
        echo '<img src="'. WS_IMAGES . 'thumb/' . $news['thumb'] . '" class="news-image">';

        if(Session::get('loggedIn') && $this->user->get('role') == 'owner' || $this->user->get('role') == 'admin') {
            echo '<p><a href="'. URL . 'admin/news/delete/' . $news['id'] .'" class="btn btn-danger pull-right">Delete</a></p>';
            echo '<p><a href="'. URL . 'admin/news/add/' . $news['id'] .'" class="btn btn-warning">Edit</a></p>';
        }


}

?>

    <ul class="pagination">
        <li>
            <?php
            if($pagination->totalPages() > 1){
                if($pagination->hasPrevPage()){
                    echo '<a href="news?page=' .
                        $pagination->prevPage() .
                        '" aria-label="Previous"><span aria-hidden="true">&laquo;</span></a>';
                }
            }
            ?>
        </li>
<?php
        for($i = 1; $pagination->totalPages() >= $i; $i++){
            if ($i == $pagination->current_page) {
                echo '<li class="active"><a href="news?page=' . $i . '">' . "$i</a></li>";
            } else {
                echo '<li><a href="news?page=' . $i . '">' . "$i</a></li>";
            }
        }
        ?>
        <li>
            <?php
            if($pagination->totalPages() > 1){
                if($pagination->hasNextPage()){
                    echo '<a href="news?page=' . $pagination->nextPage() . '" aria-label="Next"><span aria-hidden="true">&raquo;</span></a>';
                }
            }
            ?>
        </li>
    </ul>


