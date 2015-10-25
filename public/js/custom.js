$(document).ready(function () {
    $('nav ul li').click(function () { //debugger;
        //remove all current classes
        $('.active').removeClass('active');
        $(this).addClass('active');
    });

    $('button.day').click(function () {
        $('body').removeClass('night');
        $('body').addClass('day');
    });

    $('button.night').click(function () {
        //var cls= $(this).data('class');
        //console_log(cls);
        $('body').removeClass('day');
        $('body').addClass('night');
    });
});




(function () {
    $('button.night').click(function () {
        var cls= $(this).data('class');
        console_log(cls);
        $('body').removeClass('day');
        $('body').addClass('night');
    })

})();

function addNewComment() {

    var params = $('#add-comment-form').serialize();


     //   $.ajaxSetup({ "async" : false });

        $.post( basePath + 'news/addCommentAjax/',
            params,
            function (data, status) {
                if (data.status == 'ok') {
                    $("#body").val('');
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

function editComment(commentId) {

}
//
//$(document).ready(function () {
//   $('#mainMessage').fadeOut(7000);
//});