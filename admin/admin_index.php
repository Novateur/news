	<?php
		include_once("includes/header_menu.php");
	?>
		<div class="container">
			<div class="row">
				<button class="btn btn-warning btn-sm pull-right" onclick="show_sidebar()" id="show_menu" style="display:block">Show menu</button>
			</div>
			<div class="row"><br/>
						<div class="col-md-3 col-sm-6">
							  <div class="panel b-a">
								<div class="panel-heading no-border bg-info lt text-center" style="height:100px">
								  <a href="add_category.php">
									<h1><i class="glyphicon glyphicon-list"></i></h1>
								  </a>
								</div>
								<div class="padder-v text-center clearfix" style="height:50px">                            
								  <div class="col-xs-12 b-r"><br/>
									<h4 class="text-muted">Add a category</h4>
								  </div>
								</div>
							  </div>
						</div>						
						<div class="col-md-3 col-sm-6">
							  <div class="panel b-a">
								<div class="panel-heading no-border bg-info lt text-center" style="height:100px">
								  <a href="view_categories.php">
									<h1><i class="glyphicon glyphicon-eye-open"></i></h1>
								  </a>
								</div>
								<div class="padder-v text-center clearfix" style="height:50px">                            
								  <div class="col-xs-12 b-r"><br/>
									<h4 class="text-muted">View categories</h4>
								  </div>
								</div>
							  </div>
						</div>						
						<div class="col-md-3 col-sm-6">
							  <div class="panel b-a">
								<div class="panel-heading no-border bg-danger lt text-center" style="height:100px">
								  <a href="add_source.php">
									<h1><i class="glyphicon glyphicon-link"></i></h1>
								  </a>
								</div>
								<div class="padder-v text-center clearfix" style="height:50px">                            
								  <div class="col-xs-12 b-r"><br/>
									<h4 class="text-muted">Add a source</h4>
								  </div>
								</div>
							  </div>
						</div>						
						<div class="col-md-3 col-sm-6">
							  <div class="panel b-a">
								<div class="panel-heading no-border bg-success lt text-center" style="height:100px">
								  <a href="view_sources.php">
									<h1><i class="glyphicon glyphicon-globe"></i></h1>
								  </a>
								</div>
								<div class="padder-v text-center clearfix" style="height:50px">                            
								  <div class="col-xs-12 b-r"><br/>
									<h4 class="text-muted">View sources</h4>
								  </div>
								</div>
							  </div>
						</div>						
						<div class="col-md-3 col-sm-6">
							  <div class="panel b-a">
								<div class="panel-heading no-border bg-warning lt text-center" style="height:100px">
								  <a href="index.php">
									<h1><i class="fa fa-bug"></i></h1>
								  </a>
								</div>
								<div class="padder-v text-center clearfix" style="height:50px">                            
								  <div class="col-xs-12 b-r"><br/>
									<h4 class="text-muted">Crawl articles</h4>
								  </div>
								</div>
							  </div>
						</div>						
						<div class="col-md-3 col-sm-6">
							  <div class="panel b-a">
								<div class="panel-heading no-border bg-success lt text-center" style="height:100px">
								  <a href="view_articles.php">
									<h1><i class="glyphicon glyphicon-file"></i></h1>
								  </a>
								</div>
								<div class="padder-v text-center clearfix" style="height:50px">                            
								  <div class="col-xs-12 b-r"><br/>
									<h4 class="text-muted">View articles</h4>
								  </div>
								</div>
							  </div>
						</div>						
						<div class="col-md-3 col-sm-6">
							  <div class="panel b-a">
								<div class="panel-heading no-border bg-success lt text-center" style="height:100px">
								  <a href="#">
									<h1><i class="fa fa-pie-chart"></i></h1>
								  </a>
								</div>
								<div class="padder-v text-center clearfix" style="height:50px">                            
								  <div class="col-xs-12 b-r"><br/>
									<h4 class="text-muted">Analytics</h4>
								  </div>
								</div>
							  </div>
						</div>						
						<div class="col-md-3 col-sm-6">
							  <div class="panel b-a">
								<div class="panel-heading no-border bg-warning lt text-center" style="height:100px">
								  <a href="logout.php">
									<h1><i class="ion-person"></i></h1>
								  </a>
								</div>
								<div class="padder-v text-center clearfix" style="height:50px">                            
								  <div class="col-xs-12 b-r"><br/>
									<h4 class="text-muted">Logout</h4>
								  </div>
								</div>
							  </div>
						</div>
			</div>

		</div>

		<div>
			<!-- Display how fast the page was rendered. -->
			<p class="container">Page processed in <?php $mtime = explode(' ', microtime()); echo round($mtime[0] + $mtime[1] - $starttime, 3); ?> seconds.</p>

		</div>

	


	<script src="../js/jquery-2.1.3.min.js"></script>
	<script src="../js/bootstrap.min.js"></script>
	<script>
		function fetch_source(val)
		{
			alert(val);
		}
		function hide_sidebar()
		{
			$('#sidebar').hide('fast');
			$('#show_menu').show('fast');
			$('#logout').show('fast');
		}		
		function show_sidebar()
		{
			$('#sidebar').show('fast');
			$('#show_menu').hide('fast');
			$('#logout').hide('fast');
		}
	</script>
</body>
</html>
