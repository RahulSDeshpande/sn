<?php
	session_start();
	if(isset($_SESSION['token'])){
		$userid=$_SESSION['token'];
		if(isset($_GET['text'])){
			$text=$_GET['text'];
			if(!empty($text)){
				require 'connect.inc.php';
				$sql="SELECT * FROM users WHERE firstname like '%$text%' or lastname like '%$text%' or email like '%$text%' or concat(firstname,' ',lastname) like '%$text%' or sex like '$text%';";
				$dom = new DOMDocument("1.0");
				$node = $dom->createElement("people");
				$parnode = $dom->appendChild($node);
				$result=mysql_query($sql);			
				header("Content-type: text/xml");
				
				// Iterate through the rows, adding XML nodes for each
				while ($row = @mysql_fetch_assoc($result)){
					$node = $dom->createElement("ppl");
					$newnode = $parnode->appendChild($node);
					$newnode->setAttribute("userid", $row['userid']);
					$newnode->setAttribute("firstname", $row['firstname']);
					$newnode->setAttribute("lastname", $row['lastname']);
					$newnode->setAttribute("email", $row['email']);
					$newnode->setAttribute("sex", $row['sex']);
					
					
					$fid=$row['userid'];
					$sql1="select * from friends where (friend1='$userid' and friend2='$fid') or (friend2='$userid' and friend1='$fid');";
					if(mysql_num_rows($result1=mysql_query($sql1))==1){
						$row1=mysql_fetch_assoc($result1);
						$newnode->setAttribute("status", $row1['status']);
					}else{
						$newnode->setAttribute("status", '0');
					}
					if($userid==$fid){
						$newnode->setAttribute("status", '2');
					}					
				}
				$sql="select * from groups where name like '%$text%';";
				$result=mysql_query($sql);
				while ($row = @mysql_fetch_assoc($result)){
					$node = $dom->createElement("grp");
					$newnode = $parnode->appendChild($node);
					$newnode->setAttribute("grpid", $row['grpid']);
					$grpid=$row['grpid'];
					$newnode->setAttribute("grpname", $row['name']);
					$sql1="select * from grpmem where grpid='$grpid' and memid='$userid';";
					$result1=mysql_query($sql1);
					$row1=mysql_fetch_assoc($result1);
					$newnode->setAttribute("status", $row1['status']);
				}
				echo $dom->saveXML();
			}
		}
	}
	
	
?>