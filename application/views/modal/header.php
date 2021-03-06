<?
	$get_user_info = $this->db->query("SELECT * FROM users where user_id = ".$user_id." ;");
	$name = $get_user_info->row()->name;
	$photo = $get_user_info->row()->s_pic;
	$home = "active";
	$profile = "";
	$recent = "";
	if($title == "Profile")
		{$title = $name;
			$home = "";
			$profile = "active";
		}
	else if($title == "Tag")
		{
		$get_tag_name = $this->db->query("SELECT tag FROM tag where tag_id = ".$tag_id." ;");
		$title = "#".$get_tag_name->row()->tag;
		$home = "";
		$tag = "active";
		}
	else if($title == "Recent Posts")
		{
			$home = "";
			$recent = "active";
		}
?>
<html xmlns="http://www.w3.org/1999/xhtml" dir="ltr" lang="en-US"
      xmlns:fb="https://www.facebook.com/2008/fbml">
<head>
    <meta charset="utf-8">
    <title><?=$title?> - Riklr</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="Express yourself Anonymously">
    <meta name="author" content="riklr">
	
    <!-- Le styles -->
    <link href="<?=site_url('bootstrap/css/bootstrap.css');?>" rel="stylesheet">
	
    <style>
      body {
        background: url('http://localhost/Secretags/images/dottedtexture5.jpg');
		background-repeat:repeat-y;
		background-size:100% 28px;
		background-attachment:fixed;
		background-position:centre;
      }
	  .selectpicker{
		
	  }
	  a {
		cursor:pointer;
		cursor:hand;
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

    <link href="<?=site_url('bootstrap/css/bootstrap.css');?>" rel="stylesheet">
	<link href="http://ajax.microsoft.com/ajax/jquery.ui/1.8.7/themes/black-tie/jquery-ui.css" rel="stylesheet">
	<link href="http://silviomoreto.github.com/bootstrap-select/stylesheets/bootstrap-select.css" rel="stylesheet">
	
    <!-- HTML5 shim, for IE6-8 support of HTML5 elements -->
    <!--[if lt IE 9]>
      <script src="../bootstrap/js/html5shiv.js"></script>
    <![endif]-->

    <!-- Fav and touch icons -->
    <link rel="shortcut icon" href="http://localhost/Secretags/images/fav.png">
   				   
	<script src="http://code.jquery.com/jquery-latest.js"></script>
	<script src="<?=site_url('bootstrap/js/jquery.autosize-min.js')?>"></script>
	<script src="http://cdnjs.cloudflare.com/ajax/libs/underscore.js/1.4.4/underscore-min.js"></script>
	<script src="http://ajax.aspnetcdn.com/ajax/jquery.ui/1.8.7/jquery-ui.min.js"></script>
	<script src="<?=site_url('js/tags_friends.js')?>"></script>
							   
	<script>$('.dropdown-toggle').dropdown();</script> 
	<script src="<?=site_url('bootstrap/js/bootstrap-select.min.js')?>"></script>
	
	<script>
var tags = new Array();
	$(document).ready(function() {
	
		var userid = <?=$user_id?>;
		$('.selectpicker').selectpicker();
		
		$('.selectpicker').zIndex(100);
		
		get_tags_friends(userid);
		$('textarea').autogrow();
		
	});
	// $(document).ajaxStart(function() {
		   // $( "#loading" ).show();
		 // });
		 // $(document).ajaxStop(function() {
			  // $( "#loading" ).hide();
		// });
	
	</script>
	<script>
  (function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
  (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
  m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
  })(window,document,'script','//www.google-analytics.com/analytics.js','ga');

  ga('create', 'UA-40042703-1', 'riklr.com');
  ga('send', 'pageview');

</script>
<style>
#label{border:1px solid red; width:auto;
display:none;
margin:0 auto;}

#post_rest{
	display:none;
}
.ui-menu {
	list-style:none;
	padding: 2px;
	
	display:block;
	border: 1;
}
.ui-menu .ui-menu {
	margin-top: -3px;
}
.ui-menu .ui-menu-item {
	
	padding: 0;
	zoom: 1;
	width: 100px;
	border: solid black 1px;
	z-index:1000;
	display:block;
}
.ui-menu .ui-menu-item a {
	text-decoration:none;
	display:block;
	padding:.2em .4em;
	line-height:1.5;
	zoom:1;
}
.ui-menu .ui-menu-item a.ui-state-hover,
.ui-menu .ui-menu-item a.ui-state-active {
	font-weight: normal;
	margin: -1px;
}
.comments{
	display:none;
}
</style>

  </head>
  
  <body>
	<div id="fb-root"></div>
	<script src="<?=site_url('js/fb.js')?>"></script>
	<div id="loading">
		<img src="http://localhost/Secretags/images/downloader.gif"/>
	</div>
<!--header-->
    <div class="navbar navbar-inverse navbar-fixed-top">
		<div class="navbar-inner">
			<div class="container" style="width:90%;">
				 
				  <a class="brand" href="<?=site_url('home')?>"> <img src="http://localhost/Secretags/images/logo.png" class="pull-left" width = "35px" ></a>
				  <a class="brand" href="<?=site_url('home')?>"><strong>Riklr</strong></a>
				  <div class="nav-collapse collapse">
					<ul class="nav">
						<li class="<?=$home?>"><a href="<?=site_url('home')?>">Home</a></li>
						<li class="<?=$recent?>"><a href="<?=site_url('home/recentposts')?>">Recent</a></li>
						<li class="<?=$profile?>"><a href="<?=site_url('home/profile/'.$user_id)?>">Profile</a></li>
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