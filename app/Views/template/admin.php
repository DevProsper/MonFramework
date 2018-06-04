<!DOCTYPE html>
<html>

<head>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">

    <title>Immobilière | Administration</title>

    <link href="public/admin/font-awesome/css/font-awesome.css" rel="stylesheet">
    <link href="public/admin/css/bootstrap.min.css" rel="stylesheet">
    <link href="public/admin/css/plugins/iCheck/custom.css" rel="stylesheet">
    <link href="public/admin/css/plugins/summernote/summernote.css" rel="stylesheet">
    <link href="public/admin/css/plugins/summernote/summernote-bs3.css" rel="stylesheet">


    <!-- Toastr style -->

    <!-- Gritter -->
    <link href="public/admin/js/plugins/gritter/jquery.gritter.css" rel="stylesheet">

    <link href="public/admin/css/animate.css" rel="stylesheet">
    <link href="public/admin/css/style.css" rel="stylesheet">

</head>

<body>
<div id="wrapper">

    <nav class="navbar-default navbar-static-side" role="navigation">
        <div class="sidebar-collapse">
            <ul class="nav metismenu" id="side-menu">
                <li class="nav-header">
                    <div class="dropdown profile-element"> <span>
                            <img alt="image" class="img-circle" src="img/profile_small.jpg" />
                             </span>
                        <a data-toggle="dropdown" class="dropdown-toggle" href="#">
                            <span class="clear"> <span class="block m-t-xs"> <strong class="font-bold">David Williams</strong>
                             </span> <span class="text-muted text-xs block">Art Director <b class="caret"></b></span> </span> </a>
                        <ul class="dropdown-menu animated fadeInRight m-t-xs">
                            <li><a href="profile.html">Profile</a></li>
                            <li><a href="contacts.html">Contacts</a></li>
                            <li><a href="mailbox.html">Mailbox</a></li>
                            <li class="divider"></li>
                            <li><a href="login.html">Logout</a></li>
                        </ul>
                    </div>
                    <div class="logo-element">
                        IN+
                    </div>
                </li>
                <li class="active">
                    <a href="index-2.html"><i class="fa fa-th-large"></i> <span class="nav-label">Dashboards</span> <span class="fa arrow"></span></a>
                    <ul class="nav nav-second-level">
                        <li class="active"><a href="index-2.html">Dashboard v.1</a></li>
                        <li><a href="dashboard_2.html">Dashboard v.2</a></li>
                        <li><a href="dashboard_3.html">Dashboard v.3</a></li>
                        <li><a href="dashboard_4_1.html">Dashboard v.4</a></li>
                        <li><a href="dashboard_5.html">Dashboard v.5 </a></li>
                    </ul>
                </li>
                <li class="">
                    <a href="index.php?module=home"><i class="fa fa-th-large"></i> <span class="nav-label">Tableau de bord </span></span></a>
                </li>
            </ul>

        </div>
    </nav>

    <div id="page-wrapper" class="gray-bg dashbard-1">
        <div class="row border-bottom">
            <nav class="navbar navbar-static-top" role="navigation" style="margin-bottom: 0">
                <div class="navbar-header">
                    <a class="navbar-minimalize minimalize-styl-2 btn btn-primary " href="#"><i class="fa fa-bars"></i> </a>
                </div>


            </nav>
        </div>
        <div class="row">
            <div class="col-lg-12">
                <?= $content; ?>


                <div class="footer">
                    <div class="pull-right">
                        prosperngouari38@gmail.com <strong> | +242-06-428-98-39  </strong>
                    </div>
                    <div>
                        Copyright Tout droit réservés &copy;
                        <?php
                        $copyYear = 2017;
                        $curYear = date('Y');
                        echo $copyYear . (($copyYear != $curYear) ? '-' .$curYear : '');
                        ?> |
                        Veillez contactez l'administrateur pour un besoin quelconque
                    </div>
                </div>
            </div>
        </div>


            </div>

        </div>
    </div>

</div>



</div>
</div>

<!-- Mainly scripts -->
    <script src="public/admin/js/jquery-3.1.1.min.js"></script>
    <script src="public/admin/js/bootstrap.min.js"></script>
    <script src="public/admin/js/plugins/metisMenu/jquery.metisMenu.js"></script>
    <script src="public/admin/js/plugins/slimscroll/jquery.slimscroll.min.js"></script>
    <!-- SUMMERNOTE -->
    <script src="public/admin/js/plugins/summernote/summernote.min.js"></script>

    <!-- Flot -->
    <script src="public/admin/js/plugins/flot/jquery.flot.js"></script>
    <script src="public/admin/js/plugins/flot/jquery.flot.tooltip.min.js"></script>
    <script src="public/admin/js/plugins/flot/jquery.flot.spline.js"></script>
    <script src="public/admin/js/plugins/flot/jquery.flot.resize.js"></script>
    <script src="public/admin/js/plugins/flot/jquery.flot.pie.js"></script>
    <script src="public/admin/js/app.js"></script>

    <!-- Peity -->
    <script src="public/admin/js/plugins/peity/jquery.peity.min.js"></script>
    <script src="public/admin/js/demo/peity-demo.js"></script>

    <!-- Custom and plugin javascript -->
    <script src="public/admin/js/plugins/pace/pace.min.js"></script>

    <!-- jQuery UI -->
    <script src="public/admin/js/plugins/jquery-ui/jquery-ui.min.js"></script>

    <!-- GITTER -->
    <script src="public/admin/js/plugins/gritter/jquery.gritter.min.js"></script>
    
    <!-- Sparkline -->
    <script src="public/admin/js/plugins/sparkline/jquery.sparkline.min.js"></script>

    <!-- Sparkline demo data  -->
    <script src="public/admin/js/demo/sparkline-demo.js"></script>

    <!-- ChartJS-->
    <script src="public/admin/js/plugins/chartJs/Chart.min.js"></script>

    <!-- Toastr -->
    <script src="public/admin/js/plugins/toastr/toastr.min.js"></script>

    <!-- iCheck -->
    <script src="public/admin/js/plugins/iCheck/icheck.min.js"></script>

    <!-- SUMMERNOTE -->
    <script src="public/admin/js/plugins/summernote/summernote.min.js"></script>    
    <script>
        $(document).ready(function(){

            $('.summernote').summernote();

        });

    </script>
</body>

</html>
