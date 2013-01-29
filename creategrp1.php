<?php
	session_start();
	if(isset($_SESSION['token'])){
		$userid=$_SESSION['token'];
		if(isset($_GET['name'])){
			$name=$_GET['name'];
			if(!empty($name)){
				require 'connect.inc.php';
				$time=time();
				$sql="INSERT INTO groups(time,admin,name)VALUES('$time','$userid','$name');";
				mysql_query($sql);
				$sql="SELECT * FROM groups where time='$time' and admin='$userid';";
				$query_row=mysql_query($sql);
				$result=mysql_fetch_assoc($query_row);
				$grpid=$result['grpid'];
				$sql="INSERT INTO grpmem(grpid,memid,status)VALUES('$grpid','$userid','1');";
				mysql_query($sql);
				//header('Location:index.php');
			}
		}
	}	
?>