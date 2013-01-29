<?php
	session_start();
	if(isset($_SESSION['token'])){
		$userid=$_SESSION['token'];
		if(isset($_GET['_t'])&&isset($_GET['_ref'])&&isset($_GET['_grpid'])){
			if(!empty($_GET['_t'])&&!empty($_GET['_ref'])&&!empty($_GET['_grpid'])){
				$p=$_GET['_t'];
				$grpid=$_GET['_grpid'];
				$ref=$_GET['_ref'];
				$time=time();
				require 'connect.inc.php';
				$sql="INSERT INTO `grpposts`(`grpid`,`userid`,`posttext`,`time`,`ref`) VALUES('$grpid','$userid','$p','$time','$ref')";
				mysql_query($sql);
			}
		}	
	}
?>