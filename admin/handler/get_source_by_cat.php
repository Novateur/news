<?php

	require_once('../../includes/db.inc');
	require_once('../../includes/functions.php');

	$category = sanitize($_POST['category']);
	
	$sql = "SELECT * FROM source WHERE category='{$category}'";
	$query = $connection->query($sql);
	if($query->rowCount() > 0)
	{
		$query->setFetchMode(PDO::FETCH_ASSOC);
		echo "<option value=''>Choose a source</option>";
		foreach($query as $r)
		{
			echo "<option value='{$r['url']}'>{$r['title']}</option>";
		}
	}
	else
	{
		echo "<option value=''>Choose a source</option>";
	}
	
?>