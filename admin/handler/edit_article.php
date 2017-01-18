<?php

	require_once('../../includes/db.inc');
	require_once('../../includes/functions.php');
	
	$id = sanitize($_POST['id']);
	$page = sanitize($_POST['page']);
	$sql = "SELECT * FROM articles WHERE id={$id}";
	$query = $connection->query($sql);
	if($query->rowCount() > 0)
	{
		$query->setFetchMode(PDO::FETCH_ASSOC);
		foreach($query as $r)
		{
			echo "<label>Title<span>*</span></label><br/>
			<input type='text' class='form-control' name='title' id='title' value='{$r['title']}'/><br/>
			<label>Content<span>*</span></label><br/>
			<textarea class='form-control' rows='10' name='content' id='content'>{$r['content']}</textarea>
			<input type='hidden' class='form-control' name='id' id='id' placeholder='category id' value='{$r['id']}'/>
			<input type='hidden' class='form-control' name='page' id='page' placeholder='Current page' value='{$page}'/>";
		}
	}
	else
	{
		echo "<div class='alert alert-danger'>Source does not exist anymore</div>";
	}
?>