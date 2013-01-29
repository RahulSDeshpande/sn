<?php
	session_start();
	if(isset($_SESSION['token'])){
		$userid=$_SESSION['token'];
		if(isset($_GET['_grpid'])){
			if(!empty($_GET['_grpid'])){
				$grpid=$_GET['_grpid'];
				require 'connect.inc.php';
				$sql="delete from groups where grpid='$grpid' and admin='$userid';";
				mysql_query($sql);
				$sql="delete from grpmem where grpid='$grpid' and memid='$userid';";
				mysql_query($sql);
				$sql="delete from grpposts where grpid='$grpid' and userid='$userid' ";
				mysql_query($sql);				
				header('Location:index.php');
			}
		}	
	}
?>