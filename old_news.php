<?php
	require_once("includes/db.inc");
	require("includes/functions.php");
	//$gap=1;
	//$tm1=date("j M Y, g:i a", mktime(date("H"),date("i"),date("s"),date("m")-$gap,date("d"),date("Y")));
	$starttime = explode(' ', microtime());
	$starttime = $starttime[1] + $starttime[0];
	
	include_once("includes/header.php");
?>
	<div class="container">
		<div class="row"><br/>
			<div class="col-md-8">
				<?php
					if(isset($_GET['fetch_old_news']) || isset($_GET['days_ago']) || isset($_GET['weeks_ago']) || isset($_GET['months_ago']) || isset($_GET['years_ago']))
					{
						if(isset($_GET['fetch_old_news']) && !empty($_GET['fetch_old_news']) && $_GET['fetch_old_news']=="yesterday")
						{
							$time_back = "yesterday";
							$for_pagination = "yesterday";
							$paginate_sql = "SELECT COUNT(*) FROM articles WHERE DATE(ma_date)=DATE_SUB(CURDATE(),INTERVAL 1 DAY)";
							$main_sql = "SELECT * FROM articles WHERE DATE(ma_date)=DATE_SUB(CURDATE(),INTERVAL 1 DAY)";
						}										
						if(isset($_GET['days_ago']) && !empty($_GET['days_ago']))
						{
							$time_back = sanitize($_GET['days_ago']);
							$for_pagination = "days_ago=".sanitize($_GET['days_ago']);
							$time_back_list = $_GET['days_ago']." days";
							$paginate_sql = "SELECT COUNT(*) FROM articles WHERE DATE(ma_date)=DATE_SUB(CURDATE(),INTERVAL {$time_back} DAY)";
							$main_sql = "SELECT * FROM articles WHERE DATE(ma_date)=DATE_SUB(CURDATE(),INTERVAL {$time_back} DAY)";
						}					
						if(isset($_GET['weeks_ago']) && !empty($_GET['weeks_ago']))
						{
							$time_back = sanitize($_GET['weeks_ago']);
							$for_pagination = "weeks_ago=".sanitize($_GET['weeks_ago']);
							$time_back_list = $_GET['weeks_ago']." weeks";
							$paginate_sql = "SELECT COUNT(*) FROM articles WHERE DATE(ma_date)=DATE_SUB(CURDATE(),INTERVAL {$time_back} WEEK)";
							$main_sql = "SELECT * FROM articles WHERE DATE(ma_date)=DATE_SUB(CURDATE(),INTERVAL {$time_back} WEEK)";
						}					
						if(isset($_GET['months_ago']) && !empty($_GET['months_ago']))
						{
							$time_back = sanitize($_GET['months_ago']);
							$for_pagination = "months_ago=".sanitize($_GET['months_ago']);
							$time_back_list = $_GET['months_ago']." months";
							$paginate_sql = "SELECT COUNT(*) FROM articles WHERE DATE(ma_date)=DATE_SUB(CURDATE(),INTERVAL {$time_back} MONTH)";
							$main_sql = "SELECT * FROM articles WHERE DATE(ma_date)=DATE_SUB(CURDATE(),INTERVAL {$time_back} MONTH)";
						}					
						if(isset($_GET['years_ago']) && !empty($_GET['years_ago']))
						{
							$time_back = sanitize($_GET['years_ago']);
							$for_pagination = "years_ago=".sanitize($_GET['years_ago']);
							$time_back_list = $_GET['years_ago']." years";
							$paginate_sql = "SELECT COUNT(*) FROM articles WHERE DATE(ma_date)=DATE_SUB(CURDATE(),INTERVAL {$time_back} YEAR)";
							$main_sql = "SELECT * FROM articles WHERE DATE(ma_date)=DATE_SUB(CURDATE(),INTERVAL {$time_back} YEAR)";
						}
					}
					else
					{
						header("location:home.php?page=1");
					}
					$sql_pag = $paginate_sql;
					$totalpage=$connection->query($sql_pag);
					$totalpage->setFetchMode(PDO::FETCH_ASSOC);
					foreach($totalpage as $t)
					{
						$totalpage1=array_shift($t);
					}
					$limit=20;
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
					$sql = $main_sql.=" LIMIT $start, $limit";
					$query = $connection->query($sql);
					if($query->rowCount()>0)
					{
						echo "<h3>List of articles from ";if($time_back=="yesterday"){echo "yesterday";}else{ echo $time_back_list." ago";} echo "</h3>
						<small>({$query->rowCount()} result(s) found) Page processed in ";$mtime = explode(' ', microtime()); echo round($mtime[0] + $mtime[1] - $starttime, 3); echo " seconds.</small>";
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
									$prev_slide=$page-9;
									$next_slide=$page+9;									
									$previous=$page-1;
									$next=$page+1;
									$total_num_pages=ceil($totalpage1/$limit);
									if($total_num_pages>1)
									{
										echo "<ul class='pagination pagination-sm'>";
										echo "Page {$page} of {$total_num_pages} pages<br/>";
										if($previous>=1)
										{
											echo "<li><a href='old_news.php?{$for_pagination}&page={$previous}'>Previous</a></li>";
										}
										if($prev_slide>=9)
										{
											echo "<li><a href='home.php?page={$prev_slide}'><b>...</b></a></li>";
										}
										for($i=$page;$i<=$total_num_pages;$i++)
										{
											if($i==$page)
											{
												echo "<li class='active'><a href='#'>{$i}<a></li>";
											}
											else
											{
												if($i<=$page+9)
												{
													echo "<li><a href='old_news.php?{$for_pagination}&page={$i}'>{$i}</a></li>";
												}
											}
										}
										
										if($next_slide<=$total_num_pages)
										{
											echo "<li><a href='home.php?page={$next_slide}'><b>...</b></a></li>";
										}										
										if($next<=$total_num_pages)
										{
											echo "<li><a href='old_news.php?{$for_pagination}&page={$next}'>Next</a></li>";
										}
										echo "</ul>";
									}
								echo "</div>";
							echo "</div>";
						echo "</div>";
					}
					else
					{
						echo "<div class='alert alert-danger'>
							<h3>No news to be fetched :)</h3>
						</div>";
						//die("<h1>Page not found</h1>");
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