
<?php
//print_r($data);
foreach($data['news'] as $news) {

    echo '<h1>' . '<a href="/news/one_news?article_id=' . $news['id'] . '">' . $news['title'] . '</a>' . '</h1>';
    echo '<p>' . $news['body'] . '</p>';
    echo '<img src="'. URL . 'public/images/' . $news['image_name'] . '">';
}

?>

</p>

