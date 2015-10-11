<?php
//$user = Session::get('userObj');

if (Session::get('loggedIn') === TRUE) : ?>
    <h2>Welcome back <?php echo $this->user->fullName(); //echo $this->user->fullName(); ?>!</h2>
<?php else : ?>

        <form class="form-signin" action="<?php echo URL; ?>login" method="post">
            <h2 class="form-signin-heading">Please sign in</h2>
            <label for="login" class="sr-only">Login</label>
            <input type="text" id="login" name="login" class="form-control" placeholder="Login" required autofocus>
            <label for="inputPassword" class="sr-only">Password</label>
            <input type="password" id="inputPassword" name="password" class="form-control" placeholder="Password"
                   required>

            <div class="checkbox">
                <label>
                    <input type="checkbox" value="remember-me"> Remember me
                </label>
            </div>
            <button class="btn btn-lg btn-primary btn-block" type="submit" name="loginForm">Sign in</button>
        </form>

        <div class="form-signin">
        <a class="btn btn-default btn-block" href="<?php echo URL; ?>register">Registration</a>
        </div>


<?php endif; ?>