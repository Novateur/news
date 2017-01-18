<?php
require_once('../includes/db.inc');
require_once('../includes/functions.php');

$starttime = explode(' ', microtime());
$starttime = $starttime[1] + $starttime[0];

if(!isset($_SESSION['username']))
{
	header("location:../home.php?page=1");
}

?><!DOCTYPE html>

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
	<!-- web-fonts -->  
	<link href='//fonts.googleapis.com/css?family=Abel' rel='stylesheet' type='text/css'>
	<link href='//fonts.googleapis.com/css?family=Roboto:400,100,100italic,300,300italic,400italic,500,500italic,700,700italic,900,900italic' rel='stylesheet' type='text/css'>
	<!-- //web-fonts -->

</head>

<body id="bodydemo">
    <div class="navbar navbar-inverse navbar-fixed-top" role="navigation"style="background-color:#e68a00;border:1px solid #e68a00">
      <div class="container">
        <div class="navbar-header">
          <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
            <span class="sr-only">Toggle navigation</span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
          </button>
          <a class="navbar-brand" href="#"style="color:white"><img src="images/moulogo.png"width="50"height="50"style="margin-top:-15px"/> News App</a>
        </div>
        <div class="navbar-collapse collapse">
          <form class="navbar-form navbar-right" role="form">
		  
						<input type="text" name="locale" id="locale" width="100" class="form-control" placeholder="Enter your search term" />
						<button type="button" name="search" id="search" class="btn" onclick="doSearch()"><i class="fa fa-search"></i></button>		
            <!--<button type="button" class="btn btn-primary"style="border-bottom:2px solid black"onclick="signout()">Sign out</button>-->
          </form>
		  		<ul class="nav navbar-nav pull-right">
                    <li>
                        <a href="logout.php"id='logout' style="color:#fff;display:block"><i class="ion-person"></i> Logout</a>
                    </li>
                </ul>
        </div><!--/.navbar-collapse -->
      </div>
    </div>
		        <div class="column col-sm-2 col-xs-1 sidebar-offcanvas" id="sidebar" style='background-color: #f2dede;border-color: #ebccd1;text-shadow:none;height:750px;position:absolute;z-index:30000;display:none;margin-top:2px'>
              
              	<ul class="nav">
          			<li><a href="#" data-toggle="offcanvas" class="visible-xs text-center"><i class="glyphicon glyphicon-chevron-right"></i></a></li>
            	</ul>
               
                <ul class="nav hidden-xs" id="lg-menu" style="font-size:16px">
					<button class="btn btn-warning btn-sm pull-right" onclick="hide_sidebar()" style="border-radius:0px">Close</button>
					<h3>Menu</h3>
					<li class="active"><a href="admin_index.php" style="color: #a94442;"><i class="glyphicon glyphicon-dashboard"></i> Dashboard</a></li>
                    <li><a href="add_category.php" style="color: #a94442;"><i class="glyphicon glyphicon-list"></i> Add a category</a></li>
					<li><a href="view_categories.php" style="color: #a94442;"><i class="glyphicon glyphicon-eye-open"></i> View categories</a></li>
					<li><a href="add_source.php" style="color: #a94442;"><i class="glyphicon glyphicon-link"></i> Add a source</a></li>
                    <li><a href="view_sources.php" style="color: #a94442;"><i class="glyphicon glyphicon-globe"></i> View sources </a></li>
					<li><a href="index.php" style="color: #a94442;"><i class="fa fa-bug"></i> Crawl articles</a></li>
					<li><a href="view_articles.php" style="color: #a94442;"><i class="glyphicon glyphicon-file"></i> View articles</a></li>
                    <li><a href="#" style="color: #a94442;"><i class="fa fa-pie-chart"></i> Analytics</a></li>
					<li><a href="logout.php"id='h_s_online' style="color: #a94442;"><i class="ion-person"></i> Logout</a></li>
                </ul>

              
              	<!-- tiny only nav-->
              <ul class="nav visible-xs" id="xs-menu">
                  	<li><a href="#featured" class="text-center"><i class="glyphicon glyphicon-list-alt"></i></a></li>
                    <li><a href="#stories" class="text-center"><i class="glyphicon glyphicon-list"></i></a></li>
                  	<li><a href="#" class="text-center"><i class="glyphicon glyphicon-paperclip"></i></a></li>
                    <li><a href="#" class="text-center"><i class="glyphicon glyphicon-refresh"></i></a></li>
                </ul>
              
            </div>
