<?php
	session_start();
	if(!isset($_SESSION['token'])&&!isset($_SESSION['name'])){
		header('Location:login.php');
	}
?>
<?php
	$q=0;
	require 'connect.inc.php';
	$id=$_SESSION['token'];
	if(isset($_POST['currentcity'])){
    $currentcity=mysql_real_escape_string($_POST['currentcity']);
    $id=$_SESSION['token'];
    if(!empty($currentcity)){      
	  $sql="UPDATE profile SET currentcity='$currentcity' WHERE userid='$id'; ";
	  mysql_query($sql);
	  $q=1;
      }else{
		$sql="UPDATE profile SET currentcity='' WHERE userid='$id'; ";
		mysql_query($sql);
		$q=1;
	  }
    }
	if(isset($_POST['hometown'])){
    $hometown=mysql_real_escape_string($_POST['hometown']);
    if(!empty($hometown)){
      
		$sql="UPDATE profile SET hometown='$hometown' WHERE userid='$id'; ";
		mysql_query($sql);
		$q=1;
	}else{
		$sql="UPDATE profile SET hometown='' WHERE userid='$id'; ";
		mysql_query($sql);
		$q=1;
	}
    }
	if(isset($_POST['interest'])){
    $interest=mysql_real_escape_string($_POST['interest']);
    if(!empty($interest)){
		$sql="UPDATE profile SET interest='$interest' WHERE userid='$id'; ";
		mysql_query($sql);
      $q=1;
	  }
	  else{
		$sql="UPDATE profile SET interest='' WHERE userid='$id'; ";
		mysql_query($sql);
		$q=1;
	  
	  }
    }
	if(isset($_POST['about'])){
    $about=mysql_real_escape_string($_POST['about']);
    if(!empty($about)){
      
	  $sql="UPDATE profile SET about='$about' WHERE userid='$id'; ";
	  mysql_query($sql);
      $q=1;
	  }
	  else{
		$sql="UPDATE profile SET about='' WHERE userid='$id'; ";
	  mysql_query($sql);
      $q=1;
	  }
    }
	if($q==1){
	header('Location:index.php');
	}
?>

<?php
	$currentcity='';
	$hometown='';
	$interest='';
	$about='';
	$sql="SELECT * FROM profile WHERE userid='$id';";
	 if(mysql_num_rows($query_row=mysql_query($sql))==1){
        $result=mysql_fetch_assoc($query_row);
        $currentcity=$result['currentcity'];
		$hometown=$result['hometown'];
		$interest=$result['interest'];
		$about=$result['about'];
     }
?>

<form action="profile.php" method="POST" class="well form-horizontal">
	<fieldset>
    	<legend>Edit Profile</legend>
        <div class="control-group">
        <label class="control-label" for="input01">Current City</label>
        <div class="controls">
        <input type="text" class="input-xlarge" id="input01" name="currentcity" value="<?php echo $currentcity; ?>" />
        
        </div>
        </div>
        <div class="control-group">
        <label class="control-label" for="input02">Hometown</label>
 		<div class="controls">
        <input type="text" class="input-xlarge" id="input02" name="hometown" value="<?php echo $hometown; ?>">
        </div>
        </div>
        <div class="control-group">
        <label class="control-label" for="input03">Interests</label>
        <div class="controls">
        <input type="text" class="input-xlarge" id="input03" name="interest" value="<?php echo $interest; ?> ">
        </div>
        </div>
        <div class="control-group">
        <label class="control-label" for="input04">About Me</label>
        <div class="controls">
        <textarea class="input-xlarge" name="about"><?php echo $about; ?></textarea>
        </div>
        </div>
        
        <div class="form-actions">
        <input type="submit" class="btn btn-primary" />
        <button class="btn">Cancel</button>
        </div>
        </fieldset>
        </form>