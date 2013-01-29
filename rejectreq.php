<?php
	require 'connect.inc.php';
	session_start();
	if(!isset($_SESSION['token'])&&!isset($_SESSION['name'])){
		if(empty($_SESSION['token'])&&empty($_SESSION['name'])){
			header('Location:login.php');
		}
	}
	
	$userid=$_SESSION['token'];
	$friend=$_GET['frdid'];
	
	$sql="delete from friends where((friend1='$friend' and friend2='$userid') or (friend1='$userid' and friend2='$friend'));";
	
	mysql_query($sql);
	
?>