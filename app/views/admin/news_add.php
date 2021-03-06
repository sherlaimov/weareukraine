<?php


//var_dump($data);
$news = isset($data['news']) ? array_shift($data['news']) : null;
//print_r($news);

?>
    <div class="row">
        <div class="col-md-9 col-md-offset-1">
            <h1>Add your publication</h1>
        </div>
        <div class="col-md-3">

        </div>

    </div>
    <form class="form-horizontal"
          action="<?php echo URL; ?>admin/news/add/<?php echo isset($news['id']) ? $news['id'] : null; ?>" method="POST"
          enctype="multipart/form-data">
        <div class="form-group">
            <input type="hidden" name="MAX_FILE_SIZE" value="51200"/>
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

                <?= html_textarea('body', $news['body']); ?>
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
                <?php echo isset($news['thumb']) ? image_thumb($news['thumb']) : null; ?>
            </div>
        </div>
        <div class="form-group">
            <div class="col-sm-offset-2 col-md-2">
                <select class="form-control" name="width">
                    <option value="100">100 X 100</option>
                    <option value="150">150 X 150</option>
                    <option value="200">200 X 200</option>
                    <option value="300">300 X 300</option>

                </select>
            </div>
        </div>
        <div class="form-group">
            <div class="col-sm-offset-2 col-sm-10">
                <button type="submit" name="submit" class="btn btn-default delete" value="upload">Post News</button>
            </div>
        </div>

    </form>

<!--SUMMERNOTE-->
<div class="row">
    <div class="mail-box-header">
        <div class="pull-right tooltip-demo">
            <a href="mailbox.html" class="btn btn-white btn-sm" data-toggle="tooltip" data-placement="top" title="Move to draft folder"><i class="fa fa-pencil"></i> Draft</a>
            <a href="mailbox.html" class="btn btn-danger btn-sm" data-toggle="tooltip" data-placement="top" title="Discard email"><i class="fa fa-times"></i> Discard</a>
        </div>
        <h2>
            Compse mail
        </h2>
    </div>
    <div class="mail-box">


        <div class="mail-body">

            <form class="form-horizontal" method="get">
                <div class="form-group"><label class="col-sm-2 control-label">To:</label>

                    <div class="col-sm-10"><input type="text" class="form-control" value="alex.smith@corporat.com"></div>
                </div>
                <div class="form-group"><label class="col-sm-2 control-label">Subject:</label>

                    <div class="col-sm-10"><input type="text" class="form-control" value=""></div>
                </div>
            </form>

        </div>

        <div class="mail-text h-200">

            <div class="summernote">
                <h3>Hello Jonathan! </h3>
                dummy text of the printing and typesetting industry. <strong>Lorem Ipsum has been the industry's</strong> standard dummy text ever since the 1500s,
                when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic
                typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with
                <br/>
                <br/>

            </div>
            <div class="clearfix"></div>
        </div>
        <div class="mail-body text-right tooltip-demo">
            <a href="mailbox.html" class="btn btn-sm btn-primary" data-toggle="tooltip" data-placement="top" title="Send"><i class="fa fa-reply"></i> Send</a>
            <a href="mailbox.html" class="btn btn-white btn-sm" data-toggle="tooltip" data-placement="top" title="Discard email"><i class="fa fa-times"></i> Discard</a>
            <a href="mailbox.html" class="btn btn-white btn-sm" data-toggle="tooltip" data-placement="top" title="Move to draft folder"><i class="fa fa-pencil"></i> Draft</a>
        </div>
        <div class="clearfix"></div>



    </div>
</div>
<script src="<?php echo URL; ?>public/inspinia/js/jquery-2.1.1.js"></script>





<!-- iCheck -->
<script src="<?php echo URL; ?>public/inspinia/js/plugins/iCheck/icheck.min.js"></script>

<!--SUMMERNOTE JS-->
<script src="<?php echo URL; ?>public/inspinia/js/plugins/summernote/summernote.min.js"></script>
<script>
    $(document).ready(function(){
        $('.i-checks').iCheck({
            checkboxClass: 'icheckbox_square-green',
            radioClass: 'iradio_square-green'
        });


        $('.summernote').summernote();

    });
    var edit = function() {
        $('.click2edit').summernote({focus: true});
    };
    var save = function() {
        var aHTML = $('.click2edit').code(); //save HTML If you need(aHTML: array).
        $('.click2edit').destroy();
    };

</script>
