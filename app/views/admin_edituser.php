<?php
//print_r($this->user);
$user = array_shift($this->user);
//var_dump($user); die;
?>
<h1>Edit <?php echo $user['login']; ?> </h1>


<form action="<?php echo URL;?>user/editSave/<?php echo $user['user_id'];?>" method="post" class="form-inline">
    <div class="form-group col-md-offset-1">
        <label for="login" class="control-label">Login</label>
        <input type="text" name="login" id="login" value="<?php echo $user['login'];?>"/>

        <label for="password" class="control-label">Password</label>
        <input type="password" name="password" id="password"/>
    </div>
    <div class="form-group ">
        <label for="role" class="control-label">Role</label>
        <select name="role">
            <option value="default" <?php if($user['role'] == 'default') echo 'selected' ;?>>Default</option>
            <option value="admin" <?php if($user['role'] == 'admin') echo 'selected' ;?>>Admin</option>
            <option value="owner" <?php if($user['role'] == 'owner') echo 'selected' ;?>>Owner</option>
        </select>
    </div>

    <div class="form-group">
        <div class="col-md-offset-2 col-sm-10">
            <button type="submit" class="btn btn-default">Edit</button>
        </div>
    </div>
</form>