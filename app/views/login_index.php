
<?php echo $belochka;
?>
<form class="form-signin" action="<?php echo URL;?>login" method="post">
    <h2 class="form-signin-heading">Please sign in</h2>
    <label for="login" class="sr-only">Login</label>
    <input type="text" id="login" name="login" class="form-control" placeholder="Login" required autofocus>
    <label for="inputPassword" class="sr-only">Password</label>
    <input type="password" id="inputPassword" name="password" class="form-control" placeholder="Password" required>
    <div class="checkbox">
      <label>
        <input type="checkbox" value="remember-me"> Remember me
      </label>
    </div>
    <button class="btn btn-lg btn-primary btn-block" type="submit" name="loginForm">Sign in</button>
  </form>
    <div class="alert"><?php ?></div>


