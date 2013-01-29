<?php
	session_start();
	if(isset($_SESSION['token']))
	{
		require 'connect.inc.php';
		$userid=$_SESSION['token'];
		//upload file if it is present
			if(isset($_FILES['img'])){
				$name=$_FILES['img']['name'];
				$size=$_FILES['img']['size'];
				$type=$_FILES['img']['type'];
				$tmp_name=$_FILES['img']['tmp_name'];
				$location="uploads/";
				$sql="update users set pic='$name' where userid='$userid';";
				mysql_query($sql);
				move_uploaded_file($tmp_name,$location.$name);
					header('Location:index.php');
			}
	}
?>
<div class="well">
<h2>Edit your Picture</h2>
<form method="POST" action="editpic.php" enctype="multipart/form-data">
<table>
<tr><td>Add image to library</td><td><input id="img" type="file" name="img"/></td></tr>
<tr><td>&nbsp;</td><td><input id="as" type="submit" value="Save" /></td></tr>
</table>
</form>
</div>