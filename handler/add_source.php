<?php	
	
	require_once('../includes/db.inc');
	require_once('../includes/functions.php');
	
	$category = sanitize($_POST['category']);
	$title = sanitize($_POST['title']);
	$link = sanitize($_POST['link']);
	$created_time = date('Y-m-d h:i:s');
	
	$sql="INSERT INTO source(title,url,category,created_time) VALUES ('{$title}', '{$link}', '{$category}', '{$created_time}')";
	$query = $connection->query($sql);
	if($query)
	{
		echo "inserted";
	}
	else
	{
		echo "error";
	}
	
?>