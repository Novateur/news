<?php

	require_once('../../includes/db.inc');
	require_once('../../includes/functions.php');
	
	$id = sanitize($_POST['id']);
	$content = sanitize($_POST['content']);
	$title = sanitize($_POST['title']);

	$sql = "UPDATE articles SET title='{$title}',content='{$content}' WHERE id={$id}";
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