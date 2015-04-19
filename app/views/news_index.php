<h1>News</h1>
<p>
    This is our brand-new epic news section;
</p>
<button class="btn btn-default day" data-class="day">Day</button>
<button class="btn btn-default night" data-class="night">Night</button>
<?php
echo '<p><a href="'. URL . 'news/add/" class="btn btn-success">Add News</a></p>';
?>

<form class="form-horizontal" method="post" action="<?php echo URL;?>news/postNews">
    <div class="form-group">
        <label for="title" class="col-sm-2 control-label">Title</label>
        <div class="col-sm-10">
            <input type="text" class="form-control"  name="title" id="title" placeholder="Title">
        </div>
    </div>
    <div class="form-group">
        <label for="body" class="col-sm-2 control-label">Body</label>
        <div class="col-sm-10">
            <textarea class="form-control" name="body" rows="3"></textarea>
        </div>
    </div>
    <div class="form-group">
        <div class="col-sm-offset-2 col-sm-10">
            <div class="checkbox">
                <label>
                    <input type="checkbox"> Remember me
                </label>
            </div>
        </div>
    </div>
    <div class="form-group">
        <div class="col-sm-offset-2 col-sm-10">
            <button type="submit" class="btn btn-default delete">Post News</button>
        </div>
    </div>
</form>



<?php

//print_r($this->data);
//print_r($data);


//echo '<h1>' . count($data) . '</h1>';
//for($row=0; $row<=count($data); $row++){
//    foreach($data[$row] as $news){
//        echo '<pre>' . print_r($news) .'</pre>';
//    }
//}

foreach($data as $news) {

    echo '<h1>' . '<a href="/news/one_news?article_id=' . $news['id'] . '">' . $news['title'] . '</a>' . '</h1>';
    echo '<p>' . $news['body'] . '</p>';
    echo '<img src="'. WS_IMAGES . 'thumb/' . $news['thumb'] . '" class="news-image">';

    if(Session::get('loggedIn') && Session::get('role') == 'owner' || Session::get('role') == 'admin') {
        echo '<p><a href="'. URL . 'news/delete/' . $news['id'] .'" class="btn btn-danger pull-right">Delete</a></p>';
        echo '<p><a href="'. URL . 'news/edit/' . $news['id'] .'" class="btn btn-warning">Edit</a></p>';
    }
}


function html_get_thumbnail($filename, $width, $height, $style = '') {
    $fileInfo = pathinfo($filename);

    return '<img src="'.WS_IMAGES .'thumb/'. $fileInfo['filename'] .'_'.$width.'_'.$height.'.jpg'.'" class="news-image">';
}


?>

