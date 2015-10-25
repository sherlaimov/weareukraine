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
            <ul class="commentList" >

                <?php

                foreach ($data['comment'] as $comment) {

                    $output = '<li>
                <div class="commenterImage" id="comment-'.$comment['comment_id'] .'" >';
                    $output .= isset($comment['profile_thumb']) ? profileImageThumb($comment['profile_thumb']) :
                        '<img alt="User Pic" src="http://lorempixel.com/50/50/people/9"
                            class="img-circle img-responsive">';
                    $output .= '</div><div class="commentText">';
//                $output .= '<a href="/profile/user?user_id=' . $userData['user_id'] . '">' .  $userData['first_name'] . ' ' . $userData['last_name'] . '</a>';
                    $output .= '<a href="' . href('profile/user', array('user_id' => $comment['user_id'])) . '">' .
                        $comment['first_name'] . ' ' . $comment['last_name'] . '</a>';
                    $output .= '<p class="">' . $comment['body'] . '</p>';
                    $output .= '<a onclick="editComment('.$comment['comment_id'].')" href="javascript:void(0)">Edit</a>';
                    $output .= '<span class="date sub-text">'.$comment['created'];
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
                        echo html_input('body', $data['body'], array('class' => 'form-control', 'type' => 'text', 'placeholder' => 'Your comments'));
                    ?>
                </div>

            </form>
            <div class="form-group">
                <button onClick="addNewComment();" class="btn btn-default">Add</button>
            </div>
        </div>
    </div>


