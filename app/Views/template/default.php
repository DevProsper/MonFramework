<!DOCTYPE html>
<html lang="en">
<!-- Added by HTTrack --><meta http-equiv="content-type" content="text/html;charset=utf-8" /><!-- /Added by HTTrack -->
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
    <meta name="description" content="">
    <meta name="author" content="">
    <script rel="stylesheet" type="text/javascript" src="public/js/jquery.js"></script>
    <link rel="stylesheet" type="text/css" href="public/css/bootstrap.min.css">
    <title><?php App::getInstance()->title;  ?></title>

    <!-- Bootstrap core CSS -->

    <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!--[if lt IE 9]>
    <![endif]-->
  </head>

  <body>

    <nav class="navbar navbar-inverse navbar-fixed-top">
      <div class="container">
        <div class="navbar-header">
          <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
            <span class="sr-only">Toggle navigation</span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
          </button>
          <a class="navbar-brand" href="#">Project name</a>
        </div>
        <div id="navbar" class="collapse navbar-collapse">
          <ul class="nav navbar-nav">

          </ul>
        </div><!--/.nav-collapse -->
      </div>
    </nav>
    <style type="text/css">
    	.cont{
    		padding-top: 70px;
    	}
    </style>

    <div class="container cont">
        Flash
      <div class="starter-template">
        <?= $content; ?>
      </div>

    </div><!-- /.container -->

  </body>

<!-- Mirrored from getbootstrap.com/examples/starter-template/ by HTTrack Website Copier/3.x [XR&CO'2014], Thu, 05 Jan 2017 10:25:30 GMT -->
</html>
