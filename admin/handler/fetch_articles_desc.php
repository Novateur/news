<?php
	require_once('../../includes/db.inc');
	require_once('../../includes/functions.php');
	
	$sql_pag="SELECT COUNT(*) FROM articles";
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
	
	$sql = "SELECT * FROM articles ORDER BY id DESC LIMIT $start, $limit";
	$query = $connection->query($sql);

	if($query->rowCount()>0)
	{
		$query->setFetchMode(PDO::FETCH_ASSOC);
		echo "<form id='ma_multi_del'>";
			
				echo "<div class='col-md-1' style='margin-left:-15px'>
					<button id='mark_btn' type='button' class='btn btn-warning btn-sm' style='display:block' onclick=\"mark_all()\"><i class='glyphicon glyphicon-check'></i> Mark all</button>
					
				</div>
				<div class='col-md-1'>
					<button id='btn' type='button' class='btn btn-danger btn-sm' style='display:none' onclick=\"del_multi({$page})\"><i class='glyphicon glyphicon-trash'></i> Delete</button>			
				</div>
				<div class='col-md-1'>
					<button id='cancel' type='button' class='btn btn-default btn-sm' style='display:none' onclick=\"cancel_del()\"><i class='glyphicon glyphicon-notification'></i> Cancel</button>
				</div>
				<div class='col-md-9'>
				</div>";
			
		echo "<table class='table table-striped table-responsive'>
			<tr>
			<th><b>Title</b></th>
			<th><b>Content</b></th>
			<th><b>Date created</b></th>
			<th><b>Source</b></th>
			<th><b>Link</b></th>
			<th><b>Category</b></th>
			<th><b>Image</b></th>
			<th><b>Delete</b></th>
			<th><b>Edit</b></th>
			</tr>";
		foreach($query as $r)
		{
			echo "<tr>
			<td><input type='checkbox' name='articles[]' value='{$r['id']}' onclick=\"verify_check(this.name)\" class='articles'/> {$r['title']}</td>
			<td>".substr($r['content'],0,100)."...</td>
			<td>{$r['created_time']}</td>
			<td>{$r['source']}</td>
			<td>{$r['link']}</td>
			<td>{$r['category']}</td>
			<td>";if($r['image_link']!="")
				{
					echo "<img {$r['image_link']} width='100' height='100'</td>";
				}
			echo "<td>
			<button type='button' class='btn btn-success btn-sm' onclick=\"delete_art({$r['id']},{$page})\"><i class='glyphicon glyphicon-trash'></i></button></td>
			<td><button type='button' class='btn btn-default btn-sm' onclick=\"edit_article({$r['id']},{$page})\"><i class='glyphicon glyphicon-pencil'></i></button></td>
			</tr>";
		}
		echo "</table>";
		echo "</form>";
		
		echo"<div class='row'>";
			echo "<div class='col-sm-12'>";
				echo "<div align='center'id='paginate1'>";
					$previous=$page-1;
					$next=$page+1;
					$total_num_pages=ceil($totalpage1/$limit);
					if($total_num_pages>1)
					{
						if($previous>=1)
						{
							echo "<button type='button'class='btn btn-default btn-sm' onclick=\"paginate_desc({$previous})\">Previous</button> ";
						}
						for($i=1;$i<=$total_num_pages;$i++)
						{
							if($i==$page)
							{
								echo "<button type='button'class='btn btn-success btn-sm'>{$i}</button> ";
							}
							else
							{
								echo "<button type='button' class='btn btn-default btn-sm' onclick=\"paginate_desc({$i})\">{$i}</button> ";
							}
						}
						if($next<=$total_num_pages)
						{
							echo "<button type='button'class='btn btn-default btn-sm' onclick=\"paginate_desc({$next})\">Next</button>";
						}
					}
				echo "</div>";
			echo "</div>";
		echo "</div>";
	}
	else
	{
		echo "<div class='alert alert-danger'><h3>There is no article for this category</h3></div>";
	}
?>