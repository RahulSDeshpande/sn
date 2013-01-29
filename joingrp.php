<?php
	require 'connect.inc.php';
	session_start();
	if(!isset($_SESSION['token'])&&!isset($_SESSION['name'])){
		if(empty($_SESSION['token'])&&empty($_SESSION['name'])){
			header('Location:login.php');
		}
	}
	
	$userid=$_SESSION['token'];
	$grpid=$_GET['grpid'];
	$sql="select * from grpmem where grpid='$grpid' and memid='$userid';";
	$result=mysql_query($sql);
	if(mysql_num_rows($result)==0){
	$sql="insert into grpmem values ('$grpid','$userid','1');";
	mysql_query($sql);
	}
	
?>