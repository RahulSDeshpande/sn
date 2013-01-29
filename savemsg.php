<?php
	session_start();
	require 'connect.inc.php';
	if(isset($_SESSION['token'])){
		$userid=$_SESSION['token'];
		if(!empty($userid)){
			if(isset($_GET['_uid'])){
				if(!empty($_GET['_uid'])){
					$uid=$_GET['_uid'];
					if(isset($_GET['_t'])){
						if(!empty($_GET['_t'])){
							$t=$_GET['_t'];
							$time=time();
							$sql="insert into messages (userid,touserid,mtext,time) values('$userid','$uid','$t','$time');";
							mysql_query($sql);
						}
					}
				}
			}
		}
	}
	
?>