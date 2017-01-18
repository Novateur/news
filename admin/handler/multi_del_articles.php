<?php
	require_once('../../includes/db.inc');
	require_once('../../includes/functions.php');
	
	if(isset($_POST['articles']))
	{
		$articles=$_POST['articles'];
		array_map('sanitize',$articles);
		$articles=implode(',',$articles);
		
		$sql="DELETE FROM articles WHERE id IN ({$articles})";
		$query=$connection->query($sql);
		if($query)
		{
			echo "deleted";
		}
		else
		{
			echo "error";
		}
	}
	else
	{
		echo "Mark the articles you want to delete";
	}
?>