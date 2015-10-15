<h1>News</h1>
<p>
    This is our brand-new epic news section;
</p>
<button class="btn btn-default day" data-class="day">Day</button>
<button class="btn btn-default night" data-class="night">Night</button>

<?php

//var_dump($this->user);
//var_dump($this->data);

$pagination = $data['pagination'];
//var_dump($pagination);

//var_dump(Session::isAuthorized());

?>


<?php

foreach ($data['news'] as $news) {
    echo '<div class="row"><div class="col-md-12">';
    echo '<h1>' . '<a href="' . href('news/one_news', array('article_id' => $news['id'])) . '">' . $news['title'] . '</a>' . '</h1>';
    echo '<p>By ' .  '<a href="/profile/user?user_id=' . $news['user_id'] . '">' .  $news['first_name'] . ' ' . $news['last_name'] . '</a></p>';
    echo '<p><span class="glyphicon glyphicon-time"></span> Posted on ' . $news['created'] . '</p></div><hr>';
    echo '<div class="col-md-4"><img src="' . WS_IMAGES . 'thumb/' . $news['thumb'] . '" class="news-image"></div>';
    echo '<div class="col-md-8"><p>' . $news['body'] . '</p></div>';
    echo '</div><hr>';


}

?>

<nav>
    <ul class="pagination">
        <li>
            <?php
            if ($pagination->totalPages() > 1) {
                if ($pagination->hasPrevPage()) {
                    echo '<a href="news?page=' .
                        $pagination->prevPage() .
                        '" aria-label="Previous"><span aria-hidden="true">&laquo;</span></a>';
                }
            }
            ?>
        </li>
        <?php
        for ($i = 1; $pagination->totalPages() >= $i; $i++) {
            if ($i == $pagination->current_page) {
                echo '<li class="active"><a href="news?page=' . $i . '">' . "$i</a></li>";
            } else {
                echo '<li><a href="news?page=' . $i . '">' . "$i</a></li>";
            }
        }
        ?>
        <li>
            <?php
            if ($pagination->totalPages() > 1) {
                if ($pagination->hasNextPage()) {
                    echo '<a href="news?page=' . $pagination->nextPage() . '" aria-label="Next"><span aria-hidden="true">&raquo;</span></a>';
                }
            }
            ?>
        </li>
    </ul>
</nav>

