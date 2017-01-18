<?php

	require_once('../../includes/db.inc');
	require_once('../../includes/functions.php');
	
	$id = sanitize($_POST['id']);
	$page = sanitize($_POST['page']);
	$sql = "SELECT * FROM source WHERE id={$id}";
	$query = $connection->query($sql);
	if($query->rowCount() > 0)
	{
		$query->setFetchMode(PDO::FETCH_ASSOC);
		foreach($query as $r)
		{
			echo "<label>Source name<span>*</span></label><br/>
			<input type='text' class='form-control' name='title' id='title' value='{$r['title']}'/><br/>
			<label>Source link<span>*</span></label><br/>
			<input type='text' class='form-control' name='url' id='url' value='{$r['url']}'/><br/>
			<label>Source category<span>*</span></label><br/>
			<select id='category' name='category' class='form-control'>
				<option value='{$r['category']}'>{$r['category']}</option>";
				get_categories_edit();
				
			echo "</select><br/>
			<input type='hidden' class='form-control' name='id' id='id' placeholder='category id' value='{$r['id']}'/>
			<input type='hidden' class='form-control' name='page' id='page' placeholder='Current page' value='{$page}'/>";
		}
	}
	else
	{
		echo "<div class='alert alert-danger'>Source does not exist anymore</div>";
	}
?>