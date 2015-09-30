<?php
//echo '$_SESSION ';
//print_r($_SESSION);echo '<br/>';
//echo '$_GET[url] ';
//print_r($_GET['url']); echo '<br/>';
//echo '$_POST ';
//print_r($_POST);
echo href('name');die;
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
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
    <!--    SUMMERNOTE CSS-->
    <link href="<?php echo URL; ?>/public/inspinia/css/plugins/summernote/summernote.css" rel="stylesheet">
    <link href="<?php echo URL; ?>/public/inspinia/css/plugins/summernote/summernote-bs3.css" rel="stylesheet">


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
    <link href="<?php echo URL; ?>carousel.css" rel="stylesheet">


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
                        <li class="<?php echo $_GET['url'] == 'index' ? 'active' : null; ?>"><a
                                href="<?php echo URL; ?>">Home</a></li>
                        <li class="<?php echo $_GET['url'] == 'news' ? 'active' : null; ?>"><a
                                href="<?php echo URL; ?>news">News</a>
                        </li>
                        <li class="<?php echo $_GET['url'] == 'tweets' ? 'active' : null; ?>"><a
                                href="<?php echo URL; ?>tweets">Tweets</a></li>
                        <li class="<?php echo $_GET['url'] == 'rules' ? 'active' : null; ?>"><a
                                href="<?php echo URL; ?>rules">Ground Rules</a></li>
                        <li class="<?php echo $_GET['url'] == 'contacts' ? 'active' : null; ?>"><a
                                href="<?php echo URL; ?>contacts">Contacts</a></li>
                        <li class="<?php echo $_GET['url'] == 'login' ? 'active' : null; ?>"><a
                                href="<?php echo URL; ?>login">Login</a></li>
                    </ul>
                    <?php if (Session::get('loggedIn') == TRUE) : ?>

                        <div class="nav navbar-right">
                            <ul class="nav navbar-nav">
                                <?php if (Session::get('role') == 'admin' || Session::get('role') == 'owner') : ?>
                                    <li><a href="<?php echo URL; ?>user">User</a></li>
                                <?php endif; ?>
                                <li><a href="<?php echo URL; ?>login/logout" class="btn btn-danger logout navbar-btn">Logout</a>
                                </li>
                            </ul>
                            <span
                                class="session"><?php echo isset($this->user) ? "You're logged in as " . $this->user->get('login') . ', your role is ' . $this->user->get('role') : 'no session login'; ?></span>

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

<div class="container marketing">
    <?php
    include VIEWS . $content_view;
    // include 'app/views/' . $controller_name .'_'. $action_name.'.php';
    ?>

    <!-- START THE FEATURETTES -->


    <hr class="featurette-divider">

    <div class="row featurette">
        <div class="col-md-5">
            <img class="featurette-image img-responsive" data-src="holder.js/500x500/auto"
                 alt="Generic placeholder image">
        </div>
        <div class="col-md-7">
            <h2 class="featurette-heading">Oh yeah, it's that good. <span class="text-muted">See for yourself.</span>
            </h2>

            <p class="lead">Donec ullamcorper nulla non metus auctor fringilla. Vestibulum id ligula porta felis euismod
                semper. Praesent commodo cursus magna, vel scelerisque nisl consectetur. Fusce dapibus, tellus ac cursus
                commodo.</p>
        </div>
    </div>

    <hr class="featurette-divider">

    <div class="row featurette">
        <div class="col-md-7">
            <h2 class="featurette-heading">And lastly, this one. <span class="text-muted">Checkmate.</span></h2>

            <p class="lead">Donec ullamcorper nulla non metus auctor fringilla. Vestibulum id ligula porta felis euismod
                semper. Praesent commodo cursus magna, vel scelerisque nisl consectetur. Fusce dapibus, tellus ac cursus
                commodo.</p>
        </div>
        <div class="col-md-5">
            <img class="featurette-image img-responsive" data-src="holder.js/500x500/auto"
                 alt="Generic placeholder image">
        </div>
    </div>

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
<!--SUMMERNOTE JS-->
<script src="<?php echo URL; ?>public/inspinia/js/plugins/summernote/summernote.min.js"></script>
<!-- IE10 viewport hack for Surface/desktop Windows 8 bug -->
<script src="<?php echo URL; ?>public/js/ie10-viewport-bug-workaround.js"></script>
<script src="<?php echo URL; ?>public/js/custom.js"></script>
</body>
</html>
