<h1>User</h1>

<form action="<?php echo URL;?>user/create" method="post" class="form-inline">
    <div class="form-group col-md-offset-1 ">
        <label for="login" class="control-label">Login</label>
        <input type="text" name="login" id="login"/>

        <label for="password" class="control-label">Password</label>
        <input type="password" name="password" id="password"/>
    </div>
    <div class="form-group ">
        <label for="role" class="control-label">Role</label>
        <select name="role">
            <option value="default">Default</option>
            <option value="admin">Admin</option>
            <option value="owner">Owner</option>
        </select>
    </div>
    <div class="form-group">
        <div class="col-md-offset-2 col-sm-10">
            <button type="submit" class="btn btn-default">Create</button>
        </div>
    </div>
</form>

<table class="table table-hover">
    <tr>
    <?php
    $cnt = 1;
    foreach($this->userList as $key => $value){

        echo '<td>' . $cnt . '</td>';
        echo '<td>' . $value['user_id'] . '</td>';
        echo '<td>' . $value['login'] . '</td>';
        echo '<td>' . $value['role'] . '</td>';
        $cnt++;

        if(Session::get('loggedIn') && Session::get('role') !== 'default') {
            echo '<td> <a href="' . URL . 'admin/user/edit/' . $value['user_id'] . '" class="btn btn-warning">Edit</a></td>';
            echo '<td> <a href="' . URL . 'admin/user/delete/' . $value['user_id'] . '" class="btn btn-danger">Delete</a></td>';
        }

        echo '</tr>';
    }





    ?>
</table>
