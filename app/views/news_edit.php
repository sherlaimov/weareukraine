<?php
    require_once('libs/htmlelements.php');

?>

<form class="form-horizontal" method="post" action="<?php echo URL;?>news/editSave/<?php echo $data['id'];?>">
    <div class="form-group">
        <label for="title" class="col-sm-2 control-label">Title</label>
        <div class="col-sm-10">
            <?php echo html_input('title', $data['title']) ?>

        </div>
    </div>
    <div class="form-group">
        <label for="body" class="col-sm-2 control-label">Body</label>
        <div class="col-sm-10">
        <?php echo html_textarea('body', $data['body'], 'test') ?>
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
