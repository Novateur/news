<?php
	try{
		$server = 'localhost';
		$dbname = 'nova_news';
		$username = 'root';
		$password = '';
		$connection = new PDO("mysql:host=$server;dbname=$dbname",$username,$password);
		$connection->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);
	}
	catch(PDOException $e){
		echo "Error:".$e->getMessage();
	}
?>