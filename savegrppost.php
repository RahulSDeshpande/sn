<?php
	session_start();
	if(isset($_SESSION['token'])){
		$userid=$_SESSION['token'];
		if(isset($_GET['_p'])&&isset($_GET['_grpid'])){
			if(!empty($_GET['_p'])&&!empty($_GET['_grpid'])){
				$p=$_GET['_p'];
				$grpid=$_GET['_grpid'];
				$time=time();
				require 'connect.inc.php';
				$sql="INSERT INTO `grpposts`(`grpid`,`userid`,`posttext`,`time`) VALUES('$grpid','$userid','$p','$time')";
				mysql_query($sql);
				if(isset($_GET['_grp'])){
					if(!empty($_GET['_grp'])){
						$grp=$_GET['_grp'];
						foreach( $grp as  $value)  {
							$sql="INSERT INTO grpposts(grpid,userid,posttext,time) VALUES ('$value','$userid','$p','$time');";
							mysql_query($sql);
						}  
					}
				}
			}
		}
	}	
?>