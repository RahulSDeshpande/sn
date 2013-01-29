<?php
	session_start();
	if(isset($_SESSION['token'])){
		$userid=$_SESSION['token'];
		if(isset($_GET['_t'])&&isset($_GET['_ref'])){
			if(!empty($_GET['_t'])&&!empty($_GET['_ref'])){
				$p=$_GET['_t'];
				$ref=$_GET['_ref'];
				$time=time();
				require 'connect.inc.php';
				$sql="INSERT INTO `posts`(`userid`,`posttext`,`time`,`ref`) VALUES('$userid','$p','$time','$ref')";
				mysql_query($sql);
			}
		}	
	}
?>