<h1>Новости</h1>
<p>
Ты хотел новостей, их есть у меня.
<br />

<?php

foreach($data as $news) {

    echo '<h1>' . '<a href="/news/one_news?article_id=' . $news['id'] . '">' . $news['title'] . '</a>' . '</h1>';
    echo '<p>' . $news['body'] . '</p>';
    echo '<img src="'. URL . 'images/' . $news['image_name'] . '">';
}

?>

</p>

