<?php
session_start();
require_once("db.inc");

function sanitize($input)
{
	$my_input=htmlspecialchars(addslashes(trim($input)));
	return $my_input;
}
function sanitize_content($input)
{
	$my_input = strip_tags(addslashes(trim($input)));
	return $my_input;
}

function get_time_interval_sm($date){
	$mydate=date("j M Y, g:i a");
	$theDiff="";
	$datetime1 = date_create($date);
	$datetime2 = date_create($mydate);
	$interval = date_diff($datetime1, $datetime2);
	$min = $interval->format('%i');
	$sec = $interval->format('%s');
	$hour = $interval->format('%h');
	$mon = $interval->format('%m');
	$day = $interval->format('%d');
	$year = $interval->format('%y');
	if($interval->format('%i%h%d%m%y')=="00000"){
		if($sec<10){
			return "just now";
		}
		else{
			return $sec." seconds ago ";
		}
	}
	else if($interval->format('%h%d%m%y')=="0000"){
		if($min==1){
			return $min." minute ago";
		}
		else{
			return $min." minutes ago";
		}
	}
	else if($interval->format('%d%m%y')=="000"){
		if($hour==1){
			return $hour." hour ago";
		}
		else{
			return $hour." hours ago";
		}
	}
	else if($interval->format('%m%y')=="00"){
		if($day==1){
			return "Yesterday";
		}
		else if($day < 7){
			return $day." days ago";
		}
		else if($day==7){
			return "1 week ago";
		}
		else if($day < 14){
			$rem_day = $day-7;
			return "1 week ".$rem_day." days ago";
		}
		else if($day==14){
			return "2 weeks ago";
		}
		else if($day<21){
			$rem_day = $day-14;
			return "2 weeks ".$rem_day." days ago";
		}
		else if($day==21){
			return "3 weeks ago";
		}
		else{
			$rem_day = $day-21;
			return "3 weeks ".$rem_day." days ago";
		}
	}
	else if($interval->format('%y')=="0"){
		if($mon==1){
			return $mon." month ago";
		}
		else{
			return $mon." months ago";
		}
	}
	else{
		if($year==1){
			return $year." year";
		}
		else{
			return $year." years ago";
		}
	}
}

function get_latest_top_stories($cat)
{
	global $connection;
	$sql = "SELECT * FROM articles WHERE category='{$cat}' ORDER BY id DESC LIMIT 0,5";
	$query = $connection->query($sql);
	if($query->rowCount()>0)
	{
		echo "<ul>";
		$query->setFetchMode(PDO::FETCH_ASSOC);
		foreach($query as $r)
		{
			echo "<li><a href='read.php?readUrl={$r['link']}' onclick=\"alert('initializing hit counter for id {$r['id']}')\">{$r['title']}</a></li>";
		}
		echo "</ul>";
	}
}

function get_categories()
{
	global $connection;
	$sql = "SELECT * FROM category";
	$query = $connection->query($sql);
	if($query->rowCount() > 0)
	{
		$query->setFetchMode(PDO::FETCH_ASSOC);
		echo "<option value=''>Choose a category</option>";
		foreach($query as $r)
		{
			echo "<option value='{$r['category_name']}'>{$r['category_name']}</option>";
		}
	}
	else
	{
		echo "<option value=''>Choose a category</option>";
	}
}

function get_categories_home()
{
	global $connection;
	$sql = "SELECT * FROM category";
	$query = $connection->query($sql);
	if($query->rowCount() > 0)
	{
		$query->setFetchMode(PDO::FETCH_ASSOC);
		$array = array();
		foreach($query as $r)
		{
			$array[$r['id']] = $r['category_name'];
		}
		return $array;
	}
	else
	{
		echo "<h4>No category available</h4>";
	}
}

function get_categories_edit()
{
	global $connection;
	$sql = "SELECT * FROM category";
	$query = $connection->query($sql);
	if($query->rowCount() > 0)
	{
		$query->setFetchMode(PDO::FETCH_ASSOC);
		foreach($query as $r)
		{
			echo "<option value='{$r['category_name']}'>{$r['category_name']}</option>";
		}
	}
	else
	{
		echo "<option value=''>Choose a category</option>";
	}
}

function edit_category($cat_id)
{
	global $connection;
	$sql = "SELECT * FROM category WHERE id={$cat_id}";
	$query = $connection->query($sql);
	if($query->rowCount() > 0)
	{
		$query->setFetchMode(PDO::FETCH_ASSOC);
		foreach($query as $r)
		{
			echo "<input type='text' class='form-control' name='category' id='category' placeholder='category name' value='{$r['category_name']}'/><br/>
			<button type='submit' class='btn btn-default' name='add' id='add' style='border:1px solid #e68a00'>Add</button>";
		}
	}
	else
	{
		echo "<div class='alert alert-danger'>Category does not exist anymore</div>";
	}
}

function get_popular()
{
	global $connection;
	$sql = "SELECT * FROM articles ORDER BY counter DESC LIMIT 0,10";
	$query = $connection->query($sql);
	if($query->rowCount() > 0)
	{
		$query->setFetchMode(PDO::FETCH_ASSOC);
		foreach($query as $r)
		{
			echo "<li><a href='read.php?readUrl={$r['link']}' onclick=\"update_counter({$r['id']})\">{$r['title']}</a></li>";
		}
	}
	else
	{
		echo "<div class='alert alert-danger'>No popular article yet</div>";
	}
}

?>