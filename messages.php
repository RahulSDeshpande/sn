<h2>Messages</h2>
<?php
	session_start();
	require 'connect.inc.php';
	if(isset($_SESSION['token'])){
		$userid=$_SESSION['token'];
		if(!empty($userid)){
			if(isset($_GET['_uid'])){
				if(!empty($_GET['_uid'])){
					$uid=$_GET['_uid'];
					$sql="select * from messages where (userid='$userid' or userid='$uid') and (touserid='$userid' or touserid='$uid')order by time;";
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
					}}
					echo "</div>";
				}
			}
		}
	}
?>
<form class="well" method="POST">
<input type="text" id="_text" name="_text" /><br>
<input type="button" class="btn btn-primary" onclick="savemsg();" value="Send"/>
</form>