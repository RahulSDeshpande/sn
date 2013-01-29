<?php
	require 'connect.inc.php';
	session_start();
	if(!isset($_SESSION['token'])&&!isset($_SESSION['name'])){
		if(empty($_SESSION['token'])&&empty($_SESSION['name'])){
			header('Location:login.php');
		}
	}
	else{
	$userid=$_SESSION['token'];
	$friend=$_GET['frdid'];
	$sql="insert into friends values ('$userid','$friend','1','$userid');";
	mysql_query($sql);
	}
?>