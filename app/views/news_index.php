<h1>News</h1>
<p>
    This is our brand-new epic news section;
</p>
<button class="btn btn-default day" data-class="day">Day</button>
<button class="btn btn-default night" data-class="night">Night</button>

<?php

var_dump($allNews);
var_dump($data['news']['totalNewsCount']);



if ( Session::get('loggedIn') && Session::get('role') === 'owner' || Session::get('role') === 'admin') {
    echo '<p><a href="'. URL . 'news/add" class="btn btn-success pull-right">Add News</a></p>';
}

?>



<?php
//print_r($data);
foreach($data['news'] as $news) {

    echo '<h1>' . '<a href="/news/one_news?article_id=' . $news['id'] . '">' . $news['title'] . '</a>' . '</h1>';
    echo '<p>' . $news['body'] . '</p>';
    echo '<img src="'. WS_IMAGES . 'thumb/' . $news['thumb'] . '" class="news-image">';

    if(Session::get('loggedIn') && Session::get('role') == 'owner' || Session::get('role') == 'admin') {
        echo '<p><a href="'. URL . 'news/delete/' . $news['id'] .'" class="btn btn-danger pull-right">Delete</a></p>';
        echo '<p><a href="'. URL . 'news/add/' . $news['id'] .'" class="btn btn-warning">Edit</a></p>';
    }
}



?>

