<?php
	ob_start();
	require_once("../includes/db.inc");
	require_once("../includes/functions.php");
	
	$id = sanitize($_POST['id']);
	
	$sql = "SELECT counter FROM articles WHERE id={$id}";
	$query = $connection->query($sql);
	if($query->rowCount() > 0)
	{
		$query->setFetchMode(PDO::FETCH_ASSOC);
		foreach($query as $r)
		{
			$new_counter = $r['counter'];
			$new_counter = $new_counter+1;
			$sql = "UPDATE articles SET counter='{$new_counter}' WHERE id={$id}";
			$query = $connection->query($sql);
		}
		//echo $new_counter+1;
	}
?>