<?php
	session_start();
	if(!isset($_SESSION['token'])&&!isset($_SESSION['name'])){
		$userid=$_SESSION['token'];
		if(empty($_SESSION['token'])&&empty($_SESSION['name'])){
			header('Location:login.php');
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
		
		<!--Le styles -->
		<link href="bootstrap/css/bootstrap.css" rel="stylesheet">
		<link rel="shortcut icon" href="bootstrap/img/img-edit.jpg">
		<link href="bootstrap/css/bootstrap-responsive.css" rel="stylesheet">
			<style type="text/css">
			body {
				background:url("bootstrap/img/social-network.jpeg");
				background-attachment:fixed;
				padding-top: 40px;
				padding-bottom: 40px;
				opacity:0.9;
				
			}
			.login-top{
				margin-top:6px;
				margin-bottom:0px;
			}
			.sidebar-nav {
				padding: 9px 0;
			}
			.sideitem{
				cursor:pointer;
			}
			#page{
			height:700px;
			}

			
		</style>
	</head>
	<body onload="init();">
		<div class="navbar navbar-fixed-top">
			<div class="navbar-inner">
				<div class="container-fluid">
				<div class="nav-collapse pull-right">
				<ul class="nav">
					<li><a href="index.php">Back to Home</a></li>
					  
					  <li class="dropdown">
						<a href="#" class="dropdown-toggle" data-toggle="dropdown">Options <b class="caret"></b></a>
						<ul class="dropdown-menu">
							 <li><a href="logout.php">Log out</a></li>
						</ul>
					  </li>
					</ul>
				</div>
				<a class="brand" href="index.php">Social Network</a>
			  </div>
			</div>
		</div>
		<div id="page" style="background:white;">
    	<div class="container-fluid">
		<div class="row-fluid">
        <div class="span2">
		<div class="well sidebar-nav">
			<h3><?php 
					require "connect.inc.php";
					if(isset($_GET['id'])){
						if(!empty($_GET['id'])){
							$id=$_GET['id'];
							$sql="SELECT * FROM users where userid='$id';";
							$query_row=mysql_query($sql);
							$result=mysql_fetch_assoc($query_row);
							$fn=$result['firstname'];
							$ln=$result['lastname'];
							echo "$fn $ln";
						}
					}
				?>
			</h3>
				<?php
          		require'connect.inc.php';
          		$id=$_GET['id'];
 			     $sql="select * from users where userid='$id'";
      			if($query_row=mysql_query($sql)){
			        $result=mysql_fetch_assoc($query_row);
			        $sex=$result['sex'];
			        $pic=$result['pic'];
			        if($pic==''&&$sex=='male'){
			        	$a="male-user.jpg";
			        }else if($pic==''&&$sex=='female'){
			        	$a="female-user.jpg";
			        }else{
			        	$a=$pic;
			        }
			    }
				?>
			
				<img src="uploads/<?php echo $a;?>" width="100" height="150" style="border-radius:4px 4px 4px 4px;margin-left:10px;"/>
				<ul class="nav nav-list">
					<li class="nav-header sideitem">Joined Groups</li>
					<div id="left-sidebar">
					</div>
			</div>
		</div>
		<div class="span8">
        	<div id="main" style="background:white;">
				<div id="profile">
					<?php
						
						require "connect.inc.php";
						$userid=$_SESSION['token'];
						if(isset($_GET['id'])){
							if(!empty($_GET['id'])){
								$id=$_GET['id'];
								$sql="SELECT * FROM profile where userid='$id';";
								$query_row=mysql_query($sql);
								$result=mysql_fetch_assoc($query_row);
								$cc=$result['currentcity'];
								$ht=$result['hometown'];
								$it=$result['interest'];
								$ab=$result['about'];
					?>	
					<p class="well">
						<? if(!empty($cc)){?>
						Current City : <?php echo $cc;?>,<? } ?>
						<? if(!empty($ht)){?>
						Hometown : <?php echo $ht;?>,<? }?>
						<? if(!empty($it)){?>
						Interests : <?php echo $it;?> and<? }?>
						<? if(!empty($ab)){?>
						I am a <?php echo $ab;?>.<? }?>
					</p>
					<?php		
							}
						}
					?>
				</div>
				<div id="wall">
				
				</div>
        	</div>
		</div><!--/span-->
        <div class="span2">
			<div class="well sidebar-nav">
			<a class="btn" onclick="showmsg();">Messages</a>
            <ul class="nav nav-list">
				<li class="nav-header">Sharing Options</li>
				<li class='nav-header'>Friends</li>
				<div id="right-sidebar">
				</div>
            </ul>
          </div><!--/.well -->
        </div><!--/span-->
		</div>
		</div>
		</div>
    
	    <!-- Placed at the end of the document so the pages load faster -->
    <script src="bootstrap/js/jquery-1.7.2.min.js"></script>
	<script type="text/javascript">
    function createRequest()
    {
		try{
			request=new XMLHttpRequest();
        }catch(tryMS){
          
			try{
				request=new ActiveXObject("Msxml2.XMLHTTP");
			}catch(otherMS){
			try{
				request=new ActiveXObject("Microsoft.XMLHTTP");
			} catch(failed){
				request=null;
			}
          }
        }
        return request;
    }
	
	function getstrtime(d,h,m,s){
		d=Math.floor(parseInt(d));
		h=Math.floor(parseInt(h));
		m=Math.floor(parseInt(m));
		s=Math.floor(parseInt(s));
		//alert(d+" "+h+" "+m);
		if(d!=0&&h==0&&m!=0){
			str=d+" day "+m+" min "+s+" sec";
		}else if(d==0&&h==0&&m==0){
			str=s+" sec";
		}else if(d==0&&h==0){
			str=m+" min "+s+" sec";
		}else if(d==0){
			str=h+" hr "+m+" min "+s+" sec";
		}else{
			str=d+" day "+h+" hr "+m+" min "+s+" sec";		
		}
		return(str);
	}
	function getnews(){
		//popultatefriends();
		$('li').removeClass("active");
		  
		$('#newsitem').addClass("active");
		//$('#main').fadeOut(500);
		$('#main').empty();
		
		$.get("news.php",function(result){
			$('#main').html(result);
			xmlpopulate();
		});
	}
	function savepost(){
		a=document.getElementById("postbox").value;
		$.get("savepost.php?_p="+a+"&_uid="+<? echo $id;?>,function(result){
			populateposts(result);
		});
	}
	function xmlpopulate(){
		$.get("getposts.php?_uid="+<? echo $id;?>,function(result){
			populateposts(result);
		});
	}
function populateposts(xmlDoc){
	$("#_post").hide();
	$("#_post").empty();
	document.getElementById('postbox').value='';
	$(xmlDoc).find("post").each(function(){
	
		$('#_post').append("<div>");
		$('#_post').children().last().attr('id','post'+(this).getAttribute('post_id'));
		$('#_post').children().last().html("<div></div><div></div><div></div>");
		
		str=getstrtime((this).getAttribute('d1'),(this).getAttribute('h1'),(this).getAttribute('i1'),(this).getAttribute('s1'));
		pic=(this).getAttribute('pic');
		if(pic==''){
			$('#_post').children().last().children().first().html("<img src='bootstrap/img/male-user.jpg' class='pull-left' width='32px' /><p><strong>"+(this).getAttribute('firstname')+" "+(this).getAttribute('lastname')+" : </strong> "+(this).getAttribute('posttext')+"</p><br><a onclick='showcomment(this);' class='sideitem'>Comment</a> &bull; <span>"+str+" ago</span><br><br>");
			}else{
			$('#_post').children().last().children().first().html("<img src='uploads/"+pic+"' class='pull-left' width='32px' /><p><strong>"+(this).getAttribute('firstname')+" "+(this).getAttribute('lastname')+" : </strong> "+(this).getAttribute('posttext')+"</p><br><a onclick='showcomment(this);' class='sideitem'>Comment</a> &bull; <span>"+str+" ago</span><br><br>");
			}
		//$('#_post').children().last().children().first().html("<img src='bootstrap/img/male-user.jpg' class='pull-left' width='32px' /><p><strong>"+(this).getAttribute('firstname')+" "+(this).getAttribute('lastname')+" : </strong> "+(this).getAttribute('posttext')+"</p><br><a onclick='showcomment(this);' class='sideitem'>Comment</a> &bull; <span>"+str+" ago</span><br><br>");
		
		$('#_post').children().last().children().last().html("<form class='hidden commentform'><input class='span6' type='text' placeholder='Write a comment...' /><br><input class='btn' type='button' onclick='postcomment(this);' value='Post comment' /></form>");
		$('#_post').children().last().children().first().next().html("<ul class='offset1'></ul>");
		
		$(this).find('comment').each(function(){
			$('#_post').children().last().children().first().next().children().first().addClass('well');
			
			pic=(this).getAttribute('pic');
			if(pic==''){
			$('#_post').children().last().children().first().next().children().first().append("<li><div><img src='bootstrap/img/male-user.jpg' class='pull-left' width='32px' /><p><strong>"+(this).getAttribute('firstname')+" "+ (this).getAttribute('lastname')+" : </strong>"+(this).getAttribute('posttext')+"</p><br></div></li>");
			}else{
			$('#_post').children().last().children().first().next().children().first().append("<li><div><img src='uploads/"+pic+"' class='pull-left' width='32px' /><p><strong>"+(this).getAttribute('firstname')+" "+ (this).getAttribute('lastname')+" : </strong>"+(this).getAttribute('posttext')+"</p><br></div></li>");
			}
			
			$('#_post').children().last().children().first().next().children().first().children().last().attr('id','post'+(this).getAttribute('p_id'));
			a='#post'+(this).getAttribute('post_id');
			//$('#_post').children().last().children().first().next().children().first().children().last().append("");
		});
	});
	$("#_post").fadeIn(500);
		
	}
	function showcomment(a){
	$(document).ready(function(){
		$('.commentform').addClass('hidden');
		$(a).parent().next().next().children().first().removeClass('hidden');
		$(a).parent().next().next().children().first().children().first().focus();
	});
	}
	function postcomment(a){
		$(document).ready(function(){
		comment=$(a).parent().children().first().val();
		b=$(a).parent().parent().parent().attr('id');
		b=b.substr(4);
		
		$.get("savecomment.php?_t="+comment+"&_ref="+b,function(result){
			getnews();
		});
		});
	}
	
	function populatefriends(){
	$.get("getfriends.php?_uid="+<?php echo $id; ?>,function(result){
		$('#right-sidebar').html(result);
	});
	}
	function showmsg(){
		$.get("messages.php?_uid="+<?php echo $id;?>,function(result){
			$("#main").html(result);
		});
	}
	function savemsg(){
		a=document.getElementById("_text").value;
		$.get("savemsg.php?_t="+a+"&_uid="+<?php echo $id;?>,function(result){
			//alert(result);
			showmsg();
		});
	}

	function init(){
		getnews();
		populatefriends();
		$.get("grouplist.php?_uid="+<?php echo $id;?>,function(result){
			$("#left-sidebar").html(result);
		})
	}
	</script>
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