<div>
<form class="well">
<h2 id="grpname"></h2>

<a class="pull-right btn" id="leavegrp">Leave Group</a>
<a class="pull-right btn" id="multigrp">Enable Multi Group Posting</a>
<h4>Write Post</h4>
<textarea class="span6" id="postbox"></textarea>
<br>
<div class="control-group" id="chkmultigrp">
<label class="control-label" for="inlineCheckboxes">Also post in :</label>
	<div class="controls">
		<form method="GET" action="groups.php">
		<!--<label class="checkbox inline">
			<input type="checkbox" id="inlineCheckbox1" value="option1"> 1
		</label>
		<label class="checkbox inline">
			<input type="checkbox" id="inlineCheckbox2" value="option2"> 2
		</label>
		<label class="checkbox inline">
			<input type="checkbox" id="inlineCheckbox3" value="option3"> 3
		</label>-->
	
<?php
	session_start();
	require 'connect.inc.php';
	if(isset($_SESSION['token'])){
		if(!empty($_SESSION['token'])){
			$userid=$_SESSION['token'];
			if(isset($_GET['_grpid'])){
				if(!empty($_GET['_grpid'])){
					$grpid=$_GET['_grpid'];
					$sql="SELECT * FROM grpmem WHERE grpid<>'$grpid' and memid=$userid;";
					$result=mysql_query($sql);
					while($row=mysql_fetch_assoc($result)){
						//$name=$row['name'];
						$id=$row['grpid'];
						$sql1="select * from groups where grpid='$id'";
						$result1=mysql_query($sql1);
						$row1=mysql_fetch_assoc($result1);
						$name=$row1['name'];
						echo "<label class='checkbox inline'><input type='checkbox' name='groups[]' id='inlineCheckbox$id' value='$id'>$name</label>";
						
					}
				}
			}
		}
	}
	
?>
	</div>
</div>
<input class="btn btn-primary" type="button" value="Share" onclick="grpsavepost();" />
</form>
</div>
<div id="_post">
</div>