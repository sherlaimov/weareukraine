
<?php
var_dump($data);

foreach($data['news'] as $news) {

    echo '<h1>' . $news['title'] . '</h1>';
    echo '<p>By ' . $news['first_name'] . ' ' . $news['last_name'] . '</p>';
    echo '<p><span class="glyphicon glyphicon-time"></span> Posted on ' . $news['created'] . '</p>';
    echo '<img src="'. URL . 'public/images/' . $news['image_name'] . '"><hr/>';
    echo '<p>' . $news['body'] . '</p>';

}


?>
<div class="detailBox">
    <div class="titleBox">
        <label>Comment Box</label>
        <button type="button" class="close" aria-hidden="true">&times;</button>
    </div>
    <div class="commentBox">

        <p class="taskDescription">Lorem Ipsum is simply dummy text of the printing and typesetting industry.</p>
    </div>
    <div class="actionBox">
        <ul class="commentList">

            <li>
                <div class="commenterImage">
                    <img src="http://lorempixel.com/50/50/people/9" />
                </div>
                <div class="commentText">
                    <p class="">Hello this is a test comment.</p> <span class="date sub-text">on March 5th, 2014</span>

                </div>
            </li>
        </ul>
        <form class="form-inline" method="post" role="form" action="<?php echo URL; ?>news/addComment/<?php echo $data['news'][0]['id']; ?>">
            <div class="form-group">
                <input name = "body" class="form-control" type="text" placeholder="Your comments" />
            </div>
            <div class="form-group">
                <button class="btn btn-default">Add</button>
            </div>
        </form>
    </div>
</div>

