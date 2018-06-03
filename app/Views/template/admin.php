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
                             </span>
                        <a data-toggle="dropdown" class="dropdown-toggle" href="#">
                            <span class="clear"> <span class="block m-t-xs"> <strong class="font-bold">Administration du site</strong>
                             </span> <span class="text-muted text-xs block">Quiter<b class="caret"></b></span> </span> </a>
                        <ul class="dropdown-menu animated fadeInRight m-t-xs">
                            <li><a href="index.php?module=logout">Déconnexion</a></li>
                        </ul>
                    </div>
                    <div class="logo-element">
                        JENNY+
                    </div>
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

</body>

<!-- Mirrored from webapplayers.com/inspinia_admin-v2.7.1/ by HTTrack Website Copier/3.x [XR&CO'2014], Tue, 16 Jan 2018 05:33:39 GMT -->
</html>
