
(function (module) {
    var $, basePath;
    
    function CommentsController(jquery, path) {
        $ = jquery;
        basePath = path;
    }
    
    CommentsController.prototype.addNewComment = function (form) {
        return $.ajax(basePath + 'news/addCommentAjax/', {
            type: 'POST',
            data: form.serialize(),
            contentType: 'application/json'
        });
    };

    CommentsController.prototype.loadCommentList = function (newsId) {
        return $.ajax(basePath + 'news/loadCommentListAjax/?newsId=' + newsId, {
            type: 'GET',
            contentType: 'application/json'
        });
    };

    CommentsController.prototype.updateComment = function (newComment, commentId) {
        return $.ajax(basePath + 'news/updateComment/' + commentId, {
            type: 'POST',
            data: newComment,
            contentType: 'application/json'
        });
    };
    
    module.exports = CommentsController;
})(module);