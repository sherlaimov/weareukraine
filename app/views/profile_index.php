<?php
//var_dump($this->user);
//var_dump($this->data['user']);
$data = $this->data['user'];
var_dump($this->data);
?>

<h1><?php echo $this->user->fullName() . '\'s'; ?> profile</h1>


<div class="row container">
    <!-- Nav tabs -->
    <ul class="nav nav-tabs" role="tablist">
        <li role="presentation" class="active"><a href="#home" aria-controls="home" role="tab"
                                                  data-toggle="tab">Home</a>
        </li>
        <li role="presentation"><a href="#profile" aria-controls="profile" role="tab" data-toggle="tab">Profile</a>
        </li>
        <li role="presentation"><a href="#messages" aria-controls="messages" role="tab"
                                   data-toggle="tab">Messages</a></li>
        <li role="presentation"><a href="#settings" aria-controls="settings" role="tab"
                                   data-toggle="tab">Publish news</a></li>
    </ul>
</div>


<div class="row container">
    <!-- Tab panes -->
    <div class="tab-content">
        <div role="tabpanel" class="tab-pane active" id="home">
            <div
                class="col-xs-12 col-sm-12 col-md-8 col-lg-8 col-xs-offset-0 col-sm-offset-0 col-md-offset-0 col-lg-offset-0 toppad">

                <div class="panel-body">
                    <div class="row">
                        <div class="col-md-3 col-lg-3 " align="">
                            <?php echo isset($data['profile_thumb']) ? profileImageThumb($data['profile_thumb']) :
                                '<img alt="User Pic" src="http://babyinfoforyou.com/wp-content/uploads/2014/10/avatar-300x300.png"
                            class="img-circle img-responsive">';?>
                        </div>

                        <!--<div class="col-xs-10 col-sm-10 hidden-md hidden-lg"> <br>
                          <dl>
                            <dt>DEPARTMENT:</dt>
                            <dd>Administrator</dd>
                            <dt>HIRE DATE</dt>
                            <dd>11/12/2013</dd>
                            <dt>DATE OF BIRTH</dt>
                               <dd>11/12/2013</dd>
                            <dt>GENDER</dt>
                            <dd>Male</dd>
                          </dl>
                        </div>-->
                        <div class=" col-md-9 col-lg-9 ">
                            <table class="table table-user-information">
                                <tbody>
                                <tr>
                                    <td>Department:</td>
                                    <td>Programming</td>
                                </tr>
                                <tr>
                                    <td>Hire date:</td>
                                    <td>06/23/2013</td>
                                </tr>
                                <tr>
                                    <td>Date of Birth</td>
                                    <td>01/24/1988</td>
                                </tr>

                                <tr>
                                <tr>
                                    <td>Gender</td>
                                    <td>Male</td>
                                </tr>
                                <tr>
                                    <td>Total publications</td>
                                    <td><?php echo '<span class="label label-primary">' . $data['newsCount'] . '</span>'; ?></td>
                                </tr>
                                <tr>
                                    <td>Total comments</td>
                                    <td><?php echo '<span class="label label-primary">' . $data['commentsCount'] . '</span>'; ?></td>
                                </tr>
                                <tr>
                                    <td>Email</td>
                                    <td><a href="mailto:info@support.com">info@support.com</a></td>
                                </tr>
                                <td>Role</td>
                                <td><?php echo $data['role']; ?> </td>

                                </tr>

                                </tbody>
                            </table>

                            <a href="#" class="btn btn-primary">My Sales Performance</a>
                            <a href="#" class="btn btn-primary">Team Sales Performance</a>
                        </div>
                    </div>
                </div>
                <div class="panel-footer">
                    <a data-original-title="Broadcast Message" data-toggle="tooltip" type="button"
                       class="btn btn-sm btn-primary"><i class="glyphicon glyphicon-envelope"></i></a>
                        <span class="pull-right">
                            <a href="edit.html" data-original-title="Edit this user" data-toggle="tooltip" type="button"
                               class="btn btn-sm btn-warning"><i class="glyphicon glyphicon-edit"></i></a>
                            <a data-original-title="Remove this user" data-toggle="tooltip" type="button"
                               class="btn btn-sm btn-danger"><i class="glyphicon glyphicon-remove"></i></a>
                        </span>
                </div>

            </div>

        </div>
        <div role="tabpanel" class="tab-pane" id="profile">
            <form role="form" method="post" action="<?php echo URL ?>profile/update/<?php echo $data['user_id']; ?>"
                  enctype="multipart/form-data">
                <div class="col-md-3">
                    <div class="form-group">
                        <?php
                        echo isset($data['profile_thumb']) ? profileImageThumb($data['profile_thumb']) : ' <img data-src="holder.js/140x140" class="img-circle" alt="140x140"
                         src="data:image/svg+xml;base64,PD94bWwgdmVyc2lvbj0iMS4wIiBlbmNvZGluZz0iVVRGLTgiIHN0YW5kYWxvbmU9InllcyI/PjxzdmcgeG1sbnM9Imh0dHA6Ly93d3cudzMub3JnLzIwMDAvc3ZnIiB3aWR0aD0iMTQwIiBoZWlnaHQ9IjE0MCIgdmlld0JveD0iMCAwIDE0MCAxNDAiIHByZXNlcnZlQXNwZWN0UmF0aW89Im5vbmUiPjwhLS0KU291cmNlIFVSTDogaG9sZGVyLmpzLzE0MHgxNDAKQ3JlYXRlZCB3aXRoIEhvbGRlci5qcyAyLjYuMC4KTGVhcm4gbW9yZSBhdCBodHRwOi8vaG9sZGVyanMuY29tCihjKSAyMDEyLTIwMTUgSXZhbiBNYWxvcGluc2t5IC0gaHR0cDovL2ltc2t5LmNvCi0tPjxkZWZzPjxzdHlsZSB0eXBlPSJ0ZXh0L2NzcyI+PCFbQ0RBVEFbI2hvbGRlcl8xNTAwNmExMzUyZSB0ZXh0IHsgZmlsbDojQUFBQUFBO2ZvbnQtd2VpZ2h0OmJvbGQ7Zm9udC1mYW1pbHk6QXJpYWwsIEhlbHZldGljYSwgT3BlbiBTYW5zLCBzYW5zLXNlcmlmLCBtb25vc3BhY2U7Zm9udC1zaXplOjEwcHQgfSBdXT48L3N0eWxlPjwvZGVmcz48ZyBpZD0iaG9sZGVyXzE1MDA2YTEzNTJlIj48cmVjdCB3aWR0aD0iMTQwIiBoZWlnaHQ9IjE0MCIgZmlsbD0iI0VFRUVFRSIvPjxnPjx0ZXh0IHg9IjQ1LjUiIHk9Ijc0LjUiPjE0MHgxNDA8L3RleHQ+PC9nPjwvZz48L3N2Zz4="
                         data-holder-rendered="true" style="width: 140px; height: 140px;">'; ?>

                    </div>
                    <div class="form-group">
                        <div class="col-centered">
                           <span class="btn btn-success btn-file">
                                Upload profile image<input type="file" name="upload" value="Upload profile image">
                            </span>
                        </div>
                    </div>
                </div>

                <div class="col-md-6">
                    <div class="form-group">
                        <label for="first_name">Your first Name</label>
                        <?php
                        echo html_input('first_name', $data['first_name'],
                            array('class' => 'form-control',
                                'type' => 'text',
                                'id' => 'first_name'

                            ));
                        ?>
                    </div>
                    <div class="form-group">
                        <label for="last_name">Your last Name</label>

                        <div class="input-group">
                            <?php
                            echo html_input('last_name', $data['last_name'],
                                array('class' => 'form-control',
                                    'type' => 'text',
                                    'id' => 'last_name'

                                ));
                            ?>
                            <span class="input-group-addon"></span>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="InputEmail">Your login / email</label>

                        <div class="input-group">
                            <?php
                            echo html_input('login', $data['login'],
                                array('class' => 'form-control',
                                    'type' => 'text',

                                ));
                            ?>
                            <span class="input-group-addon"></span>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="password">Enter your old password</label>

                        <div class="input-group">
                            <input type="password" class="form-control" id="password" name="old_password"
                                   placeholder="Enter password">
                            <span class="input-group-addon"><span class="glyphicon glyphicon-asterisk"></span></span>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="confirm">Confirm password</label>

                        <div class="input-group">
                            <input type="password" class="form-control" id="password" name="new_password"
                                   placeholder="confirm password">
                            <span class="input-group-addon"><span class="glyphicon glyphicon-asterisk"></span></span>
                        </div>
                    </div>
                    <input type="submit" name="submit" id="submit" value="Submit" class="btn btn-success pull-right">
                </div>
            </form>
        </div>
        <div role="tabpanel" class="tab-pane" id="messages">...</div>
        <div role="tabpanel" class="tab-pane" id="settings">...</div>
    </div>
</div>


<br>
<br>

<div class="row">
    <div class="col-md-9 col-md-offset-1">
        <h1>Add your publication</h1>
    </div>
    <div class="col-md-3">

    </div>

</div>
<form class="form-horizontal"
      action="<?php echo URL; ?>profile/addNews/<?php echo isset($news['id']) ? $news['id'] : null; ?>" method="POST"
      enctype="multipart/form-data">
    <div class="form-group">
        <label for="title" class="col-sm-2 control-label">Title</label>

        <div class="col-sm-10">
            <?php
            echo html_input_title('title', $news['title']);
            ?>

        </div>
    </div>
    <div class="form-group">
        <label for="body" class="col-sm-2 control-label">Body</label>

        <div class="col-sm-10">

            <?= html_textarea('body', $news['body']); ?>
        </div>
    </div>
    <div class="form-group">
        <div class="col-sm-offset-2 col-sm-10">
            <label> Upload a file
                <input type="file" name="upload" value="Choose an image">
            </label>
        </div>
    </div>
    <div class="form-group">
        <div class="col-sm-offset-2 col-sm-10">
            <?php echo isset($news['thumb']) ? image_thumb($news['thumb']) : null; ?>
        </div>
    </div>
    <div class="form-group">
        <div class="col-sm-offset-2 col-md-2">
            <select class="form-control" name="width">
                <option value="100">100 X 100</option>
                <option value="150">150 X 150</option>
                <option value="200">200 X 200</option>
                <option value="300">300 X 300</option>

            </select>
        </div>
    </div>
    <div class="form-group">
        <div class="col-sm-offset-2 col-sm-10">
            <button type="submit" name="submit" class="btn btn-default delete" value="upload">Post News</button>
        </div>
    </div>

</form>
