<?php

//var_dump($_SERVER['PHP_SELF']);
//var_dump($_SERVER['REQUEST_URI']);
//плюсы и минусы реализвции с помощью JS или CSS?
$url_array =  explode('/', $_SERVER['REQUEST_URI']) ;
//    var_dump($url_array); die;
//
function active($currect_page){
//    echo 'BELGO';
    $url_array =  explode('/', $_SERVER['REQUEST_URI']) ;

    $url = end($url_array);
    if($currect_page == $url){
        return 'class="active"'; //class name in css
    }
    return '';
}


?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="icon" href="../../favicon.ico">

    <title>We Are Ukraine Project</title>

    <!-- Bootstrap core CSS -->
    <link href="<?php echo URL; ?>public/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="<?php echo URL; ?>public/css/style.css">
    <!--    SUMMERNOTE CSS-->
    <link href="<?php echo URL; ?>public/inspinia/css/plugins/summernote/summernote.css" rel="stylesheet">
    <link href="<?php echo URL; ?>public/inspinia/css/plugins/summernote/summernote-bs3.css" rel="stylesheet">

    <script src="<?php echo URL; ?>public/js/jquery-1.11.3.js"></script>
    <!-- Just for debugging purposes. Don't actually copy these 2 lines! -->
    <!--[if lt IE 9]>
    <script src="<?php echo URL; ?>assets/js/ie8-responsive-file-warning.js"></script>
    <![endif]-->
    <script src="<?php echo URL; ?>public/js/ie-emulation-modes-warning.js"></script>

    <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
    <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->

    <!-- Custom styles for this template -->
    <link href="<?php echo URL; ?>public/css/carousel.css" rel="stylesheet">


    <script type="text/javascript">
        var basePath = "<?php echo URL;?>";
    </script>
</head>
<!-- NAVBAR
================================================== -->
<body class="day">
<header id="header">
    <nav class="navbar navbar-inverse navbar-static-top">
        <div class="container-fluid">

            <div class="container">
                <div class="navbar-header">
                    <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar"
                            aria-expanded="false" aria-controls="navbar">
                        <span class="sr-only">Toggle navigation</span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                    </button>
                    <a class="navbar-brand" href="/">@WeAreUkraine</a>
                </div>
                <div id="navbar" class="navbar-collapse collapse">
                    <ul class="nav navbar-nav">
                        <li <?php echo active(''); ?>><a
                                href="<?php echo URL; ?>">Home</a></li>
                        <li <?php echo active('news'); ?>><a
                                href="<?php echo URL; ?>news">News</a>
                        </li>
                        <li <?php echo active('tweets'); ?>><a
                                href="<?php echo href('tweets'); ?>">Tweets</a></li>
                        <li <?php echo active('rules'); ?>><a
                                href="<?php echo URL; ?>rules">Ground Rules</a></li>
                        <li <?php echo active('contacts'); ?>><a
                                href="<?php echo URL; ?>contacts">Contacts</a></li>
                        <li <?php echo active('login'); ?>><a
                                href="<?php echo URL; ?>login">Login</a></li>
                    </ul>
                    <?php if (Session::get('loggedIn') == TRUE) : ?>

                        <div class="nav navbar-right">

                            <ul class="nav navbar-nav">


                                <li class="dropdown">
                                    <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button"
                                       aria-haspopup="true" aria-expanded="false">
                                        <?php echo isset($this->user) ? $this->user->get('login') : null; ?>
                                        <span class="caret"></span></a>
                                    <ul class="dropdown-menu">
                                        <li><a href="<?php echo URL; ?>profile">Profile</a></li>
                                        <?php
                                        if ($this->user->get('role') == 'default') {
                                            echo '<li><a href="#">Do nothing?</a></li>';
                                        } else {
                                            echo '<li><a href="' . URL . 'admin">Admin area</a></li>';
                                        }
                                        ?>


                                        <li role="separator" class="divider"></li>
                                        <li><a href="<?php echo URL; ?>login/logout" class="">Logout</a></li>
                                    </ul>
                                </li>
                            </ul>
                        </div>
                    <?php else : ?>
                        <form class="navbar-form navbar-right" action="<?php echo URL; ?>login" method="post">
                            <div class="form-group">
                                <input type="text" name="login" placeholder="Login" class="form-control">
                            </div>
                            <div class="form-group">
                                <input class="form-control" type="password" name="password" placeholder="Password">
                            </div>
                            <button type="submit" class="btn btn-success">Sign in</button>
                        </form>
                    <?php endif; ?>
                </div>
                <?php
                //                print_r(Message::getMessages());die;
                ?>
                <div class="<?php
                if ($message = Message::getMessages(false)) {

                    if (isset($message) && is_array($message) && count($message)) {
                        foreach ($message as $text => $type) {
                            echo $type['type'];
                        }
                    }


                } ?>" id="mainMessage">

                    <?php
                    //                                        var_dump(Message::getMessages());die;
                    if ($message = Message::getMessages()) {
                        if (isset($message) && is_array($message) && count($message)) {
                            foreach ($message as $text => $type) {
                                echo $type['text'];

                            }
                        }
                    } ?>
                </div>
            </div>
        </div>
    </nav>

</header>


<!-- Marketing messaging and featurettes
================================================== -->
<!-- Wrap the rest of the page in another container to center all the content. -->

<div class="container">
    <?php
    include VIEWS . $content_view;
    // include 'app/views/' . $controller_name .'_'. $action_name.'.php';
    ?>

    <!-- START THE FEATURETTES -->


    <hr class="featurette-divider">


    <hr class="featurette-divider">

    <!-- /END THE FEATURETTES -->


    <!-- FOOTER -->
    <footer>
        <p class="pull-right"><a href="#">Back to top</a></p>

        <p>&copy; 2014 Company, Inc. &middot; <a href="#">Privacy</a> &middot; <a href="#">Terms</a></p>
    </footer>

</div>
<!-- /.container -->


<!-- Bootstrap core JavaScript
================================================== -->
<!-- Placed at the end of the document so the pages load faster -->
<script src="<?php echo URL; ?>public/js/bootstrap.min.js"></script>
<script src="<?php echo URL; ?>public/js/docs.min.js"></script>
<!--HANDLEBARS JS-->
<script src="<?php echo URL; ?>public/js/handlebars-v3.0.3.js"></script>


<!-- IE10 viewport hack for Surface/desktop Windows 8 bug -->
<script src="<?php echo URL; ?>public/js/ie10-viewport-bug-workaround.js"></script>
<script src="<?php echo URL; ?>public/js/custom.js"></script>
</body>
</html>
