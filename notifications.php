<?php
	require 'connect.inc.php';
	session_start();
	if(!isset($_SESSION['token'])&&!isset($_SESSION['name'])){
	$userid=$_SESSION['token'];
		if(empty($_SESSION['token'])&&empty($_SESSION['name'])){
			header('Location:login.php');
		}
	}

	$userid=$_SESSION['token'];
	$sql="select * from friends where (friend2='$userid' or friend1='$userid') and whosereq!='$userid' and status='1';";
	if($result=mysql_query($sql)){
		echo "<ul>";
	
		while($row=mysql_fetch_assoc($result)){
			$f1=$row['friend1'];
			$f2=$row['friend2'];
			if($f1==$userid){
				$f=$f2;
			}
			else
			{
				$f=$f1;
			}
			$sql1="select * from users where userid='$f';";
			$row1=mysql_fetch_assoc(mysql_query($sql1));
			$fname=$row1['firstname'];
			$lname=$row1['lastname'];
			$sex=$row1['sex'];
			echo "<li><div class='pull-right'><a class='btn' onclick='replyreq($f,this);'>Reply</a><a class='btn' onclick='rejectreq($f,this);'>Reject</a></div>$fname $lname has sent you a friend request.<br><br><br><br></li>";
		}
		echo "</ul>";
	}
?>