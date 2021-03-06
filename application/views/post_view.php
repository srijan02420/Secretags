<?php
$conff = $this->db->query("SELECT * FROM conff WHERE conff_id = $id ");
if($conff->num_rows()!=0)
{
$gender = $conff->row()->gender;
$type = $conff->row()->type;
$conffe = $conff->row()->conff;
		if($type == 1)
				$type = 'Confession';
		else if($type == 2)
				$type = 'Compliment';
		else if($type == 3)
				$type = 'Proposal';
		else
			$type = 'Secret Post';
}
else
	{
		$type = 'None';
		$gender = 0;
		$conffe = '';
	}
	
?>
<html xmlns="http://www.w3.org/1999/xhtml" dir="ltr" lang="en-US"
      xmlns:fb="https://www.facebook.com/2008/fbml">
<head>
    <meta charset="utf-8">
    <title>Secret Post - Riklr</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="Express yourself Anonymously">
    <meta name="author" content="riklr">
	  
	 <head prefix="og: http://ogp.me/ns# fb: http://ogp.me/ns/fb# riklrapp: http://ogp.me/ns/fb/riklrapp#">
  <meta property="fb:app_id" content="481439511903117" /> 
  <meta property="og:type"   content="riklrapp:post" /> 
  <meta property="og:url"    content="http://localhost/Secretags/secretpost/post/<?=$id?>" /> 
	  <meta property="og:title"  content="<?=$type?>" /> 
	  <meta property="og:image"  content="http://localhost/Secretags/images/<?=$gender?>.jpg" /> 
	  <meta property="og:description"  content="<?=$conffe?>" /> 
	<meta property="og:site_name" content="Secertags" />
	<meta property="fb:admins" content="100001010584091" />
	
    <!-- Le styles -->
	
    <style>
      body {
        background: url('http://localhost/Secretags/images/dottedtexture5.jpg');
		background-repeat:repeat-y;
		background-size:100% 28px;
		background-attachment:fixed;
		background-position:centre;
      }
	  a {
		cursor:pointer;
		cursor:hand;
	  }
    </style>
	<script>
  (function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
  (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
  m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
  })(window,document,'script','//www.google-analytics.com/analytics.js','ga');

  ga('create', 'UA-40042703-1', 'riklr.com');
  ga('send', 'pageview');

</script>
    <link href="<?=site_url('bootstrap/css/bootstrap.css');?>" rel="stylesheet">
	<link href="http://ajax.microsoft.com/ajax/jquery.ui/1.8.7/themes/black-tie/jquery-ui.css" rel="stylesheet">
	<link href="http://silviomoreto.github.com/bootstrap-select/stylesheets/bootstrap-select.css" rel="stylesheet">
	
    <!-- HTML5 shim, for IE6-8 support of HTML5 elements -->
    <!--[if lt IE 9]>
      <script src="../bootstrap/js/html5shiv.js"></script>
    <![endif]-->
								   
	<script src="http://code.jquery.com/jquery-latest.js"></script>
	<script src="http://ajax.aspnetcdn.com/ajax/jquery.ui/1.8.7/jquery-ui.min.js"></script>
	<script src="http://cdnjs.cloudflare.com/ajax/libs/underscore.js/1.4.4/underscore-min.js"></script>
	<script src="<?=site_url('js/tags_friends.js')?>"></script>
	<script src="<?=site_url('js/one_conff.js')?>"></script>
	<script src="<?=site_url('js/refresh_post_conff.js"')?>"></script>
	
	<script src="<?=site_url('js/trending_tags.js')?>"></script>
								   
	<script>$('.dropdown-toggle').dropdown();</script> 
	<script src="<?=site_url('bootstrap/js/bootstrap-select.min.js')?>"></script>
	<script>
		  // Additional JS functions here
		  var id;
		  window.fbAsyncInit = function() {
			FB.init({
			  appId      : '481439511903117', // App ID
			  channelUrl : '//riklr.com/channel.html', // Channel File
			  status     : true, // check login status
			  cookie     : true, // enable cookies to allow the server to access the session
			  xfbml      : true  // parse XFBML
			});

		  };

		  function login() {
				//alert("hello");
				FB.login(function(response) {
					if (response.authResponse) {
						// connected
										//alert("hello");
										testAPI();
					} else {
						// cancelled
					}
				} , {scope: 'email,user_likes,user_location,user_education_history,publish_actions'});
				
				
			}
			
			function testAPI() {
				$('#postlogin').modal('toggle');
				$( "#loading" ).show();
				
				FB.api('/me',{ fields: "email,location,picture,name,education,id,gender,work,friends" }, function(response) {
					console.log('Good to see you, ' + response.name + '.');
					
					senddata(response.name,response.email,response.gender,response.id,response.location.name,response.picture.data.url,response.friends.data,response.education);
					
				});
				
			}
		  
		  // Load the SDK Asynchronously
		  (function(d){
			 var js, id = 'facebook-jssdk', ref = d.getElementsByTagName('script')[0];
			 if (d.getElementById(id)) {return;}
			 js = d.createElement('script'); js.id = id; js.async = true;
			 js.src = "//connect.facebook.net/en_US/all.js";
			 ref.parentNode.insertBefore(js, ref);
		   }(document));
		</script>
		
		<script type="text/javascript">
		function senddata(name,email,gender,id,location,picture,friends,edu)
		{
			var a=0;
			var fb=friends[0].id+'';
			for(a=1;a<friends.length;a++)
			{
				fb += ','+friends[a].id; 
			}
			//alert(fb);
			$.post("http://localhost/Secretags/signup/register", { name: name, email: email,gender: gender, id: id, location: location, pic: picture,friends: fb } )
			.done(function(data) {
				$( "#loading" ).hide();
				self.location="http://localhost/Secretags/session?id="+id+"&url=http://localhost/Secretags/secretpost/post/<?=$id?>";
			});
			
		}
		
</script>
	<script>
var tags = new Array();
	var user_id,go;
	$(document).ready(function() {	
		var conff_id = <?=$id?>;
		user_id = <?=$user_id?>;
		go = <?=$go?>;
		//alert(go);
		if(user_id !=0)
			get_tags_friends(<?=$user_id?>);
			
		getonepost(conff_id,user_id,go);
		longPollpost(<?=$user_id?>,conff_id);
		trendingTags();
	});
	$.fn.doesExist = function(){
		return jQuery(this).length > 0;
		};
		
		$(document).keydown(function(e){
			if (e.keyCode == 37) {
				if (!$(".comment_box").is(':focus')) {
					window.location = "http://localhost/Secretags/secretpost/post/<?=$id-1?>?go="+0;
					}
			}
		});
		$(document).keydown(function(e){
			if (e.keyCode == 39) { 
				if (!$(".comment_box").is(':focus')) {
					window.location = "http://localhost/Secretags/secretpost/post/<?=$id+1?>?go="+1;
					}
			}
		});
		
		function tagp(tag_id){
			if(user_id == '0')
				$('#postlogin').modal();
			else
				window.location = "http://localhost/Secretags/tags/tag/"+tag_id;
		}
		
		function showCommp(conff_id){
			if(user_id == '0')
				$('#postlogin').modal();
		}
		
		function postToFeedp(a,b,c,d,e)
		{
			if(user_id == '0')
				$('#postlogin').modal();
			else
				postToFeed(a,b,c,d,e);
		}
		function likep(a,b)
		{
			if(user_id == '0')
				$('#postlogin').modal();
			else
				like(a,b);
		}
		function like_commentp(a,b,c)
		{
			if(user_id == '0')
				$('#postlogin').modal();
			else
				like_comment(a,b,c);
		}
				
	</script>
<style>
#label{border:1px solid red; width:auto;
display:none;
margin:0 auto;}

#post_rest{
	display:none;
}

#loading{
		display:none;
		width:100%;
		height:100%;
		background: rgba(0,0,0,0.6);
		position: absolute;
		left: 0px;
		top: 0px;
		}
	#loading img{
		position:absolute;
		left:50%;
		margin-left:-50px;
		top:50%;
		margin-top:-50px;
	}

</style>
<!-- Fav and touch icons -->
    <link rel="shortcut icon" href="http://localhost/Secretags/images/fav.png">
  </head>
  
  <body>
	<div id="fb-root"></div>
	<script src="<?=site_url('js/fb_post.js')?>"></script>
<!--header-->
	<div id="loading">
		<img src="http://localhost/Secretags/images/downloader.gif"/>
	</div>
    <div class="navbar navbar-inverse navbar-fixed-top">
		<div class="navbar-inner">
			<div class="container" style="width:90%;">
				 
				  <a class="brand" href="<?=site_url('home')?>"> <img src="http://localhost/Secretags/images/logo.png" class="pull-left" width = "35px" ></a>
				  <a class="brand" href="<?=site_url('home')?>"><strong>Riklr</strong></a>
				  <div class="nav-collapse collapse">
					<ul class="nav">
						<li><a href="<?=site_url('home')?>">Home</a></li>
						<li><a href="<?=site_url('home/recentposts')?>">Recent</a></li>
						<li><a href="<?=site_url('home/profile/'.$user_id)?>">Profile</a></li>
						<li><a href="<?=site_url('how_it_works')?>">How It Works</a></li>
					</ul>

				  </div><!--/.nav-collapse -->
			
				<ul class="nav pull-right">
					<li class="dropdown pull-right">
						<a href="#" class="dropdown-toggle pull-right" data-toggle="dropdown"><i class="icon-wrench icon-white"></i><b class="caret"></b></a>
						<ul class="dropdown-menu ">
							  <!--<li><a href="#">Action</a></li>
							  <li><a href="#">Another action</a></li>
							  <li><a href="#">Something else here</a></li>
							  <li class="divider"></li>
							  <li class="nav-header">Nav header</li>
							  <li><a href="#">Separated link</a></li>-->
							  <li><a href="#" onClick="logout();">Logout</a></li>
						</ul>
					</li>
				</ul>
				<form class="navbar-search pull-right ">
					<i class="icon-search icon-white  "></i>
					<input  class="search-query" data-provide="typeahead" placeholder="Search for tags, friends">
				</form>
			</div>
		</div>
    </div>


<!--header ends---->
<!--------------------------------------Sidebar--------------------------------->

<div class="container-fluid" >
	<div class="row-fluid" >
		<div class="span11 " style = " margin-left:4.16%; *zoom: 1; background : rgba(255,255,255,0.3); box-shadow: 0px 0px 20px #171717; "  >
		<!--------------------------------------Newsfeed--------------------------------->
		   	<div class="span9 "  style = " padding-left: 1.5%; padding-top:60px">
				<!--------------------------------------Post Confession------------------------------>
				<div  id="score_table" style = "background-color : #303033; width:100%; border-radius:2px; padding-top:0px;  box-shadow: 0px 0px 10px #171717;">	
							
				</div>
				
<!--------------------------------------post Confession ends------------------------------>

		    	<div id="all_posts" class="media-list">
					
				</div>
				<a href="http://localhost/Secretags/secretpost/post/<?=$id-1?>" class="pull-left"><i class="icon-chevron-left"></i><span class="label label-inverse">Back</span></a>
				<a href="http://localhost/Secretags/secretpost/post/<?=$id+1?>" class="pull-right"><span class="label label-inverse">Next</span><i class="icon-chevron-right"></i></a>
				<!--Posts content ends-->
			</div>
	
			<div class="span3 "  style = " padding-right: 1.5%; padding-top:60px;  " >
				<div class="well sidebar-nav " style = "box-shadow: 0px 0px 10px #171717; " >
					<div class="row-fluid"  >
						<ul class="inline">
							<li style = "color:#4E4E4E;">Popular Posts:</li></br>
							<div  id="pop_posts" >
							</div>
						</ul>			
					</div>
				</div>
	
				<div class="well sidebar-nav " style = "box-shadow: 0px 0px 10px #171717;"  >
					<div class="row-fluid"  >
						<ul class="inline" id="trending_tags">
							
						</ul>			
					</div>
				</div>
			</div>	<!--Sidebar content ends-->
		</div>
	</div>
</div>

<div id="postlogin" class="modal hide fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
								<div class="modal-header">
									<button type="button" class="close" data-dismiss="modal" aria-hidden="true">X</button>
									<h3 id="myModalLabel">Login First</h3>
								</div>
								<div class="modal-body">
									<img src="<?=site_url('images/fb_login_button.png');?>" onClick="login();" style="cursor:pointer;"/>
								</div>
								<!--<div class="modal-footer">
									<button class="btn" data-dismiss="modal" aria-hidden="true">Okay</button>
								</div>-->
							</div>

    <!-- Le javascript
    ================================================== -->
    <!-- Placed at the end of the document so the pages load faster -->
    	<script src="<?=site_url('bootstrap/js/bootstrap.js');?>"></script>

  </body>
</html>

