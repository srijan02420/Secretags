<?php
	if (isset($_GET['back']) ) {
		$back = $_GET['back'];
	}
	else
		$back = 0;
?>
<html xmlns="http://www.w3.org/1999/xhtml" dir="ltr" lang="en-US"
      xmlns:fb="https://www.facebook.com/2008/fbml">
<head>
    <meta charset="utf-8">
    <title>Riklr</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="Express yourself anonymously!">
	<meta property="og:image"  content="http://riklr.com/images/logo_big.png" />
	<head prefix="og: http://ogp.me/ns# fb: http://ogp.me/ns/fb# riklrapp: http://ogp.me/ns/fb/riklrapp#">
	  <meta property="fb:app_id" content="481439511903117" /> 
	  <meta property="og:type"   content="riklrapp:riklr" /> 
	  <meta property="og:url"    content="http://riklr.com" /> 
	  <meta property="og:title"  content="Riklr" /> 
    <!-- Le styles -->
    <link href="bootstrap/css/bootstrap.css" rel="stylesheet">
	
	<style>
      body {
        background: url('images/bg.jpg');
		background-repeat:no-repeat;
		background-attachment:fixed;
		background-position:centre;
		background-size:cover;
      }
	  .mask {
        background: rgba(0,0,0,0.6);
		background-repeat:no-repeat;
		background-attachment:fixed;
		background-position:centre;
		background-size:cover;
		margin-left:20%;
		margin-top:11%;
		width:60%;
		border:solid black 2px;
		box-shadow: 0px 0px 20px #171717;
		border-radius:10px;
		color:white;
      }
	  #post_conff{
		width:90%;
		margin-left:5%;
	  }
	  #post_rest, .comment_rest{
			/*display:none;*/
		}
	#uptext{
		font-size:20px;
		text-align:center;
	}
	#aboutus{
		text-align:center;
	}
	
	#post{
		font-size:13px;
		 margin:10px;
		 padding:0px;
		opacity:0.9;
		 color:black;
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
	h4 #big{
		font-size:24px;
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
	
    <!-- HTML5 shim, for IE6-8 support of HTML5 elements -->
    <!--[if lt IE 9]>
      <script src="../bootstrap/js/html5shiv.js"></script>
    <![endif]-->

    <!-- Fav and touch icons -->
	<link rel="shortcut icon" href="http://riklr.com/images/fav.png">
								   
	<script src="http://code.jquery.com/jquery-latest.js"></script>
	<script src="<?=site_url('bootstrap/js/bootstrap-select.min.js');?>"></script>
	<body>
		<div id="fb-root"></div>
		
		<script>
		  // Additional JS functions here
		  var id;
		  var back;
		  window.fbAsyncInit = function() {
			FB.init({
			  appId      : '481439511903117', // App ID
			  channelUrl : '//riklr.com/channel.html', // Channel File
			  status     : true, // check login status
			  cookie     : true, // enable cookies to allow the server to access the session
			  xfbml      : true  // parse XFBML
			});
			
						// Additional init code here
			FB.getLoginStatus(function(response) {
				if (response.status === 'connected') {
					// connected
					//self.location="home";
					back = <?=$back;?>;
					id = response.authResponse.userID;
					if(back == 0)
						self.location="http://riklr.com/session?id="+id;

				} else if (response.status === 'not_authorized') {
					// not_authorized
					//login();
				} else {
					// not_logged_in
					//login();
				}
			});
			// Additional init code here

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
				
				$( "#loading" ).show();
				//useriklr();
				FB.api('/me',{ fields: "email,location,picture,name,education,id,gender,work,friends" }, function(response) {
					console.log('Good to see you, ' + response.name + '.');
					//alert(response.age_range.min);?type=large?redirect=false
					//alert(response.name);
					
					senddata(response.name,response.email,response.gender,response.id,response.location.name,response.picture.data.url,response.friends.data,response.education);
					
					//

				
					//,response.name,response.email,response.gender,,response.education[0].school.name,response.picture
				});
				
			}
			function useriklr(){
				FB.api(
				  'me/riklrapp:use',
				  'post',
				  {
					demo: "http://riklr.com"
				  },
				  function(response) {
						console.log(response);
						if (!response || response.error) {
							alert(response.error.message);
						} else {
							alert('Demo was liked successfully! Action ID: ' + response.id);
						}
					  }
				);
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
			// var educ = edu[0].school.name+'';
			// for(a=1;a<edu.length;a++)
			// {
				// ed += ','+educ[a].school.name; 
			// }
			var fb=friends[0].id+'';
			for(a=1;a<friends.length;a++)
			{
				fb += ','+friends[a].id; 
			}
			//alert(name);
			$.post("http://riklr.com/signup/register", { name: name, email: email,gender: gender, id: id, location: location, pic: picture,friends: fb } )
			.done(function(data) {
				$( "#loading" ).hide();
				self.location="http://riklr.com/session?id="+id;
				//alert("Data Loaded: " + data);
			});
			
		}
		
</script>
	
	<div class="navbar navbar-inverse navbar-fixed-top">
		<div class="navbar-inner">
			<div class="container"style="width:90%;">
						  
				  <a class="brand" href="<?=site_url('home');?>"> <img src="<?=site_url('images/logo.png');?>" class="pull-left" width = "35px" ></a>
				  <a class="brand" href="<?=site_url('home');?>"><strong>Riklr</strong></a>
				 
				<ul class="nav pull-right">
					<li><a href="<?=site_url('how_it_works');?>">How it Works?</a></li>
				</ul>
				
			</div>
		</div>
    </div>

<div class="container-fluid" >
	<div class="mask" class="span12">
		<div  id="uptext">
			<h1 style="font-weight:normal;">Express yourself anonymously! #riklr</h1>
		</div>
		<div id="aboutus">
			<h3 style="font-weight:normal;">Confess, Propose ,Compliment or just open your heart out anonymously!</h3>
			<!--<p>Check out <span class="label label-inverse">How it Works</span> for more info.</p>-->
			<h4 style="font-weight:normal;">We don't store any user information along with the posts.<br/>
			Nobody can know who posts what!<strong id="big"> Not even us!</strong></h4>
			<p class="well" id="post">Use #tags while posting. Follow #tags and have fun. 
			<strong>#Awesome #riklr #Anonymous</strong>		
			</p>
			<img src="<?=site_url('images/fb_login_button.png');?>" onClick="login();" style="cursor:pointer; margin-bottom:20px;"/>
			<br/>
			<div class="fb-like" data-href="http://riklr.com" data-send="true" data-width="200" data-show-faces="true" style="text-align:center"></div>
			<br/><a href="http://riklr.com/terms" style="text-decoration:none">Terms Of Use </a> &#160;&#160;&#160;&#160;<a style="text-decoration:none" href="http://riklr.com/privacy"> Privacy Policy</a>
		</div>
		<br/>
	</div>
</div>
<div id="loading">
	<img src="<?=site_url('images/downloader.gif');?>"/>
</div>
    <!-- Le javascript
    ================================================== -->
    <!-- Placed at the end of the document so the pages load faster -->
    	<script src="<?=site_url('bootstrap/js/bootstrap.js');?>"></script>

  </body>
</html>

