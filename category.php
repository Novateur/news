<?php
	require_once("includes/db.inc");
	require("includes/functions.php");
	
	if(isset($_GET['category']) && !empty($_GET['category']))
	{
		$category = sanitize($_GET['category']);
	}
	else
	{
		header("location:error/404.php");
	}
	
	include_once("includes/header.php");
?>
	<div class="container">
		<div class="row"><br/>
			<div class="col-md-8">
				<?php
					$sql_pag="SELECT COUNT(*) FROM articles WHERE category='{$category}'";
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
						if($page > ceil($totalpage1/$limit))
						{
							header("location:error/404.php");
						}
						else
						{
							$start=($page-1) * $limit;
						}
					}
					else
					{
						$start=0;
					}
					//$sql="SELECT * FROM articles WHERE DATE(ma_date)=DATE_SUB(CURDATE(),INTERVAL 1 MONTH)";
					$sql="SELECT * FROM articles WHERE category='{$category}' LIMIT $start, $limit";
					$query = $connection->query($sql);
					if($query->rowCount()>0)
					{
						echo "<div class='well well-sm'>
							<span style='font-family:Tangerine;font-size:30px'><b>".strtoupper($category)."</b></span>
						</div>";
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
						echo"<div class='row'>";
							echo "<div class='col-sm-12'>";
								echo "<div align='center'id='paginate1'>";																
									$previous=$page-1;
									$next=$page+1;
									$total_num_pages=ceil($totalpage1/$limit);
									if($total_num_pages>1)
									{
										echo "<ul class='pagination pagination-sm'>";
										echo "Page {$page} of {$total_num_pages} pages<br/>";
										if($previous>=1)
										{
											echo "<li><a href='category.php?category={$category}&page={$previous}'>Previous</a></li>";
										}
										for($i=1;$i<=$total_num_pages;$i++)
										{
											if($i==$page)
											{
												echo "<li class='active'><a href='#'>{$i}</a></li>";
											}
											else
											{
												echo "<li><a href='category.php?category={$category}&page={$i}'>{$i}</a></li>";
											}
										}										
										if($next<=$total_num_pages)
										{
											echo "<li><a href='category.php?category={$category}&page={$next}'>Next</a></li>";
										}
										echo "</ul>";
									}
								echo "</div>";
							echo "</div>";
						echo "</div>";
					}
					else
					{
						echo "<h1>No news to be fetched</h1>";
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