<?php
echo '$_SESSION ';
print_r($_SESSION);echo '<br/>';
echo '$_GET[url] ';
print_r($_GET['url']); echo '<br/>';
echo '$_POST ';
print_r($_POST);
$login = isset($_SESSION['user']) ? $_SESSION['user'] : null;
//echo $_SERVER['HTTP_REFERER'];
echo isset($_POST['action']) ? 'post action ' . $_POST['action'] : null . '<br/>';


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
        <link href="<?php echo URL; ?>css/bootstrap.min.css" rel="stylesheet">
        <link rel="stylesheet" href="<?php echo URL; ?>css/style.css">
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>


        <!-- Just for debugging purposes. Don't actually copy these 2 lines! -->
        <!--[if lt IE 9]>
        <script src="<?php echo URL; ?>assets/js/ie8-responsive-file-warning.js"></script>
        <![endif]-->
        <script src="<?php echo URL; ?>js/ie-emulation-modes-warning.js"></script>
        <script src="<?php echo URL; ?>js/custom.js"></script>

        <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
        <!--[if lt IE 9]>
          <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
          <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
        <![endif]-->

        <!-- Custom styles for this template -->
        <link href="<?php echo URL; ?>carousel.css" rel="stylesheet">

        <script type="text/javascript">
            $(document).ready(function () {
                $('nav ul li').click(function () { //debugger;

                    //remove all current classes
                    $('.active').removeClass('active');
                    $(this).addClass('active');
                });
            });

            (function () {
                $('.day').click(function () {
                    console.log(this);
                });

            })();

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
                            <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
                                <span class="sr-only">Toggle navigation</span>
                                <span class="icon-bar"></span>
                                <span class="icon-bar"></span>
                                <span class="icon-bar"></span>
                            </button>
                            <a class="navbar-brand" href="/">@WeAreUkraine</a>
                        </div>
                        <div id="navbar" class="navbar-collapse collapse">
                            <ul class="nav navbar-nav">
                                <li class="<?php echo $_GET['url'] == 'index' ? 'active' : null; ?>"><a href="/">Home</a></li>
                                <li class="<?php echo $_GET['url'] == 'news' ? 'active' : null; ?>"><a href="/news">News</a></li>
                                <li><a href="/rules">Ground Rules</a></li>
                                <li><a href="/contacts">Contacts</a></li>
                                <li><a href="/login">Login</a></li>
                            </ul>
                            <?php if (Session::get('loggedIn') == TRUE) : ?>

                                <div class="nav navbar-right">
                                    <ul class="nav navbar-nav">
                            <?php if (Session::get('role') == 'admin' || Session::get('role') == 'owner') : ?>
                                        <li><a href="/user">User</a></li>
                                    <?php endif;?>
                                        <li><a href="/login/logout" class="btn btn-danger logout navbar-btn">Logout</a></li>
                                    </ul>
                                    <span class="session"><?php echo isset($_SESSION['user']) ? "you're logged in as " . $_SESSION['user'] . ', your role is ' . $_SESSION['role']: 'no session login'; ?></span>

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
                        <div class="<?php
                        if(isset($_SESSION['message']) && is_array($_SESSION['message']) && count($_SESSION['message']))
                        {
                            foreach($_SESSION['message'] as $text => $type){
                            echo $type['type'];
                        }

                        } ?>">

                            <?php
                            if(isset($_SESSION['message']) && is_array($_SESSION['message']) && count($_SESSION['message']))
                            {
                                foreach($_SESSION['message'] as $text => $type){
                                    echo $type['text'];
                                    //$_SESSION['message'] = null;
                                    unset($_SESSION['message']);
                                    //Message::removeMessage();

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
                    <img class="featurette-image img-responsive" data-src="holder.js/500x500/auto" alt="Generic placeholder image">
                </div>
                <div class="col-md-7">
                    <h2 class="featurette-heading">Oh yeah, it's that good. <span class="text-muted">See for yourself.</span></h2>
                    <p class="lead">Donec ullamcorper nulla non metus auctor fringilla. Vestibulum id ligula porta felis euismod semper. Praesent commodo cursus magna, vel scelerisque nisl consectetur. Fusce dapibus, tellus ac cursus commodo.</p>
                </div>
            </div>

            <hr class="featurette-divider">

            <div class="row featurette">
                <div class="col-md-7">
                    <h2 class="featurette-heading">And lastly, this one. <span class="text-muted">Checkmate.</span></h2>
                    <p class="lead">Donec ullamcorper nulla non metus auctor fringilla. Vestibulum id ligula porta felis euismod semper. Praesent commodo cursus magna, vel scelerisque nisl consectetur. Fusce dapibus, tellus ac cursus commodo.</p>
                </div>
                <div class="col-md-5">
                    <img class="featurette-image img-responsive" data-src="holder.js/500x500/auto" alt="Generic placeholder image">
                </div>
            </div>

            <hr class="featurette-divider">

            <!-- /END THE FEATURETTES -->


            <!-- FOOTER -->
            <footer>
                <p class="pull-right"><a href="#">Back to top</a></p>
                <p>&copy; 2014 Company, Inc. &middot; <a href="#">Privacy</a> &middot; <a href="#">Terms</a></p>
            </footer>

        </div><!-- /.container -->


        <!-- Bootstrap core JavaScript
        ================================================== -->
        <!-- Placed at the end of the document so the pages load faster -->
        <script src="<?php echo URL; ?>js/bootstrap.min.js"></script>
        <script src="<?php echo URL; ?>js/docs.min.js"></script>
        <!-- IE10 viewport hack for Surface/desktop Windows 8 bug -->
        <script src="<?php echo URL; ?>js/ie10-viewport-bug-workaround.js"></script>
    </body>
</html>
