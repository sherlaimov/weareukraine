<?php
    require_once('libs/htmlelements.php');

$news = array_shift($data['news']);

?>
<form class="form-horizontal" method="post" action="<?php echo URL;?>news/edit/<?php echo $news['id'];?>">
    <div class="form-group">
        <label for="title" class="col-sm-2 control-label">Title</label>
        <div class="col-sm-10">
            <?php


                echo html_input_title('title', $news['title']);

            ?>

        </div>
    </div>
    <div class="form-group">
        <label for="body" class="col-sm-2 control-label">Body</label>
        <div class="col-sm-10">

        <?php

            echo html_textarea('body', $news['body']);


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
            <button type="submit" name="submit" class="btn btn-default delete">Post News</button>
        </div>
    </div>

</form>
