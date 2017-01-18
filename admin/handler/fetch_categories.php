<?php
	require_once('../../includes/db.inc');
	require_once('../../includes/functions.php');
	
	$sql_pag="SELECT COUNT(*) FROM category";
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
		$start=($page-1) * $limit;
	}
	else
	{
		$start=0;
	}
	
	$sql = "SELECT * FROM category LIMIT $start, $limit";
	$query = $connection->query($sql);

	if($query->rowCount()>0)
	{
		$query->setFetchMode(PDO::FETCH_ASSOC);
		echo "<form id='ma_multi_del'>";
		echo "<table class='table table-striped table-responsive'>
			<tr>
			<th><b>Category</b></th>
			<th><b>Created_time</b></th>
			<th><b>Delete</b></th>
			<th><b>Edit</b></th>
			</tr>";
		foreach($query as $r)
		{
			echo "<tr>
			<td>{$r['category_name']}</td>
			<td>{$r['date_created']}</td>
			<td><button type='button' class='btn btn-success btn-sm' onclick=\"delete_cat({$r['id']},{$page})\"><i class='glyphicon glyphicon-trash'></i></button></td>
			<td><button type='button' class='btn btn-default btn-sm' onclick=\"edit_cat({$r['id']},{$page})\"><i class='glyphicon glyphicon-pencil'></i></button></td>
			</tr>";
		}
		echo "</table>";
		echo "</form>";
		
		echo"<div class='row'>";
			echo "<div class='col-sm-12'>";
				echo "<div align='right'id='paginate1'>";
					$previous=$page-1;
					$next=$page+1;
					$total_num_pages=ceil($totalpage1/$limit);
					if($total_num_pages>1)
					{
						if($previous>=1)
						{
							echo "<button type='button'class='btn btn-default btn-sm' onclick=\"paginate({$previous})\"><i class='glyphicon glyphicon-chevron-left'></i></button> ";
						}
						/*for($i=1;$i<=$total_num_pages;$i++)
						{
							if($i==$page)
							{
								echo "<button type='button'class='btn btn-success btn-sm'>{$i}</button> ";
							}
							else
							{
								echo "<button type='button' class='btn btn-default btn-sm' onclick=\"paginate({$i})\">{$i}</button> ";
							}
						}*/
						if($next<=$total_num_pages)
						{
							echo "<button type='button'class='btn btn-default btn-sm' onclick=\"paginate({$next})\"><i class='glyphicon glyphicon-chevron-right'></i></button>";
						}
					}
				echo "</div>";
			echo "</div>";
		echo "</div>";
	}
?>