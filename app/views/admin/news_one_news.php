
<?php
//print_r($data);
foreach($data['news'] as $news) {

    echo '<h1>' . $news['title'] . '</h1>';
    echo '<p>' . $news['body'] . '</p>';
    echo '<img src="'. URL . 'public/images/' . $news['image_name'] . '">';
}

?>

</p>

