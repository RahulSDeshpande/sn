<?php
	session_start();
	require 'connect.inc.php';
	$userid=$_SESSION['token'];
	if(isset($_GET['_uid'])){
		if(!empty($_GET['_uid'])){
			$uid=$_GET['_uid'];
		}
	}else{
		$uid=$userid;
	}
	$sql="SELECT * FROM grpmem where memid='$uid';";
	$query_row=mysql_query($sql);
	while($result=mysql_fetch_assoc($query_row)){
		$grpid=$result['grpid'];
		$sql1="SELECT * FROM groups where grpid='$grpid';";
		$query_row1=mysql_query($sql1);
		$result1=mysql_fetch_assoc($query_row1);
		$name=$result1['name'];
		echo "<li><i class='icon-th'></i>$name</li>";
	}
?>