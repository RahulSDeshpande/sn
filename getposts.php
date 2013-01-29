<?php
	session_start();
	require 'connect.inc.php';
	if(isset($_SESSION['token'])){
		$userid=$_SESSION['token'];
		
		$dom = new DOMDocument("1.0");
		$node = $dom->createElement("posts");
		$parnode = $dom->appendChild($node);
		if(isset($_GET['_uid'])){
		if(!empty($_GET['_uid'])){
			$uid=$_GET['_uid'];
		}
		}else{
			$uid=$userid;
		}
		$sql="SELECT * FROM posts where postfor='$uid' and ref='0' order by time desc";
		$result=mysql_query($sql);			
		//$row = @mysql_fetch_assoc($result);
			
		header("Content-type: text/xml");

		// Iterate through the rows, adding XML nodes for each
		while ($row = @mysql_fetch_assoc($result)){
		$node = $dom->createElement("post");
		$newnode = $parnode->appendChild($node);
		$newnode->setAttribute("post_id", $row['p_id']);
		$newnode->setAttribute("userid", $row['userid']);
		$a=$row['userid'];
		$sql1="select * from users where userid='$a';";
		$queryrow1=mysql_query($sql1);
		$result1=mysql_fetch_assoc($queryrow1);
		$firstname=$result1['firstname'];
		$lastname=$result1['lastname'];
		$pic=$result1['pic'];
		$newnode->setAttribute("posttext",$row['posttext']);
		$newnode->setAttribute("time",$row['time']);
		$newnode->setAttribute("firstname",$firstname);
		$newnode->setAttribute("lastname",$lastname);
		$newnode->setAttribute("pic",$pic);
		$newnode->setAttribute("ref",$row['ref']);
		$time=$row['time'];
		$d=date("d",$time);
		$m=date("m",$time);
		$y=date("Y",$time);
		$hr=date("H",$time);
		$min=date("i",$time);
		$sec=date("s",$time);
		$newnode->setAttribute("d",$d);
		$newnode->setAttribute("m",$m);
		$newnode->setAttribute("y",$y);
		$newnode->setAttribute("H",$hr);
		$newnode->setAttribute("i",$min);
		$newnode->setAttribute("s",$sec);
		
		$timenow=time();
		$timediff=$timenow-$time;
		
		$days = round(($timediff % 604800) / 86400, 2); 
		$hours = round((($timediff % 604800) % 86400) / 3600, 2); 
		$minutes = round(((($timediff % 604800) % 86400) % 3600) / 60, 2); 
		$seconds = round((((($timediff % 604800) % 86400) % 3600) % 60), 2);
		
		$newnode->setAttribute("d1",$days);
		$newnode->setAttribute("h1",$hours);
		$newnode->setAttribute("i1",$minutes);
		$newnode->setAttribute("s1",$seconds);
			
		$ref=$row['p_id'];
		$s="select * from posts where ref='$ref' order by time;";
		$r=mysql_query($s);
		while ($crow = @mysql_fetch_assoc($r)){
			$cnode = $dom->createElement("comment");
			$cnewnode = $newnode->appendChild($cnode);
			$cnewnode->setAttribute("p_id", $crow['p_id']);
			$cnewnode->setAttribute("userid", $crow['userid']);
			$cnewnode->setAttribute("posttext",$crow['posttext']);
			$cnewnode->setAttribute("time",$crow['time']);
			$a=$crow['userid'];
			$sql1="select * from users where userid='$a';";
			$queryrow1=mysql_query($sql1);
			$result1=mysql_fetch_assoc($queryrow1);
			$firstname=$result1['firstname'];
			$lastname=$result1['lastname'];
			$pic=$result1['pic'];
			$cnewnode->setAttribute("firstname",$firstname);
			$cnewnode->setAttribute("lastname",$lastname);
			$cnewnode->setAttribute("pic",$pic);
			$cnewnode->setAttribute("ref",$crow['ref']);
			$time=$crow['time'];
			$d=date("d",$time);
			$m=date("m",$time);
			$y=date("Y",$time);
			$hr=date("H",$time);
			$min=date("i",$time);
			$sec=date("s",$time);
			$cnewnode->setAttribute("d",$d);
			$cnewnode->setAttribute("m",$m);
			$cnewnode->setAttribute("y",$y);
			$cnewnode->setAttribute("H",$hr);
			$cnewnode->setAttribute("i",$min);
			$cnewnode->setAttribute("s",$sec);
			
			$timenow=time();
			$timediff=$timenow-$time;
			
			$days = round(($timediff % 604800) / 86400, 2); 
			$hours = round((($timediff % 604800) % 86400) / 3600, 2); 
			$minutes = round(((($timediff % 604800) % 86400) % 3600) / 60, 2); 
			$seconds = round((((($timediff % 604800) % 86400) % 3600) % 60), 2);
			
			$cnewnode->setAttribute("d1",$days);
			$cnewnode->setAttribute("h1",$hours);
			$cnewnode->setAttribute("i1",$minutes);
			$cnewnode->setAttribute("s1",$seconds);
					
			}
		}
		echo $dom->saveXML();
	}
?>