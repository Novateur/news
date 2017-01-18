<?php
	require_once('../../includes/db.inc');
	require_once('../../includes/functions.php');
	
	$id = $_POST['id'];
	
	$sql = "DELETE FROM source WHERE id={$id}";
	$query = $connection->query($sql);
	if($query)
	{
		echo "deleted";
	}
	else
	{
		echo "error";
	}
	
?>