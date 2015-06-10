<?php
    require_once('libs/htmlelements.php');
//print_r($_POST);
//echo '<br/>';
//print_r($data);
foreach ($data['news'] as $k => $v) {

    $news[$k] = $v;
}
//echo count($data['news']);
//for ( $i = 0; $i < count($data['news']); $i++ ) {
//    $n = $data['news'][$i];
//}
//print_r($n);  ЧТО ЗА ОФФСЕТЫ?

if (isset($data['data'])){
    foreach ($data['data'] as $k => $v) {

        $data[$k] = $v;
    }
    //print_r($data[$k]); Что это за цифра тут?
    //print_r($data['data']);
}


//echo empty($data['body']) ? $news['body'] : $data['body'] ;

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

            echo html_textarea('body', $news['body'], 'test');


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
