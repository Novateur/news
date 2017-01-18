<?php

	require_once('../../includes/db.inc');
	require_once('../../includes/functions.php');
	
	$id = sanitize($_POST['id']);
	$category = sanitize($_POST['category']);
	$title = sanitize($_POST['title']);
	$url = sanitize($_POST['url']);
	$sql = "UPDATE source SET category='{$category}',url='{$url}',title='{$title}' WHERE id={$id}";
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