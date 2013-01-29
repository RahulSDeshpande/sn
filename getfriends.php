<?php
require 'connect.inc.php';
session_start();
	$userid=$_SESSION['token'];
	if(isset($_GET['_uid'])){
		if(!empty($_GET['_uid'])){
			$uid=$_GET['_uid'];
		}
	}else{
			$uid=$userid;
	}
	
	$sql="SELECT * FROM friends where (friend1='$uid' or friend2='$uid')and status='2';";
	$query_row=mysql_query($sql);
	while($result=mysql_fetch_assoc($query_row)){
		$fid1=$result['friend1'];
		$fid2=$result['friend2'];
		if($fid1==$uid){
		$fid=$fid2;
		}else{
		$fid=$fid1;
		}
		$sql1="SELECT * FROM users where userid='$fid';";
		$query_row1=mysql_query($sql1);
		$result1=mysql_fetch_assoc($query_row1);
		$name=$result1['firstname'].' '.$result1['lastname'];
	
		echo "<li><a class='sideitem' id='frd$fid' name='$name' href='users.php?id=$fid'> <i class='icon-th'></i>$name</a></li>";
	}
?>