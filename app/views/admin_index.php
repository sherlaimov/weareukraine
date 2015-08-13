<?php

//var_dump($this->allNews);
$pagination = $data['pagination'];


//var_dump(Session::isAuthorized());
echo Session::isAuthorized() ? '<p><a href="'. URL . 'news/add" class="btn btn-success pull-right">Add News</a></p>' : null;


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
                    echo '<a href="news?page=' .
                        $pagination->prevPage() .
                        '" aria-label="Previous"><span aria-hidden="true">&laquo;</span></a>';
                }
            }
            ?>
        </li>
        <?php
        for($i = 1; $pagination->totalPages() >= $i; $i++){
            if ($i == $page) {
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
</nav>