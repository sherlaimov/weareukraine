
<?php
//$user = Session::get('userObj');

    if (Session::get('loggedIn') === TRUE) : ?>
    <h2>Welcome back <?php echo $this->user->fullName(); //echo $this->user->fullName(); ?>!</h2>
<?php else : ?>
        <div class="middle-box text-center loginscreen animated fadeInDown">
            <div>
                <div>

                    <h1 class="logo-name">IN+</h1>

                </div>
                <h3>Welcome to IN+</h3>
                <p>Perfectly designed and precisely prepared admin theme with over 50 pages with extra new web app views.
                    <!--Continually expanded and constantly improved Inspinia Admin Them (IN+)-->
                </p>
                <p>Login in. To see it in action.</p>
                <form class="m-t" role="form" action="<?php echo URL;?>admin/login" method="POST">
                    <div class="form-group">
                        <input type="text" name="login" class="form-control" placeholder="Login" required="">
                    </div>
                    <div class="form-group">
                        <input type="password"  name="password" class="form-control" placeholder="Password" required="">
                    </div>
                    <button type="submit" class="btn btn-primary block full-width m-b">Login</button>

                    <a href="#"><small>Forgot password?</small></a>
                    <p class="text-muted text-center"><small>Do not have an account?</small></p>
                    <a class="btn btn-sm btn-white btn-block" href="<?php echo URL; ?>register">Create an account</a>
                </form>
                <p class="m-t"> <small>Inspinia we app framework base on Bootstrap 3 &copy; 2014</small> </p>
            </div>
        </div>

<?php endif; ?>