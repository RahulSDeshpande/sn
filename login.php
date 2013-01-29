<?php
  session_start();
  if(isset($_POST['lemail']) && isset($_POST['lpass']))
  {
    $a=$_POST['lemail'];
    $b=$_POST['lpass'];
    $c=md5($b);
    if(!empty($a)&& !empty($b)){
      require'connect.inc.php';
      $sql="select * from users where email='$a' and password='$c'";
      if(mysql_num_rows($query_row=mysql_query($sql))==1){
        $result=mysql_fetch_assoc($query_row);
        $_SESSION['token']=$result['userid'];
        $_SESSION['name']=$result['firstname'];
        header("Location:index.php");
      }
    }
  }
  if(isset($_SESSION['token'])&&isset($_SESSION['name'])){
	header('Location:index.php');
  }

  //for registration
  if(isset($_POST['firstname'])&&isset($_POST['lastname'])&&isset($_POST['password'])&&isset($_POST['repassword'])&&isset($_POST['email'])&&isset($_POST['sex'])){
    $email=mysql_real_escape_string($_POST['email']);
    $firstname=mysql_real_escape_string($_POST['firstname']);
    $lastname=mysql_real_escape_string($_POST['lastname']);
    $password=mysql_real_escape_string($_POST['password']);
    $pass=md5($password);
    $repassword=mysql_real_escape_string($_POST['repassword']);
    $repass=md5($repassword);
    $sex=mysql_real_escape_string($_POST['sex']);
    
    if(!empty($firstname)&&!empty($lastname)&&!empty($password)&&!empty($email)&&!empty($sex)&&$pass==$repass){
      require 'connect.inc.php';
      $sql="INSERT INTO `users`(`firstname`,`lastname`,`password`,`email`,`sex`) VALUES('$firstname','$lastname','$pass','$email','$sex')";
	  
      if(mysql_query($sql)){
	  $sql1="SELECT userid from users where email='$email';";
		  if(mysql_num_rows($query_row=mysql_query($sql1))==1){
			$result=mysql_fetch_assoc($query_row);
			$id=$result['userid'];
			$sql2="INSERT INTO profile(userid) values ('$id')";
			mysql_query($sql2);
		  }
        
        header('Location:login.php');
        
      }else{
        echo "something went wrong";
        mysql_error();
      }
    }
  }

?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <title>Mitragan</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="This i my site description">
    <meta name="author" content="Ranix Das, Ravi Arya, Saurabh Anand">

    <!-- Le styles -->
    <link href="bootstrap/css/bootstrap.css" rel="stylesheet">
    <link href="bootstrap/css/bootstrap-responsive.css" rel="stylesheet">
    <style type="text/css">
      body {
        background:url("bootstrap/img/social-network.jpeg");
        padding-top: 60px;
        padding-bottom: 40px;
        opacity:0.9;
      }
      .login-top{
        margin-top:6px;
        margin-bottom:0px;
      }
      #login-form{
        margin-bottom:8px;
      }
      .sidebar-nav {
        padding: 9px 0;
      }
    </style>
  
    <link rel="shortcut icon" href="bootstrap/img/img-edit.jpg">
    <!-- Le HTML5 shim, for IE6-8 support of HTML5 elements -->
    <!--[if lt IE 9]>
      <script src="//html5shim.googlecode.com/svn/trunk/html5.js"></script>
    <![endif]-->

    <!-- Le fav and touch icons -->
    <!--<link rel="shortcut icon" href="images/favicon.ico">
    <link rel="apple-touch-icon" href="images/apple-touch-icon.png">
    <link rel="apple-touch-icon" sizes="72x72" href="images/apple-touch-icon-72x72.png">
    <link rel="apple-touch-icon" sizes="114x114" href="images/apple-touch-icon-114x114.png">-->
  <script type="text/javascript">
    function validateEmail(inputField,helpText)
    {
       if(!validateNonEmpty(inputField,helpText))
         return false;
       return validateRegEx(/^[\w\-_.\+]+@[\w-]+(\.\w{2,4})+$/,inputField.value,helpText,"Incorrect Email, please check again");
    }
    function validateRegEx(regex,inputstr,helpText,helpmsg)
    {
      if(!regex.test(inputstr))
      {
        if(helpText!=null)
          helpText.innerHTML=helpmsg;
        return false;
      }else{
        if(helpText!=null)
          helpText.innerHTML="";
        return true;
      }
    }

    function validateNonEmpty(inputField,helpText)
    {
      if(inputField.value.length==0){
        if(helpText!=null)
          helpText.innerHTML="Please enter a value";
        return false;
      }
      else{
        if(helpText!=null)
          helpText.innerHTML="";
        return true;
      }
    }

  </script>


  </head>

  <body>

    <div class="navbar navbar-fixed-top">
      <div class="navbar-inner">
        <div class="container-fluid">
          <div class="nav-collapse pull-right">
            <form action="login.php" method="POST" id="login-form">
            <input class="login-top" type="text" id="" placeholder="Email" name="lemail"/>
            <input class="login-top" type="password" id="" placeholder="Password" name="lpass"/>
            <input type="submit" class="btn btn-primary" value="Sign in" />
          </form>
          </div>
            <a class="brand" href="index.php">Social Network</a>
          </div>
        </div>
      </div>
    </div>

    <div class="container-fluid">
      <div class="span8 offset2">
          <h2>Register</h2>
		  <object classid="clsid:D27CDB6E-AE6D-11cf-96B8-444553540000" codebase="http://download.macromedia.com/pub/shockwave/cabs/flash/swflash.cab#version=8,0,0,0" width="468" height="60">
			<param name="movie" value="flashvortex.swf" />
			<param name="quality" value="best" />
			<param name="menu" value="true" />
			<param name="allowScriptAccess" value="sameDomain" />
			<embed src="flashvortex.swf" quality="best" menu="true" width="460" height="60" type="application/x-shockwave-flash" pluginspage="http://www.macromedia.com/go/getflashplayer" allowScriptAccess="sameDomain" />
			</object>
          <form action="login.php" method="POST" class="well form-horizontal">
          <fieldset>
            <legend>Not yet a member? Sign up</legend>
            <div class="control-group">
              <label class="control-label" for="input01">Email</label>
              <div class="controls">
                <input type="text" class="input-xlarge" id="input01" name="email" onblur="validateEmail(this,document.getElementById('email_help'));" />
                <span class="help-inline" id="email_help"></span>
              </div>
            </div>
            <div class="control-group">
              <label class="control-label" for="input02">Password</label>
              <div class="controls">
                <input type="password" class="input-xlarge" id="input02" name="password">
              </div>
            </div>
            <div class="control-group">
              <label class="control-label" for="input03">Re-enter Password</label>
              <div class="controls">
                <input type="password" class="input-xlarge" id="input03" name="repassword">
              </div>
            </div>
            <div class="control-group">
              <label class="control-label" for="input04">First Name</label>
              <div class="controls">
                <input type="text" class="input-xlarge" id="input04" name="firstname">
              </div>
            </div>
            <div class="control-group">
              <label class="control-label" for="input05">Last Name</label>
              <div class="controls">
                <input type="text" class="input-xlarge" id="input05" name="lastname">
              </div>
            </div>
            <div class="control-group">
              <label class="control-label" for="input06">Sex</label>
              <div class="controls">
                <select name="sex">
                  <option value="male">Male</option>
                  <option value="female">Female</option>
                </select>
              </div>
            </div>
            <!--
            <div class="control-group">
              <div class="controls">
                <label class="checkbox">
                <input type="checkbox" id="optionsCheckbox" value="option1">
                 Agree to our Terms and that you have read and understand our Data Use Policy.
                </label>
              </div>
            </div>-->
            <div class="form-actions">
              <button type="submit" class="btn btn-primary">Register</button>
              <button class="btn">Cancel</button>
            </div>
          </fieldset>
        </form>
      </div> 
    </div>
    <div class="container-fluid">
      <hr>
      <footer>
        <p>&copy; Social Network 2012</p>
      </footer>
    </div><!--/.fluid-container-->
    
    <script src="bootstrap/js/jquery.min.js"></script>
    <script src="bootstrap/js/bootstrap-alert.js"></script>
    <script src="bootstrap/js/bootstrap-modal.js"></script>
    <script src="bootstrap/js/bootstrap-dropdown.js"></script>
    <script src="bootstrap/js/bootstrap-scrollspy.js"></script>
    <script src="bootstrap/js/bootstrap-tab.js"></script>
    <script src="bootstrap/js/bootstrap-tooltip.js"></script>
    <script src="bootstrap/js/bootstrap-popover.js"></script>
    <script src="bootstrap/js/bootstrap-button.js"></script>
    <script src="bootstrap/js/bootstrap-collapse.js"></script>
    <script src="bootstrap/js/bootstrap-carousel.js"></script>
    <script src="bootstrap/js/bootstrap-typeahead.js"></script>

  </body>
</html>
