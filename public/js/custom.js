

function addNewComment() {

    var params = $('#add-comment-form').serialize();


     //   $.ajaxSetup({ "async" : false });

        $.post( basePath + 'news/addCommentAjax/',
            params,
            function (data, status) {
                if (data.status == 'ok') {
                    $("input#body").val('');
                    loadCommentList( $("#news_id").val() );
                }
            },
            'json');

     //   $.ajaxSetup({ "async" : true });

}

function loadCommentList(newsId) {
    $( ".commentList").html('');
    $( ".commentList" ).load( basePath + 'news/loadCommentListAjax/?newsId='+ newsId);
}

$('.edit-comment').on('click', editComment);

function editComment() {
    $this = $(this);
    $this.hide();
    var commentBox = $this.parent('.commentBox');
    var update = commentBox.find('.update-comment');
    var commentId = update.data('id');
    var cancel = commentBox.find('.cancel-update-comment');
    var commentEditBtns = commentBox.find('.comment-edit-buttons-wrapper').show();
    var contentInput = commentBox.find('.comment-text').attr('contenteditable', true).focus();
    var commentTextDiv = contentInput.text();
    console.log(commentBox);
    console.log(commentId);
    //console.dir($(this));

    //commentBox.find('a[onclick]').hide();

    cancel.on('click', function(e){
        contentInput.attr('contenteditable', false);
        commentEditBtns.hide();
        //commentBox.find('a[onclick]').show();
        commentBox.find('.edit-comment').show();
    });

    update.on('click', function(){
        if ( commentTextDiv === contentInput.text()) {
            contentInput.attr('contenteditable', false);
            commentEditBtns.hide();
            commentBox.find('.edit-comment').show();
            return;
        } else {
            var newComment = {
                newComment : contentInput.text(),
                newsId :     $("#news_id").val()
            }

            //console.log(newComment);
            updateComment(newComment, commentId, commentBox);

        }
    });

}

function updateComment(newComment, commentId, commentBox) {

    $.post( basePath + 'news/updateComment/' + commentId,
        newComment,
        function (data, status) {
            console.log(data);

            if (data.status == 'ok') {
                var targetComment = $('#comment-id-' + commentId);
                targetComment.html(newComment.newComment);
                console.log(this);
                commentBox.find('.comment-edit-buttons-wrapper').hide();
                commentBox.find('.edit-comment').show();
                commentBox.find('.comment-text').attr('contenteditable', false);
            }
        }, 'json').fail(function() {
            alert('Error occurred');
        });
}

function loadOneComment(commentId) {
    var targetComment = $('#comment-id-' + commentId);
    targetComment.html('');

    //targetComment.load( basePath + 'news/loadCommentListAjax/?newsId='+ newsId);
}