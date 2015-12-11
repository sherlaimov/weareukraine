

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

function editComment(commentId) {
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
            var params = contentInput.text();
            console.log(params);
        }


    });

    console.log(commentId);
    //updateComment.on('click', function(commentId){
    //    var params =  commentBox.find('p').text();
    //    console.log(params);
    //});

    //deleteA.replaceWith(saveBtn);
    //console.log(saveBtn);
    //console.log(params);
    //console.log(deleteA);
}

function cancelEditComment() {

}
//
//$(document).ready(function () {
//   $('#mainMessage').fadeOut(7000);
//});