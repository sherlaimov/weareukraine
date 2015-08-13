<?php

?>
<!DOCTYPE html>
<html>

<head>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>INSPINIA | Static Tables</title>

    <link href="<?php echo URL; ?>public/inspinia/css/bootstrap.min.css" rel="stylesheet">
    <link href="<?php echo URL; ?>public/inspinia/font-awesome/css/font-awesome.css" rel="stylesheet">
    <link href="<?php echo URL; ?>public/inspinia/css/plugins/iCheck/custom.css" rel="stylesheet">
    <link href="<?php echo URL; ?>public/inspinia/css/animate.css" rel="stylesheet">
    <link href="<?php echo URL; ?>public/inspinia/css/style.css" rel="stylesheet">

</head>

<body>

<div id="wrapper">

<nav class="navbar-default navbar-static-side" role="navigation">
    <div class="sidebar-collapse">
        <ul class="nav" id="side-menu">
            <li class="nav-header">
                <div class="dropdown profile-element"> <span>
                            <img alt="image" class="img-circle" src="<?php echo URL; ?>public/inspinia/img/profile_small.jpg" />
                             </span>
                    <a data-toggle="dropdown" class="dropdown-toggle" href="#">
                            <span class="clear"> <span class="block m-t-xs"> <strong class="font-bold"><?php echo $this->user->get('fullname'); ?></strong>
                             </span> <span class="text-muted text-xs block">Business Development Director <b class="caret"></b></span> </span> </a>
                    <ul class="dropdown-menu m-t-xs">
                           <li class="divider"></li>
                        <li><a href="login.html">Logout</a></li>
                    </ul>
                </div>
                <div class="logo-element">
                    IN+
                </div>
            </li>
            <li class="active">
                <a href="<?php echo URL; ?>admin"><i class="fa fa-th-large"></i> <span class="nav-label">News</span> <span class="fa arrow"></span></a>

            </li>
            <li>
                <a href="<?php echo URL; ?>user"><i class="fa fa-users"></i> <span class="nav-label">Users</span></a>

            </li>

        </ul>

    </div>
</nav>

<div id="page-wrapper" class="gray-bg">
<div class="row border-bottom">
    <nav class="navbar navbar-static-top" role="navigation" style="margin-bottom: 0">
        <div class="navbar-header">
            <a class="navbar-minimalize minimalize-styl-2 btn btn-primary " href="#"><i class="fa fa-bars"></i> </a>
            <form role="search" class="navbar-form-custom" action="search_results.html">
                <div class="form-group">
                    <input type="text" placeholder="Search for something..." class="form-control" name="top-search" id="top-search">
                </div>
            </form>
        </div>
        <ul class="nav navbar-top-links navbar-right">
            <li>
                <span class="m-r-sm text-muted welcome-message">Welcome to the best CMS for News Publishing</span>
            </li>
            <li>
                <a href="login.html">
                    <i class="fa fa-sign-out"></i> Log out
                </a>
            </li>
        </ul>

    </nav>
</div>
<div class="row wrapper border-bottom white-bg page-heading">
    <div class="col-lg-10">
        <h2>News Section</h2>

    </div>
    <div class="col-lg-2">

    </div>
</div>

    <?php include VIEWS . $content_view; ?>

<div class="row">
    <div class="col-lg-12">
        <div class="ibox float-e-margins">
            <div class="ibox-title">
                <h5>Custom responsive table </h5>
                <div class="ibox-tools">
                    <a class="collapse-link">
                        <i class="fa fa-chevron-up"></i>
                    </a>
                    <a class="dropdown-toggle" data-toggle="dropdown" href="#">
                        <i class="fa fa-wrench"></i>
                    </a>
                    <ul class="dropdown-menu dropdown-user">
                        <li><a href="#">Config option 1</a>
                        </li>
                        <li><a href="#">Config option 2</a>
                        </li>
                    </ul>
                    <a class="close-link">
                        <i class="fa fa-times"></i>
                    </a>
                </div>
            </div>
            <div class="ibox-content">
                <div class="row">
                    <div class="col-sm-5 m-b-xs"><select class="input-sm form-control input-s-sm inline">
                            <option value="0">Option 1</option>
                            <option value="1">Option 2</option>
                            <option value="2">Option 3</option>
                            <option value="3">Option 4</option>
                        </select>
                    </div>
                    <div class="col-sm-4 m-b-xs">
                        <div data-toggle="buttons" class="btn-group">
                            <label class="btn btn-sm btn-white"> <input type="radio" id="option1" name="options"> Day </label>
                            <label class="btn btn-sm btn-white active"> <input type="radio" id="option2" name="options"> Week </label>
                            <label class="btn btn-sm btn-white"> <input type="radio" id="option3" name="options"> Month </label>
                        </div>
                    </div>
                    <div class="col-sm-3">
                        <div class="input-group"><input type="text" placeholder="Search" class="input-sm form-control"> <span class="input-group-btn">
                                        <button type="button" class="btn btn-sm btn-primary"> Go!</button> </span></div>
                    </div>
                </div>
                <div class="table-responsive">
                    <table class="table table-striped">
                        <thead>
                        <tr>

                            <th></th>
                            <th>Project </th>
                            <th>Completed </th>
                            <th>Task</th>
                            <th>Date</th>
                            <th>Action</th>
                        </tr>
                        </thead>
                        <tbody>
                        <tr>
                            <td><input type="checkbox"  checked class="i-checks" name="input[]"></td>
                            <td>Project<small>This is example of project</small></td>
                            <td><span class="pie">0.52/1.561</span></td>
                            <td>20%</td>
                            <td>Jul 14, 2013</td>
                            <td><a href="#"><i class="fa fa-check text-navy"></i></a></td>
                        </tr>
                        <tr>
                            <td><input type="checkbox" class="i-checks" name="input[]"></td>
                            <td>Alpha project</td>
                            <td><span class="pie">6,9</span></td>
                            <td>40%</td>
                            <td>Jul 16, 2013</td>
                            <td><a href="#"><i class="fa fa-check text-navy"></i></a></td>
                        </tr>
                        <tr>
                            <td><input type="checkbox" class="i-checks" name="input[]"></td>
                            <td>Betha project</td>
                            <td><span class="pie">3,1</span></td>
                            <td>75%</td>
                            <td>Jul 18, 2013</td>
                            <td><a href="#"><i class="fa fa-check text-navy"></i></a></td>
                        </tr>
                        <tr>
                            <td><input type="checkbox" class="i-checks" name="input[]"></td>
                            <td>Gamma project</td>
                            <td><span class="pie">4,9</span></td>
                            <td>18%</td>
                            <td>Jul 22, 2013</td>
                            <td><a href="#"><i class="fa fa-check text-navy"></i></a></td>
                        </tr>
                        </tbody>
                    </table>
                </div>

            </div>
        </div>
    </div>

</div>
</div>
<div class="footer">
    <div class="pull-right">
        10GB of <strong>250GB</strong> Free.
    </div>
    <div>
        <strong>Copyright</strong> Example Company &copy; 2014-2015
    </div>
</div>

</div>
</div> <!--WRAPPER END-->



<!-- Mainly scripts -->
<script src="public/inspinia/js/jquery-2.1.1.js"></script>
<script src="public/inspinia/js/bootstrap.min.js"></script>
<script src="public/inspinia/js/plugins/metisMenu/jquery.metisMenu.js"></script>
<script src="public/inspinia/js/plugins/slimscroll/jquery.slimscroll.min.js"></script>

<!-- Peity -->
<script src="<?php echo URL; ?>public/inspinia/js/plugins/peity/jquery.peity.min.js"></script>

<!-- Custom and plugin javascript -->
<script src="public/inspinia/js/inspinia.js"></script>
<script src="public/inspinia/js/plugins/pace/pace.min.js"></script>

<!-- iCheck -->
<script src="public/inspinia/js/plugins/iCheck/icheck.min.js"></script>

<!-- Peity -->
<script src="public/inspinia/js/demo/peity-demo.js"></script>

<script>
    $(document).ready(function(){
        $('.i-checks').iCheck({
            checkboxClass: 'icheckbox_square-green',
            radioClass: 'iradio_square-green'
        });
    });
</script>

</body>

</html>
