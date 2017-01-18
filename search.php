<?php
	require_once("includes/db.inc");
	require("includes/functions.php");
	
	if(isset($_GET['term']) && !empty($_GET['term']))
	{
		$starttime = explode(' ', microtime());
		$starttime = $starttime[1] + $starttime[0];
		$term = sanitize($_GET['term']);
		$category = sanitize($_GET['category']);
	}
	else
	{
		header("location:home.php?page=1");
	}
	
	include_once("includes/header.php");
?>
	<div class="container">
		<div class="row"><br/>
			<div class="col-md-8">
				<?php
					if($category=="")
					{
						$paginate_sql = "SELECT COUNT(*) FROM articles WHERE title LIKE '%".$term."%'";
						$main_sql = "SELECT * FROM articles WHERE title LIKE '%".$term."%'";
					}
					else
					{
						$paginate_sql = "SELECT COUNT(*) FROM articles WHERE title LIKE '%".$term."%' AND category='{$category}'";
						$main_sql = "SELECT * FROM articles WHERE title LIKE '%".$term."%' AND category='{$category}'";
					}
					/*$sql_pag = $paginate_sql;
					$totalpage=$connection->query($sql_pag);
					$totalpage->setFetchMode(PDO::FETCH_ASSOC);
					foreach($totalpage as $t)
					{
						$totalpage1=array_shift($t);
					}
					$limit=10;
					$page=$_GET['page'];
					if($page)
					{
						$start=($page-1) * $limit;
					}
					else
					{
						$start=0;
					}
					*/
					$sql = $main_sql;
					$query = $connection->query($sql);
					if($query->rowCount()>0)
					{
						$query->setFetchMode(PDO::FETCH_ASSOC);
						foreach($query as $r)
						{
							echo "<div class='well' style='background-color:#f9f9f9;border-radius:0px'> 
							
								<span style='font-size:15px'><a href='read.php?readUrl={$r['link']}' onclick=\"alert('initializing hit counter for id {$r['id']}')\"><b>{$r['title']}</b></a></span><br/><span class='text-muted' style='font-size:11px'><i class='glyphicon glyphicon-time'></i> ". 
								get_time_interval_sm($r['created_time'])." ({$r['created_time']})</span><br/>
								<b>Source:</b> {$r['source']}<br/>";
								if($r['image_link']=="")
								{
									echo "<br/>";
								}
								else
								{
									echo "<img {$r['image_link']} width='120' height='90'/><br/>";
								}
								if(strlen($r['content']) > 500)
								{
									echo "<span style='font-size:13px'>".substr($r['content'],0,500)."...</span><br/>";
								}
								else
								{
									echo "<span style='font-size:13px'>{$r['content']}</span><br/>";
								}
							
							echo "</div>";
						}
						/*echo"<div class='row'>";
							echo "<div class='col-sm-12'>";
								echo "<div align='center'id='paginate1'>";							
									$prev_slide=$page-9;
									$next_slide=$page+9;									
									$previous=$page-1;
									$next=$page+1;
									$total_num_pages=ceil($totalpage1/$limit);
									if($total_num_pages>1)
									{
										echo "Page {$page} of {$total_num_pages} pages<br/>";
										if($previous>=1)
										{
											echo "<a href='home.php?page={$previous}' class='btn btn-default btn-sm' data-role='button'>Previous</a> ";
										}
										if($prev_slide >=9)
										{
											echo "<a href='home.php?page={$prev_slide}'><b>...</b></a> ";
										}
										for($i=$page;$i<=$total_num_pages;$i++)
										{
											if($i==$page)
											{
												echo "<button type='button' class='btn btn-success btn-sm'>{$i}</button> ";
											}
											else
											{
												if($i<=$page+9)
												{
													echo "<a href='home.php?page={$i}' data-role='button' class='btn btn-default btn-sm'>{$i}</a> ";
												}
											}
										}
										
										if($next_slide<=$total_num_pages)
										{
											echo "<a href='home.php?page={$next_slide}'><b>...</b></a> ";
										}										
										if($next<=$total_num_pages)
										{
											echo "<a href='home.php?page={$next}' data-role='button' class='btn btn-default btn-sm'>Next</a>";
										}
									}
								echo "</div>";
							echo "</div>";
						echo "</div>";*/
					}
					else
					{
						echo "<div class='alert alert-danger'>
							<h3>No result found for '".$term."'";if(isset($_GET['category']) && !empty($_GET['category']))
							{
								echo " in ".$_GET['category'];
							}echo "</h3>
						</div>";
					}


				?>
			</div>
			<div class="col-md-4">
				<?php
					include_once("includes/sidebar.php");
				?>
			</div>						
		</div>

	</div>
	<?php
		include_once("includes/footer.php");
	?>
</body>
</html>