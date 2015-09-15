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
//
//$(document).ready(function () {
//   $('#mainMessage').fadeOut(7000);
//});