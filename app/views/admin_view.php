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
    <link href="<?php echo URL; ?>public/inspinia/css/plugins/summernote/summernote.css" rel="stylesheet">
    <link href="<?php echo URL; ?>public/inspinia/css/plugins/summernote/summernote-bs3.css" rel="stylesheet">
    <link href="<?php echo URL; ?>public/inspinia/css/animate.css" rel="stylesheet">
    <link href="<?php echo URL; ?>public/inspinia/css/style.css" rel="stylesheet">
    <link href="<?php echo URL; ?>public/css/style.css" rel="stylesheet">


</head>

<body>

<div id="wrapper">

    <nav class="navbar-default navbar-static-side" role="navigation">
        <div class="sidebar-collapse">
            <ul class="nav" id="side-menu">
                <li class="nav-header">
                    <div class="dropdown profile-element"> <span>
                            <img alt="image" class="img-circle"
                                 src="<?php echo URL; ?>public/inspinia/img/profile_small.jpg"/>
                             </span>
                        <a data-toggle="dropdown" class="dropdown-toggle" href="<?php echo URL . 'admin'; ?>">
                            <span class="clear"> <span class="block m-t-xs"> <strong
                                        class="font-bold"><?php
//                                        echo $this->user->fullName() ? $this->user->fullName() : null;
                                        ?></strong>
                             </span> <span class="text-muted text-xs block">Business Development Director <b
                                        class="caret"></b></span> </span> </a>
                        <ul class="dropdown-menu m-t-xs">
                            <li class="divider"></li>
                            <li><a href="login.html">Logout</a></li>
                        </ul>
                    </div>
                    <div class="logo-element">
                        IN+
                    </div>
                </li>
                <li <?php echo $_GET['url'] == 'admin' || $_GET['url'] == 'admin/index' ? 'class="active"' : null; ?>>
                    <a href="<?php echo URL . 'admin'; ?>"><i class="fa fa-server"></i> <span
                            class="nav-label">Dashboard</span></span></a>

                </li>
                <li <?php echo $_GET['url'] == 'admin/news/' ? 'class="active"' : null; ?>>
                    <a href="<?php echo href('news'); ?>"><i class="fa fa-th-large"></i> <span
                            class="nav-label">News</span> <span class="fa arrow"></span></a>

                </li>
                <li <?php echo $_GET['url'] == 'admin/user' ? 'class="active"' : null; ?>>
                    <a href="<?php echo URL; ?>admin/user"><i class="fa fa-users"></i> <span
                            class="nav-label">Users</span></a>

                </li>

            </ul>

        </div>
    </nav>

    <div id="page-wrapper" class="gray-bg">
        <div class="row border-bottom">
            <nav class="navbar navbar-static-top" role="navigation" style="margin-bottom: 0">
                <div class="navbar-header">
                    <a class="navbar-minimalize minimalize-styl-2 btn btn-primary " href="#"><i class="fa fa-bars"></i>
                    </a>

                    <form role="search" class="navbar-form-custom" action="search_results.html">
                        <div class="form-group">
                            <input type="text" placeholder="Search for something..." class="form-control"
                                   name="top-search"
                                   id="top-search">
                        </div>
                    </form>
                </div>
                <ul class="nav navbar-top-links navbar-right">
                    <li>
                        <span
                            class="m-r-sm text-muted welcome-message">Welcome to the best CMS for News Publishing</span>
                    </li>
                    <li><a href="<?php echo href('frontend/index'); ?>"><i class="fa fa-location-arrow"></i>Go Back to Site</a></li>

                    <li>
                        <a href="<?php echo href('login/logout'); ?>">
                            <i class="fa fa-sign-out"></i> Log out
                        </a>
                    </li>
                </ul>

            </nav>
        </div>

                <?php

                if ($message = Session::get('message')) {
                    echo '<div class="row border-bottom"><div class="ibox-content"><div class=" ';
                    if (isset($message) && is_array($message) && count($message)) {
                        foreach ($message as $text => $type) {
                            echo $type['type'];
                        }
                    }

                    echo ' alert-dismissable">';
                }

                ?>
                <?php
                //                    var_dump(Message::getMessages());die;
                if ($message = Session::get('message')) {
                    if (isset($message) && is_array($message) && count($message)) {
                        echo ' <button aria-hidden="true" data-dismiss="alert" class="close" type="button">×</button>';
                        foreach ($message as $text => $type) {
                            echo $type['text'];
                            //$_SESSION['message'] = null;
                            unset($_SESSION['message']);
                            //Message::removeMessage();

                        }

                        echo '</div></div></div>';
                    }
                }
                ?>



    <?php include VIEWS . $content_view; ?>


    <div class="footer">
        <div class="pull-right">
            10GB of <strong>250GB</strong> Free.
        </div>
        <div>
            <strong>Copyright</strong> Example Company &copy; 2014-2015
        </div>
    </div>
</div>
<!--PAGE_WRAPPER END-->

    <div id="right-sidebar">
<div class="sidebar-container">

<ul class="nav nav-tabs navs-3">

    <li class="active"><a data-toggle="tab" href="#tab-1">
            Notes
        </a></li>
    <li><a data-toggle="tab" href="#tab-2">
            Projects
        </a></li>
    <li class=""><a data-toggle="tab" href="#tab-3">
            <i class="fa fa-gear"></i>
        </a></li>
</ul>

<div class="tab-content">


<div id="tab-1" class="tab-pane active">

    <div class="sidebar-title">
        <h3><i class="fa fa-comments-o"></i> Latest Notes</h3>
        <small><i class="fa fa-tim"></i> You have 10 new message.</small>
    </div>

    <div>

        <div class="sidebar-message">
            <a href="#">
                <div class="pull-left text-center">
                    <img alt="image" class="img-circle message-avatar" src="img/a1.jpg">

                    <div class="m-t-xs">
                        <i class="fa fa-star text-warning"></i>
                        <i class="fa fa-star text-warning"></i>
                    </div>
                </div>
                <div class="media-body">

                    There are many variations of passages of Lorem Ipsum available.
                    <br>
                    <small class="text-muted">Today 4:21 pm</small>
                </div>
            </a>
        </div>
        <div class="sidebar-message">
            <a href="#">
                <div class="pull-left text-center">
                    <img alt="image" class="img-circle message-avatar" src="img/a2.jpg">
                </div>
                <div class="media-body">
                    The point of using Lorem Ipsum is that it has a more-or-less normal.
                    <br>
                    <small class="text-muted">Yesterday 2:45 pm</small>
                </div>
            </a>
        </div>
        <div class="sidebar-message">
            <a href="#">
                <div class="pull-left text-center">
                    <img alt="image" class="img-circle message-avatar" src="img/a3.jpg">

                    <div class="m-t-xs">
                        <i class="fa fa-star text-warning"></i>
                        <i class="fa fa-star text-warning"></i>
                        <i class="fa fa-star text-warning"></i>
                    </div>
                </div>
                <div class="media-body">
                    Mevolved over the years, sometimes by accident, sometimes on purpose (injected humour and the like).
                    <br>
                    <small class="text-muted">Yesterday 1:10 pm</small>
                </div>
            </a>
        </div>
        <div class="sidebar-message">
            <a href="#">
                <div class="pull-left text-center">
                    <img alt="image" class="img-circle message-avatar" src="img/a4.jpg">
                </div>

                <div class="media-body">
                    Lorem Ipsum, you need to be sure there isn't anything embarrassing hidden in the
                    <br>
                    <small class="text-muted">Monday 8:37 pm</small>
                </div>
            </a>
        </div>
        <div class="sidebar-message">
            <a href="#">
                <div class="pull-left text-center">
                    <img alt="image" class="img-circle message-avatar" src="img/a8.jpg">
                </div>
                <div class="media-body">

                    All the Lorem Ipsum generators on the Internet tend to repeat.
                    <br>
                    <small class="text-muted">Today 4:21 pm</small>
                </div>
            </a>
        </div>
        <div class="sidebar-message">
            <a href="#">
                <div class="pull-left text-center">
                    <img alt="image" class="img-circle message-avatar" src="img/a7.jpg">
                </div>
                <div class="media-body">
                    Renaissance. The first line of Lorem Ipsum, "Lorem ipsum dolor sit amet..", comes from a line in
                    section 1.10.32.
                    <br>
                    <small class="text-muted">Yesterday 2:45 pm</small>
                </div>
            </a>
        </div>
        <div class="sidebar-message">
            <a href="#">
                <div class="pull-left text-center">
                    <img alt="image" class="img-circle message-avatar" src="img/a3.jpg">

                    <div class="m-t-xs">
                        <i class="fa fa-star text-warning"></i>
                        <i class="fa fa-star text-warning"></i>
                        <i class="fa fa-star text-warning"></i>
                    </div>
                </div>
                <div class="media-body">
                    The standard chunk of Lorem Ipsum used since the 1500s is reproduced below.
                    <br>
                    <small class="text-muted">Yesterday 1:10 pm</small>
                </div>
            </a>
        </div>
        <div class="sidebar-message">
            <a href="#">
                <div class="pull-left text-center">
                    <img alt="image" class="img-circle message-avatar" src="img/a4.jpg">
                </div>
                <div class="media-body">
                    Uncover many web sites still in their infancy. Various versions have.
                    <br>
                    <small class="text-muted">Monday 8:37 pm</small>
                </div>
            </a>
        </div>
    </div>

</div>

<div id="tab-2" class="tab-pane">

    <div class="sidebar-title">
        <h3><i class="fa fa-cube"></i> Latest projects</h3>
        <small><i class="fa fa-tim"></i> You have 14 projects. 10 not completed.</small>
    </div>

    <ul class="sidebar-list">
        <li>
            <a href="#">
                <div class="small pull-right m-t-xs">9 hours ago</div>
                <h4>Business valuation</h4>
                It is a long established fact that a reader will be distracted.

                <div class="small">Completion with: 22%</div>
                <div class="progress progress-mini">
                    <div style="width: 22%;" class="progress-bar progress-bar-warning"></div>
                </div>
                <div class="small text-muted m-t-xs">Project end: 4:00 pm - 12.06.2014</div>
            </a>
        </li>
        <li>
            <a href="#">
                <div class="small pull-right m-t-xs">9 hours ago</div>
                <h4>Contract with Company </h4>
                Many desktop publishing packages and web page editors.

                <div class="small">Completion with: 48%</div>
                <div class="progress progress-mini">
                    <div style="width: 48%;" class="progress-bar"></div>
                </div>
            </a>
        </li>
        <li>
            <a href="#">
                <div class="small pull-right m-t-xs">9 hours ago</div>
                <h4>Meeting</h4>
                By the readable content of a page when looking at its layout.

                <div class="small">Completion with: 14%</div>
                <div class="progress progress-mini">
                    <div style="width: 14%;" class="progress-bar progress-bar-info"></div>
                </div>
            </a>
        </li>
        <li>
            <a href="#">
                <span class="label label-primary pull-right">NEW</span>
                <h4>The generated</h4>
                <!--<div class="small pull-right m-t-xs">9 hours ago</div>-->
                There are many variations of passages of Lorem Ipsum available.
                <div class="small">Completion with: 22%</div>
                <div class="small text-muted m-t-xs">Project end: 4:00 pm - 12.06.2014</div>
            </a>
        </li>
        <li>
            <a href="#">
                <div class="small pull-right m-t-xs">9 hours ago</div>
                <h4>Business valuation</h4>
                It is a long established fact that a reader will be distracted.

                <div class="small">Completion with: 22%</div>
                <div class="progress progress-mini">
                    <div style="width: 22%;" class="progress-bar progress-bar-warning"></div>
                </div>
                <div class="small text-muted m-t-xs">Project end: 4:00 pm - 12.06.2014</div>
            </a>
        </li>
        <li>
            <a href="#">
                <div class="small pull-right m-t-xs">9 hours ago</div>
                <h4>Contract with Company </h4>
                Many desktop publishing packages and web page editors.

                <div class="small">Completion with: 48%</div>
                <div class="progress progress-mini">
                    <div style="width: 48%;" class="progress-bar"></div>
                </div>
            </a>
        </li>
        <li>
            <a href="#">
                <div class="small pull-right m-t-xs">9 hours ago</div>
                <h4>Meeting</h4>
                By the readable content of a page when looking at its layout.

                <div class="small">Completion with: 14%</div>
                <div class="progress progress-mini">
                    <div style="width: 14%;" class="progress-bar progress-bar-info"></div>
                </div>
            </a>
        </li>
        <li>
            <a href="#">
                <span class="label label-primary pull-right">NEW</span>
                <h4>The generated</h4>
                <!--<div class="small pull-right m-t-xs">9 hours ago</div>-->
                There are many variations of passages of Lorem Ipsum available.
                <div class="small">Completion with: 22%</div>
                <div class="small text-muted m-t-xs">Project end: 4:00 pm - 12.06.2014</div>
            </a>
        </li>

    </ul>

</div>

<div id="tab-3" class="tab-pane">

    <div class="sidebar-title">
        <h3><i class="fa fa-gears"></i> Settings</h3>
        <small><i class="fa fa-tim"></i> You have 14 projects. 10 not completed.</small>
    </div>

    <div class="setings-item">
                    <span>
                        Show notifications
                    </span>

        <div class="switch">
            <div class="onoffswitch">
                <input type="checkbox" name="collapsemenu" class="onoffswitch-checkbox" id="example">
                <label class="onoffswitch-label" for="example">
                    <span class="onoffswitch-inner"></span>
                    <span class="onoffswitch-switch"></span>
                </label>
            </div>
        </div>
    </div>
    <div class="setings-item">
                    <span>
                        Disable Chat
                    </span>

        <div class="switch">
            <div class="onoffswitch">
                <input type="checkbox" name="collapsemenu" checked class="onoffswitch-checkbox" id="example2">
                <label class="onoffswitch-label" for="example2">
                    <span class="onoffswitch-inner"></span>
                    <span class="onoffswitch-switch"></span>
                </label>
            </div>
        </div>
    </div>
    <div class="setings-item">
                    <span>
                        Enable history
                    </span>

        <div class="switch">
            <div class="onoffswitch">
                <input type="checkbox" name="collapsemenu" class="onoffswitch-checkbox" id="example3">
                <label class="onoffswitch-label" for="example3">
                    <span class="onoffswitch-inner"></span>
                    <span class="onoffswitch-switch"></span>
                </label>
            </div>
        </div>
    </div>
    <div class="setings-item">
                    <span>
                        Show charts
                    </span>

        <div class="switch">
            <div class="onoffswitch">
                <input type="checkbox" name="collapsemenu" class="onoffswitch-checkbox" id="example4">
                <label class="onoffswitch-label" for="example4">
                    <span class="onoffswitch-inner"></span>
                    <span class="onoffswitch-switch"></span>
                </label>
            </div>
        </div>
    </div>
    <div class="setings-item">
                    <span>
                        Offline users
                    </span>

        <div class="switch">
            <div class="onoffswitch">
                <input type="checkbox" checked name="collapsemenu" class="onoffswitch-checkbox" id="example5">
                <label class="onoffswitch-label" for="example5">
                    <span class="onoffswitch-inner"></span>
                    <span class="onoffswitch-switch"></span>
                </label>
            </div>
        </div>
    </div>
    <div class="setings-item">
                    <span>
                        Global search
                    </span>

        <div class="switch">
            <div class="onoffswitch">
                <input type="checkbox" checked name="collapsemenu" class="onoffswitch-checkbox" id="example6">
                <label class="onoffswitch-label" for="example6">
                    <span class="onoffswitch-inner"></span>
                    <span class="onoffswitch-switch"></span>
                </label>
            </div>
        </div>
    </div>
    <div class="setings-item">
                    <span>
                        Update everyday
                    </span>

        <div class="switch">
            <div class="onoffswitch">
                <input type="checkbox" name="collapsemenu" class="onoffswitch-checkbox" id="example7">
                <label class="onoffswitch-label" for="example7">
                    <span class="onoffswitch-inner"></span>
                    <span class="onoffswitch-switch"></span>
                </label>
            </div>
        </div>
    </div>

    <div class="sidebar-content">
        <h4>Settings</h4>

        <div class="small">
            I belive that. Lorem Ipsum is simply dummy text of the printing and typesetting industry.
            And typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s.
            Over the years, sometimes by accident, sometimes on purpose (injected humour and the like).
        </div>
    </div>

</div>
</div>

</div>


</div>
</div>


<script>
//    $(document).ready(function () {
//        $('.chart').easyPieChart({
//            barColor: '#f8ac59',
////                scaleColor: false,
//            scaleLength: 5,
//            lineWidth: 4,
//            size: 80
//        });
//
//        $('.chart2').easyPieChart({
//            barColor: '#1c84c6',
////                scaleColor: false,
//            scaleLength: 5,
//            lineWidth: 4,
//            size: 80
//        });
//
//        var data2 = [
//            [gd(2012, 1, 1), 7], [gd(2012, 1, 2), 6], [gd(2012, 1, 3), 4], [gd(2012, 1, 4), 8],
//            [gd(2012, 1, 5), 9], [gd(2012, 1, 6), 7], [gd(2012, 1, 7), 5], [gd(2012, 1, 8), 4],
//            [gd(2012, 1, 9), 7], [gd(2012, 1, 10), 8], [gd(2012, 1, 11), 9], [gd(2012, 1, 12), 6],
//            [gd(2012, 1, 13), 4], [gd(2012, 1, 14), 5], [gd(2012, 1, 15), 11], [gd(2012, 1, 16), 8],
//            [gd(2012, 1, 17), 8], [gd(2012, 1, 18), 11], [gd(2012, 1, 19), 11], [gd(2012, 1, 20), 6],
//            [gd(2012, 1, 21), 6], [gd(2012, 1, 22), 8], [gd(2012, 1, 23), 11], [gd(2012, 1, 24), 13],
//            [gd(2012, 1, 25), 7], [gd(2012, 1, 26), 9], [gd(2012, 1, 27), 9], [gd(2012, 1, 28), 8],
//            [gd(2012, 1, 29), 5], [gd(2012, 1, 30), 8], [gd(2012, 1, 31), 25]
//        ];
//
//        var data3 = [
//            [gd(2012, 1, 1), 800], [gd(2012, 1, 2), 500], [gd(2012, 1, 3), 600], [gd(2012, 1, 4), 700],
//            [gd(2012, 1, 5), 500], [gd(2012, 1, 6), 456], [gd(2012, 1, 7), 800], [gd(2012, 1, 8), 589],
//            [gd(2012, 1, 9), 467], [gd(2012, 1, 10), 876], [gd(2012, 1, 11), 689], [gd(2012, 1, 12), 700],
//            [gd(2012, 1, 13), 500], [gd(2012, 1, 14), 600], [gd(2012, 1, 15), 700], [gd(2012, 1, 16), 786],
//            [gd(2012, 1, 17), 345], [gd(2012, 1, 18), 888], [gd(2012, 1, 19), 888], [gd(2012, 1, 20), 888],
//            [gd(2012, 1, 21), 987], [gd(2012, 1, 22), 444], [gd(2012, 1, 23), 999], [gd(2012, 1, 24), 567],
//            [gd(2012, 1, 25), 786], [gd(2012, 1, 26), 666], [gd(2012, 1, 27), 888], [gd(2012, 1, 28), 900],
//            [gd(2012, 1, 29), 178], [gd(2012, 1, 30), 555], [gd(2012, 1, 31), 993]
//        ];
//
//
//        var dataset = [
//            {
//                label: "Number of orders",
//                data: data3,
//                color: "#1ab394",
//                bars: {
//                    show: true,
//                    align: "center",
//                    barWidth: 24 * 60 * 60 * 600,
//                    lineWidth: 0
//                }
//
//            }, {
//                label: "Payments",
//                data: data2,
//                yaxis: 2,
//                color: "#464f88",
//                lines: {
//                    lineWidth: 1,
//                    show: true,
//                    fill: true,
//                    fillColor: {
//                        colors: [{
//                            opacity: 0.2
//                        }, {
//                            opacity: 0.2
//                        }]
//                    }
//                },
//                splines: {
//                    show: false,
//                    tension: 0.6,
//                    lineWidth: 1,
//                    fill: 0.1
//                },
//            }
//        ];
//
//
//        var options = {
//            xaxis: {
//                mode: "time",
//                tickSize: [3, "day"],
//                tickLength: 0,
//                axisLabel: "Date",
//                axisLabelUseCanvas: true,
//                axisLabelFontSizePixels: 12,
//                axisLabelFontFamily: 'Arial',
//                axisLabelPadding: 10,
//                color: "#d5d5d5"
//            },
//            yaxes: [{
//                position: "left",
//                max: 1070,
//                color: "#d5d5d5",
//                axisLabelUseCanvas: true,
//                axisLabelFontSizePixels: 12,
//                axisLabelFontFamily: 'Arial',
//                axisLabelPadding: 3
//            }, {
//                position: "right",
//                clolor: "#d5d5d5",
//                axisLabelUseCanvas: true,
//                axisLabelFontSizePixels: 12,
//                axisLabelFontFamily: ' Arial',
//                axisLabelPadding: 67
//            }
//            ],
//            legend: {
//                noColumns: 1,
//                labelBoxBorderColor: "#000000",
//                position: "nw"
//            },
//            grid: {
//                hoverable: false,
//                borderWidth: 0
//            }
//        };
//
//        function gd(year, month, day) {
//            return new Date(year, month - 1, day).getTime();
//        }
//
//        var previousPoint = null, previousLabel = null;
//
//        $.plot($("#flot-dashboard-chart"), dataset, options);
//
//        var mapData = {
//            "US": 298,
//            "SA": 200,
//            "DE": 220,
//            "FR": 540,
//            "CN": 120,
//            "AU": 760,
//            "BR": 550,
//            "IN": 200,
//            "GB": 120,
//        };
//
//        $('#world-map').vectorMap({
//            map: 'world_mill_en',
//            backgroundColor: "transparent",
//            regionStyle: {
//                initial: {
//                    fill: '#e4e4e4',
//                    "fill-opacity": 0.9,
//                    stroke: 'none',
//                    "stroke-width": 0,
//                    "stroke-opacity": 0
//                }
//            },
//
//            series: {
//                regions: [{
//                    values: mapData,
//                    scale: ["#1ab394", "#22d6b1"],
//                    normalizeFunction: 'polynomial'
//                }]
//            },
//        });
//    });
</script>

<!-- Mainly scripts -->
<script src="<?php echo URL; ?>public/inspinia/js/jquery-2.1.1.js"></script>
<script src="<?php echo URL; ?>public/inspinia/js/bootstrap.min.js"></script>
<script src="<?php echo URL; ?>public/inspinia/js/plugins/metisMenu/jquery.metisMenu.js"></script>
<script src="<?php echo URL; ?>public/inspinia/js/plugins/slimscroll/jquery.slimscroll.min.js"></script>
<!--SUMMERNOTE JS-->
<script src="<?php echo URL; ?>public/inspinia/js/plugins/summernote/summernote.min.js"></script>
<!-- Flot -->
<script src="<?php echo URL; ?>public/inspinia/js/plugins/flot/jquery.flot.js"></script>
<script src="<?php echo URL; ?>public/inspinia/js/plugins/flot/jquery.flot.tooltip.min.js"></script>
<script src="<?php echo URL; ?>public/inspinia/js/plugins/flot/jquery.flot.spline.js"></script>
<script src="<?php echo URL; ?>public/inspinia/js/plugins/flot/jquery.flot.resize.js"></script>
<script src="<?php echo URL; ?>public/inspinia/js/plugins/flot/jquery.flot.pie.js"></script>
<script src="<?php echo URL; ?>public/inspinia/js/plugins/flot/jquery.flot.symbol.js"></script>
<script src="<?php echo URL; ?>public/inspinia/js/plugins/flot/jquery.flot.time.js"></script>

<!-- Peity -->
<script src="<?php echo URL; ?>public/inspinia/js/plugins/peity/jquery.peity.min.js"></script>
<script src="<?php echo URL; ?>public/inspinia/js/demo/peity-demo.js"></script>

<!-- Custom and plugin javascript -->
<script src="<?php echo URL; ?>public/inspinia/js/inspinia.js"></script>
<script src="<?php echo URL; ?>public/inspinia/js/plugins/pace/pace.min.js"></script>

<!-- jQuery UI -->
<script src="<?php echo URL; ?>public/inspinia/js/plugins/jquery-ui/jquery-ui.min.js"></script>

<!-- Jvectormap -->
<script src="<?php echo URL; ?>public/inspinia/js/plugins/jvectormap/jquery-jvectormap-1.2.2.min.js"></script>
<script src="<?php echo URL; ?>public/inspinia/js/plugins/jvectormap/jquery-jvectormap-world-mill-en.js"></script>

<!-- EayPIE -->
<script src="<?php echo URL; ?>public/inspinia/js/plugins/easypiechart/jquery.easypiechart.js"></script>

<!-- Sparkline -->
<script src="<?php echo URL; ?>public/inspinia/js/plugins/sparkline/jquery.sparkline.min.js"></script>

<!-- Sparkline demo data  -->
<script src="<?php echo URL; ?>public/inspinia/js/demo/sparkline-demo.js"></script>

<!-- iCheck -->
<script src="<?php echo URL; ?>public/inspinia/js/plugins/iCheck/icheck.min.js"></script>


<script>
    $(document).ready(function () {
        $('.i-checks').iCheck({
            checkboxClass: 'icheckbox_square-green',
            radioClass: 'iradio_square-green'
        });
    });
</script>

</body>

</html>
