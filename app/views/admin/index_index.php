<h1>Admin/index_index.php</h1>
<?php

//var_dump($this->allNews);



//var_dump(Session::isAuthorized());
echo Session::isAuthorized() ? '<p><a href="'. URL . 'news/add" class="btn btn-success pull-right">Add News</a></p>' : null;


?>

<?php
//print_r($data);
//foreach($data['news'] as $news) {
//
//    echo '<h1>' . '<a href="/news/one_news?article_id=' . $news['id'] . '">' . $news['title'] . '</a>' . '</h1>';
//    echo '<span class="post-date">' . $news['date'] . '</span>';
//    echo '<p>' . $news['body'] . '</p>';
//    echo '<img src="'. WS_IMAGES . 'thumb/' . $news['thumb'] . '" class="news-image">';
//
//    if(Session::get('loggedIn') && Session::get('role') == 'owner' || Session::get('role') == 'admin') {
//        echo '<p><a href="'. URL . 'news/delete/' . $news['id'] .'" class="btn btn-danger pull-right">Delete</a></p>';
//        echo '<p><a href="'. URL . 'news/add/' . $news['id'] .'" class="btn btn-warning">Edit</a></p>';
//    }
//}

?>

