<h2>Messages</h2>
<?php
	session_start();
	require 'connect.inc.php';
	if(isset($_SESSION['token'])){
		$userid=$_SESSION['token'];
		if(!empty($userid)){
			$sql="select * from messages where touserid=$userid order by time;";
			if($result=mysql_query($sql)){
				echo "<div class='well'>";
				while($row=mysql_fetch_assoc($result)){
					$id=$row['userid'];
					$text=$row['mtext'];
					$sql1="select * from users where userid='$id';";
					$result1=mysql_query($sql1);
					$row1=mysql_fetch_assoc($result1);
					$name=$row1['firstname']." ".$row1['lastname'];
					echo "<b class='sideitem'><a href='users.php?id=$id'>$name</a></b> : $text<br>";
				}
				echo "</div>";
			}
		}
	}
?>