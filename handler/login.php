<?php
	ob_start();
	require_once("../includes/db.inc");
	require_once("../includes/functions.php");
	
	$email = $_POST['email'];
	$password = $_POST['password'];
	
	
	if($email=="news@novateur.ng" && $password=="novanews")
	{
		$_SESSION['username']=$email;
		echo "yes";
	}
	else
	{
		echo "no";
	}
?>