<?php

	require_once("../includes/db.inc");
	require("../includes/functions.php");

?>
<!DOCTYPE html>
<html lang="en-US">
<head>

	<meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="icon" href="../../favicon.ico">

    <title>Novateur :: News</title>

    <link href="../css/bootstrap.min.css" rel="stylesheet">


    <link href="../css/jumbotron.css" rel="stylesheet">
    <link href="../css/ionicons.min.css" rel="stylesheet">
    <link href="../css/font-awesome.css" rel="stylesheet">

    <!-- IE10 viewport hack for Surface/desktop Windows 8 bug -->
    <script src="../js/ie10-viewport-bug-workaround.js"></script>
	<link href='//fonts.googleapis.com/css?family=Abel' rel='stylesheet' type='text/css'>
<link href='//fonts.googleapis.com/css?family=Roboto:400,100,100italic,300,300italic,400italic,500,500italic,700,700italic,900,900italic' rel='stylesheet' type='text/css'>
</head>
<body id="bodydemo" style='font-family:Verdana,sans-serif'>
	<div class='container' style="margin-top:-45px">
        <!--<img src="images/sd.png">-->
        <div class="pull-right">
            <button class='btn btn-danger'><span class='ion-person'></span> Sign in</button>
        </div>
    </div>
    <div class="navbar navbar-default navbar-static-top" role="navigation">
      <div class="container">
        <div class="navbar-header">
          <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
            <span class="sr-only">Toggle navigation</span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
          </button>
          <a class="navbar-brand" href="home.php?page=1"><i class="ion ion-home"></i> Home</a>
        </div>

        <div class="navbar-collapse collapse">
          <form class="navbar-form navbar-right" role="form" method="get" action="search.php">
						<span>Search for</span> 
						<input type="text" name="term" id="term" width="100" class="form-control input-sm" placeholder="Enter your search term" />
						<span>in</span>
						<select class="form-control input-sm" name="category" id="category">
							<?php
								get_categories();
							?>
						</select>
						<button type="search" name="search" id="search" value="search" class="btn btn-sm" ><i class="fa fa-search"></i></button>
          </form>
        </div><!--/.navbar-collapse -->
      </div>
    </div>
	<div class="container">
		<div class="row">
			<div class="col-md-12" style="margin-top:100px">
				<h1 style="text-align:center">Error 404</h1>
				<h3 style="text-align:center">Page not found</h3>
			</div>
		</div>
	</div>
	<script src="../js/jquery-2.1.3.min.js"></script>
	<script src="../js/bootstrap.min.js"></script>
</body>
</html>