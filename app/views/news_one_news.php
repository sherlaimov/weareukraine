<?php
var_dump($data);
//$userData = $this->user->getData();
foreach ($data['news'] as $news) {

    echo '<h1>' . $news['title'] . '</h1>';
    echo '<p>By ' . $news['first_name'] . ' ' . $news['last_name'] . '</p>';
    echo '<p><span class="glyphicon glyphicon-time"></span> Posted on ' . $news['created'] . '</p>';
    echo '<img src="' . URL . 'public/images/' . $news['image_name'] . '"><hr/>';
    echo '<p>' . $news['body'] . '</p>';

}


?>

<div class="detailBox">
    <div class="titleBox">
        <label>Comment Box</label>
        <button type="button" class="close" aria-hidden="true">&times;</button>
    </div>
    <div class="commentBox">

        <p class="taskDescription">You've got something to say about the above? Please, leave your comment below</p>
    </div>
    <div class="actionBox">
        <ul class="commentList">

            <?php

            foreach ($data['comment'] as $comment) {

                $output = '<li>
                <div class="commenterImage">';
                $output .= isset($comment['profile_thumb']) ? profileImageThumb($comment['profile_thumb']) :
                    '<img alt="User Pic" src="http://lorempixel.com/50/50/people/9"
                            class="img-circle img-responsive">';
                $output .= '</div><div class="commentBox">';
//                $output .= '<a href="/profile/user?user_id=' . $userData['user_id'] . '">' .  $userData['first_name'] . ' ' . $userData['last_name'] . '</a>';
                $output .= '<a href="' . href('profile/user', array('user_id' => $comment['user_id'])) . '">' .
                    $comment['first_name'] . ' ' . $comment['last_name'] . '</a>';
                $output .= '<div class="comment-text" contenteditable="false" id="comment-id-' . $comment['comment_id'] . '"><p>' . $comment['body'] . '</p></div>';
                $output .= '<div class="comment-edit-buttons-wrapper" style="display: none;">
                <button type="button" class="btn btn-xs btn-outline btn-default cancel-update-comment">Cancel</button>
                <button type="button" class="btn btn-xs btn-outline btn-primary update-comment" data-id="'. $comment['comment_id'] . '">Save</button>
                            </div>';
                $output .= '<a class="edit-comment" data-comment-id="'. $comment['comment_id'] .  '"  href="javascript:void(0)">Edit</a>';
                $output .= '<span class="date sub-text">' . $comment['created'];
                $output .= '</span></div></li>';
                echo $output;

            } ?>

            <li>
                <div class="commenterImage">
                    <img src="http://lorempixel.com/50/50/people/9"/>

                </div>
                <div class="commentText">

                    <p class="">Hello this is a test comment.</p> <span
                        class="date sub-text">on March 5th, 2014</span>

                </div>
            </li>
        </ul>
        <form class="form-inline" method="post" role="form" id="add-comment-form"
              action="<?php echo URL; ?>news/addComment/<?php echo $data['news'][0]['id']; ?>">
            <input type="hidden" name="news_id" id="news_id" value="<?php echo $data['news'][0]['id']; ?>">

            <div class="form-group">
                <?php
                echo html_input('body', '', array('class' => 'form-control', 'type' => 'text', 'placeholder' => 'Your comments'));
                ?>
            </div>
            <div class="form-group">
                <button id="add-comment" type="button" class="btn btn-default">Add</button>
            </div>
        </form>

    </div>
</div>

<script src="<?php echo WS_PUBLIC . 'js/'; ?>simple-commonjs.js"></script>
<script>
    window.onload = function() {
        var $ = runScriptSync('https://code.jquery.com/jquery-2.1.4.min.js');        
        var CommentsController = runScriptSync(basePath + 'public/js/comments-controller.js');
        var controller = new CommentsController($, basePath);
        
        /* добавление обработчиков событий ****************************************************/
        
        $('.edit-comment').on('click', function (e) {
            var commentBox = $(this).hide().parent('.commentBox');
                          commentBox.find('.comment-text')
                          .attr('contenteditable', true)
                          .focus();
            commentBox.find('.comment-edit-buttons-wrapper').show();
//            $(this).parent(console.log(this));
//            console.log(controller);
        });
        
        $('#add-comment').on('click', function (e) {
            var form = $(this).parent().parent('form');
//            console.log(form);
            controller.addNewComment(form)
                      .done(function (data, status) {
                    console.log('I AM DONE');
                          if (data.status == 'ok') {
                              $("input#body").val('');
                              controller.loadCommentList($("#news_id").val());
                          } else {
                              console.log(data.status);

                          }
                      });
        });
        
        $('.cancel-update-comment').on('click', function (e) {
            var commentBox = $(this).parent().parent('.commentBox');
            console.log(commentBox);
            commentBox.find('.comment-text').attr('contenteditable', false);
            commentBox.find('.comment-edit-buttons-wrapper').hide();
            commentBox.find('.edit-comment').show();
        });
        
        $('.update-comment').on('click', function (e) {
            var commentBox = $(this).parent().parent('.commentBox');
            var contentInput = commentBox.find('.comment-text');
            var originalComment = contentInput.text();
            if (originalComment === contentInput.text()) {
                contentInput.attr('contenteditable', false);
                commentBox.find('.comment-edit-buttons-wrapper').hide();
                commentBox.find('.edit-comment').show();

            } else {
                var newComment = {
                    newComment: contentInput.text(),
                    newsId: $("#news_id").val()
                };
                console.log(controller);
                controller.updateComment(newComment, commentId)
                          .done(function (data, status) {
                        console.log('DONE');
                            if (data.status == 'ok') {
                                $('#comment-id-' + commentId).html(newComment.newComment);
                                commentBox.find('.comment-edit-buttons-wrapper').hide();
                                commentBox.find('.edit-comment').show();
                                commentBox.find('.comment-text').attr('contenteditable', false);
                            }
                          })
                          .fail(function (error) {
                            alert('Error occurred: ' + error);
                          });
            }
        });
    };
</script>
<script>
    /* это минимум кода необходимый для синхронной подгрузки скрипта, 
       выполнения его и записи в module.exports публичного содержимого скрипта */
    function runScriptSync(scriptUrl) {
        var request = new XMLHttpRequest(),
            async = false,
            module = { exports: {} };
            
        request.open('GET', scriptUrl, async);
        request.send(null);

        if(request.readyState == 4 && request.status === 200) {
            var script = "(function(module, exports) { " + request.responseText + " })(module, module.exports)";
            eval(script);
            return module.exports;
        }
    };
</script>


