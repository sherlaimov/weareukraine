
<?php
//print_r($data);
foreach($data['news'] as $news) {

    echo '<h1>' . $news['title'] . '</h1>';
    echo '<p>By ' . $news['first_name'] . ' ' . $news['last_name'] . '</p>';
    echo '<p><span class="glyphicon glyphicon-time"></span> Posted on ' . $news['created'] . '</p>';
    echo '<img src="'. URL . 'public/images/' . $news['image_name'] . '"><hr/>';
    echo '<p>' . $news['body'] . '</p>';

}

//echo '<div class="row"><div class="col-md-12">';
//echo '<h1>' . '<a href="/news/one_news?article_id=' . $news['id'] . '">' . $news['title'] . '</a>' . '</h1>';
//echo '<p>By ' . $news['first_name'] . ' ' . $news['last_name'] . '</p>';
//echo '<p><span class="glyphicon glyphicon-time"></span> Posted on ' . $news['created'] . '</p></div><hr>';
//echo '<div class="col-md-4"><img src="' . WS_IMAGES . 'thumb/' . $news['thumb'] . '" class="news-image"></div>';
//echo '<div class="col-md-8"><p>' . $news['body'] . '</p></div>';
//echo '</div><hr>';
?>


