<?php
	require_once('../../includes/db.inc');
	require_once('../../includes/functions.php');
	
	$category = $_POST['category'];
	
	$cat_array = explode(",",$category);
	
	foreach ($cat_array as $cat)
	{
		$created_time = date('Y-m-d h:i:s');
		$sql="INSERT INTO category (category_name,date_created) VALUES ('{$cat}','{$created_time}')";
		$query = $connection->query($sql);
	}
	echo "added";
?>