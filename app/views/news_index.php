<h1>News</h1>
<p>
    This is our brand-new epic news section;
</p>
<button class="btn btn-default day" data-class="day">Day</button>
<button class="btn btn-default night" data-class="night">Night</button>

<?php

var_dump($allNews);
$pagination = $data['pagination'];
$pagination->current_page = isset($_GET['page']) ? $_GET['page'] : 1;


if ( Session::get('loggedIn') && Session::get('role') === 'owner' || Session::get('role') === 'admin') {
    echo '<p><a href="'. URL . 'news/add" class="btn btn-success pull-right">Add News</a></p>';
}

?>



<?php
//print_r($data);
foreach($data['news'] as $news) {

    echo '<h1>' . '<a href="/news/one_news?article_id=' . $news['id'] . '">' . $news['title'] . '</a>' . '</h1>';
    echo '<span class="post-date">' . $news['date'] . '</span>';
    echo '<p>' . $news['body'] . '</p>';
    echo '<img src="'. WS_IMAGES . 'thumb/' . $news['thumb'] . '" class="news-image">';

    if(Session::get('loggedIn') && Session::get('role') == 'owner' || Session::get('role') == 'admin') {
        echo '<p><a href="'. URL . 'news/delete/' . $news['id'] .'" class="btn btn-danger pull-right">Delete</a></p>';
        echo '<p><a href="'. URL . 'news/add/' . $news['id'] .'" class="btn btn-warning">Edit</a></p>';
    }
}

?>

<nav>
    <ul class="pagination">
        <li>
            <?php
            if($pagination->totalPages() > 1){
                if($pagination->hasPrevPage()){
                    echo '<a href="news.php?page=' .
                        $pagination->prevPage() .
                        '" aria-label="Previous"><span aria-hidden="true">&laquo;</span></a>';
                }
            }
            ?>
        </li>
        <?php
        for($i = 1; $pagination->totalPages() >=$i; $i++){
            if ($i == $page) {
                echo '<li class="active"><a href="news.php?page=' . $i . '">' . "$i</a></li>";
            } else {
                echo '<li><a href="news.php?page=' . $i . '">' . "$i</a></li>";
            }

        }
        ?>
        <li>
            <?php
            if($pagination->totalPages() > 1){
                if($pagination->hasNextPage()){
                    echo '<a href="news.php?page=' . $pagination->nextPage() . '" aria-label="Next"><span aria-hidden="true">&raquo;</span></a>';
                }
            }
            ?>
        </li>
    </ul>
</nav>

