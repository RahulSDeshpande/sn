<?php
	session_start();
	if(!isset($_SESSION['token'])||!isset($_SESSION['name'])){
		header("Location:login.php");
		if(empty($_SESSION['token'])||empty($_SESSION['name'])){
			header("Location:login.php");
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
			
		</style>
	<!-- Le HTML5 shim, for IE6-8 support of HTML5 elements -->
    <!--[if lt IE 9]>
      <script src="//html5shim.googlecode.com/svn/trunk/html5.js"></script>
    <![endif]-->
    <!-- Le fav and touch icons -->
    <!--<link rel="shortcut icon" href="images/favicon.ico">
    <link rel="apple-touch-icon" href="images/apple-touch-icon.png">
    <link rel="apple-touch-icon" sizes="72x72" href="images/apple-touch-icon-72x72.png">
    <link rel="apple-touch-icon" sizes="114x114" href="images/apple-touch-icon-114x114.png">-->
  </head>

<body onload="init();">

    <div class="navbar navbar-fixed-top">
      	<div class="navbar-inner">
       		<div class="container-fluid">
			<div class="nav-collapse pull-right">
            <ul class="nav">
                  
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
          	<?php
          		require'connect.inc.php';
          		$id=$_SESSION['token'];
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
            <h3 style="margin-left:10px"><?php echo $result['firstname'].' '.$result['lastname'];?></h3>
          	<img src="<?php echo 'uploads/'.$a ?>" width="100" height="150" style="border-radius:4px 4px 4px 4px;margin-left:10px;"/>
            <ul class="nav nav-list">
				<li><a class="sideitem" onclick="cropnsave(this);"> <i class="icon-picture"></i>Edit Picture</a></li>
				<li id="editprofile"><a class="sideitem" onclick="editp();"> <i class="icon-pencil"></i>Edit Profile</a></li>
				<li><a class="sideitem" href="gallery.php"> <i class="icon-camera"></i>Gallery</a></li>
				<li class="nav-header">Favourites</li>
				<li class="active" id="newsitem"><a class="sideitem" onclick="getnews();"> <i class="icon-list-alt"></i>News</a></li>
				<li id="showmymsg"><a class="sideitem" onclick="showmymsg();"><i class="icon-envelope"></i>Messages</a></li>
				<li id="showrequests"><a class="sideitem" onclick="showrequests();"> <i class="icon-envelope"></i>Friend Requests</a></li>
				<li id="searchitem" class=""><a onclick="searchppl();" class="sideitem"> <i class="icon-user"></i>Find People</a></li>
				<li class="nav-header">Groups</li>
				<div id="grpsection">
				
				</div>
				
				<li id="creategrp"><a class="sideitem" onclick="creategrp();"><i class='icon-plus'></i>Create Group</a></li>
				</ul>
          </div><!--/.well -->
        </div><!--/span-->
        <div class="span8">
        	<div id="main" style="background:white;">
            
        	</div>
		</div><!--/span-->
        <div class="span2">
          <div class="well sidebar-nav">
            <ul class="nav nav-list">
              <li class="nav-header">Sharing Options</li>
              <li><a href="#">Multi Group Post</a></li>
              <li class='nav-header'>Friends</li>
			  <div id="right-sidebar">
			  </div>
             </ul>
          </div><!--/.well -->
        </div><!--/span-->
      </div><!--/row-->

    </div>
    
    <div class="container-fluid">
      <hr>
      <footer>
        <p>&copy; Social Network 2012</p>
      </footer>
    </div><!--/.fluid-container-->
    
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
	function editp(){
		
		$('li').removeClass("active");
		$('#editprofile').addClass("active");
		
		$.get("profile.php",function(result){
			$('#main').html(result);
		});
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
	function xmlpopulate(){
	
		$.get("getposts.php",function(result){
			populateposts(result);
		});
		
	}
	var searchtext;
	function search(field){
	
	a=$(field).val();
	searchtext=a;
	$.get("searchresult.php?text="+a,function(result){
		populateppl(result);
	});
	}
	function savepost(){
		
		a=document.getElementById("postbox").value;
		$.get("savepost.php?_p="+a,function(result){
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
	function populateppl(xmlDoc)
	{
		$('#_res').empty();
		$(xmlDoc).find('ppl').each(function(){
			var status=(this).getAttribute('status');
			if(status=='1'||status=='2'){
			$('#_res').append("<li><div><img src='bootstrap/img/male-user.jpg' class='pull-left' width='50px' /><p><strong>"+(this).getAttribute('firstname')+" "+ (this).getAttribute('lastname')+"</strong><br>"+(this).getAttribute('email')+"<br>"+(this).getAttribute('sex')+"</p></div></li>");
			}else if(status=='2'){
			}
			else{
			$('#_res').append("<li><div class='pull-right'><span class='btn' onclick='addfriend(this)'>Add as friend</span></div><div><img src='bootstrap/img/male-user.jpg' class='pull-left' width='50px' /><p><strong>"+(this).getAttribute('firstname')+" "+ (this).getAttribute('lastname')+"</strong><br>"+(this).getAttribute('email')+"<br>"+(this).getAttribute('sex')+"</p></div></li>");
			$('#_res').children().last().children().first().children().first().attr('name','frd'+(this).getAttribute('userid'));
			
			}
		});
		$(xmlDoc).find('grp').each(function(){
			var status=(this).getAttribute('status');
			if(status=='1'){
			$('#_res').append("<li><div><img src='bootstrap/img/male-user.jpg' class='pull-left' width='50px' /><p><strong>"+(this).getAttribute('grpname')+"</strong><br>Group"+"<br><br></p></div></li>");
			}else{
			$('#_res').append("<li><div class='pull-right'><span class='btn' onclick=\'joingrp("+(this).getAttribute('grpid')+",this)\'>Join Group</span></div><div><img src='bootstrap/img/male-user.jpg' class='pull-left' width='50px' /><p><strong>"+(this).getAttribute('grpname')+"</strong><br>Group"+"<br><br></p></div></li>");
			
			}
		});
		//alert('Sorry,the search does not match!!');
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
	function searchppl(){
		$('li').removeClass("active");
		  
		$('#searchitem').addClass("active");
		$('#main').empty();
		$.get('searchppl.php',function(result){
			$('#main').html(result);
		});
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
	function creategrp(){
		
		$('li').removeClass("active");
		  
		$('#creategrp').addClass("active");
		//$('#main').empty();
		$.get('creategrp.php',function(result){
		$('#main').html(result);
		});
		
	}
	var grpid=0;
	function getgrp(a){
	
		$('li').removeClass("active");
		$(a).parent().addClass('active');
		$('#main').empty();
		b=$(a).attr('id');
		b=b.substr(3);
		grpid=b;
		xmlhttp=createRequest();
		if(xmlhttp==null)
		{
			document.getElementById("main").innerHTML="<p>unable to create request</p>";
		}
		else{
			
			xmlhttp.onreadystatechange=function()
			{
				if (xmlhttp.readyState==4 && xmlhttp.status==200)
				{
					document.getElementById("main").innerHTML=xmlhttp.responseText;
					$('#chkmultigrp').hide();
					id='#grp'+grpid;
					name='Group : '+$(id).attr('name');
					$('#leavegrp').attr('href','leavegrp.php?_grpid='+grpid);
					$('#multigrp').click(function(){
						$('#chkmultigrp').fadeIn(300);
						
					});
					$('#grpname').html(name);
					grpxmlpopulate();
				}
			}
			xmlhttp.open("GET",'groups.php?_grpid='+grpid,true);
			xmlhttp.send();
		}
	}
	function grpsavepost(){
	
	a=document.getElementById("postbox").value;
	var p=new Array();
	$("input:checked").each(function(id) { 
        myVar = $("input:checked").get(id); 
        p.push(myVar.value); 
    }); 
	//$.get("test.php", { 'choices[]': ["Jon", "Susan"]} );
	$.get("savegrppost.php?",{'_p':a,'_grpid':grpid,'_grp[]':p},function(result){
		//populateposts(result);
	});
	grpxmlpopulate();
	}
	function grpxmlpopulate(){
	
		$.get("getgroup.php?_grpid="+grpid,function(result){
		grppopulateposts(result);
		});
	}
	function grppopulateposts(xmlDoc){
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
			
			$('#_post').children().last().children().last().html("<form class='hidden commentform'><input class='span6' type='text' placeholder='Write a comment...' /><br><input class='btn' type='button' onclick='grppostcomment(this);' value='Post comment' /></form>");
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
	function grppostcomment(a){
		comment=$(a).parent().children().first().val();
		b=$(a).parent().parent().parent().attr('id');
		b=b.substr(4);
		$.get("savegrpcomment.php?_t="+comment+"&_ref="+b+"&_grpid="+grpid,function(result){
		grpxmlpopulate();
		});
	}
	function addfriend(a){
	$(a).parent().empty();
	var frdid=$(a).attr('name').substr(3);
	$.get('addfriend.php?frdid='+frdid);
	}
	function showrequests(){
		$('li').removeClass("active");
		$('#showrequests').addClass("active");
		$('#main').html('<h2>Friend Notifications</h2><div id="_req">');
		$.get("notifications.php",function(result){
			$('#_req').html(result);
			$('#_req').addClass('well');
		});
	}
	function replyreq(a,b){
	$(b).parent().parent().fadeOut(500);
	$.get("acceptreq.php?frdid="+a,function(result){});
	populatefriends();
	}	
	function rejectreq(a,b){
	$(b).parent().parent().fadeOut(500);
	$.get("rejectreq.php?frdid="+a,function(result){});
	
	}
	function joingrp(a,b){
		$(b).parent().fadeOut(500);
		$.get("joingrp.php?grpid="+a,function(result){
			grpsection();
		});
	}
	function cropnsave(a){
	$.get("editpic.php",function(result){
	$('#main').html(result);
	});
	}
	function populatefriends(){
	$.get("getfriends.php",function(result){
	$('#right-sidebar').html(result);
	});
	}
	function showmymsg(){
		$('li').removeClass("active");
		$('#showmymsg').addClass("active");
		$.get("showmymsg.php",function(result){
			$('#main').html(result);
	});
	}
	/*function geturl(a){
		$.get(a,function(result){
			$('#main').html(result);
	});
	}*/
	function creategrp1(){
		a=document.getElementById('input01').value;
		$.get("creategrp1.php?name="+a,function(result){
			getnews();
			grpsection();
	});
	}
	function grpsection(){
		$.get("grpsection.php",function(result){
			$('#grpsection').html(result);
		});
	}
	function init(){
		getnews();
		populatefriends();
		grpsection();
	}
	function showgallery(){
	}
	function doNothing() {}
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