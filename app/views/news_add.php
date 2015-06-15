<?php
print_r($data);
print_r($_POST);
require_once('libs/htmlelements.php')
?>

<form class="form-horizontal" action="<?php echo URL;?>news/add" method="POST" enctype="multipart/form-data">
    <div class="form-group">
        <label for="title" class="col-sm-2 control-label">Title</label>
        <div class="col-sm-10">
            <?php
            echo html_input('title', '', array(
                'class' => 'form-control',
                'type' => 'text',
                'id' => 'title',
                'placeholder' => 'Title'
            ));
            ?>

        </div>
    </div>
    <div class="form-group">
        <label for="body" class="col-sm-2 control-label">Body</label>
        <div class="col-sm-10">

            <?= html_textarea('body', ''); ?>
        </div>
    </div>
    <div class="form-group">
        <div class="col-sm-offset-2 col-sm-10">
                <label> Upload a file
                    <input type="file" name="upload" value="Choose an image">
                </label>

        </div>
    </div>
    <div class="form-group">
        <div class="col-sm-offset-2 col-sm-10">
            <img class="featurette-image img-responsive" data-src="holder.js/50x50/auto" alt="Generic placeholder image">
        </div>
    </div>
    <div class="form-group col-sm-offset-2 col-md-2 ">
    <select class="form-control" name="width">
        <option value="100">100 X 100</option>
        <option value="150">150 X 150</option>
        <option value="200">200 X 200</option>
        <option value="300">300 X 300</option>

    </select>
    </div>
    <div class="form-group">
        <div class="col-sm-offset-2 col-sm-10">
            <button type="submit" name="submit" class="btn btn-default delete" value="upload">Post News</button>
        </div>
    </div>
    
</form>




<?php
