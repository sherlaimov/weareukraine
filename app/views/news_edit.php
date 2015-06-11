<?php
    require_once('libs/htmlelements.php');
//print_r($_POST);

foreach ($data['news'] as $k => $v) {
    $news[$k] = $v;
}

if (isset($data['data'])){
    foreach ($data['data'] as $k => $v) {
        $post[$k] = $v;
    }
}


?>
<form class="form-horizontal" method="post" action="<?php echo URL;?>news/edit/<?php echo $news['id'];?>">
    <div class="form-group">
        <label for="title" class="col-sm-2 control-label">Title</label>
        <div class="col-sm-10">
            <?php

        if (empty($post['title'])) {
            echo html_input_title('title', $news['title']);
        } else {
            echo html_input_title('title', $post['title']);
        }

            ?>

        </div>
    </div>
    <div class="form-group">
        <label for="body" class="col-sm-2 control-label">Body</label>
        <div class="col-sm-10">

        <?php
        if (empty($post['body'])) {
            echo html_textarea('body', $news['body'], 'test');
        } else {
            echo html_input_title('title', $post['body']);
        }

        ?>
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
