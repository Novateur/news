<?php

	require_once('../../includes/db.inc');
	require_once('../../includes/functions.php');
	
	$id = sanitize($_POST['id']);
	$category = sanitize($_POST['category']);
	$sql = "UPDATE category SET category_name='{$category}' WHERE id={$id}";
	$query = $connection->query($sql);
	if($query)
	{
		echo "updated";
	}
	else
	{
		echo "error";
	}
	
?>