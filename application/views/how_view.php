<html xmlns="http://www.w3.org/1999/xhtml" dir="ltr" lang="en-US"
      xmlns:fb="https://www.facebook.com/2008/fbml">
<head>
    <meta charset="utf-8">
    <title>How it works - Riklr</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="Express yourself anonymously!">

    <!-- Le styles -->
    <link href="bootstrap/css/bootstrap.css" rel="stylesheet">
	<!-- Fav and touch icons -->
	<link rel="shortcut icon" href="http://localhost/Secretags/images/fav.png">
	
	<style>
      body {
        padding-top: 0px; /* 60px to make the container go all the way to the bottom of the topbar */
        background: url('http://localhost/Secretags/images/dottedtexture5.jpg');
		background-repeat:repeat-y;
		background-size:100% 28px;
		background-attachment:fixed;
		background-position:centre;
      }

      #posts{
      	 min-height:800px; 
      	 height:auto !important; 
      	 *zoom: 1; 
      	 background : rgba(255,255,255,0.7); 
      	 box-shadow: 0px 0px 20px #171717; 
      	 padding-top:60px;
      }

      #img1_post{
      	 border-radius : 6px; 
      	 position:absolute; 
      	 left:140px; 
      	 top:80px; 
      	 box-shadow: 0px 0px 15px #171717; 
      }

      #img2_post{
      	border-radius : 6px;
      	position:absolute; 
      	left:245px; 
      	top:85px; 
      	box-shadow: 0px 0px 15px #171717;
      }

      #img3_post{
      	 border-radius : 6px; 
      	 position:absolute; 
      	 left:330px; 
      	 top:90px; 
      	 box-shadow: 0px 0px 15px #171717; 
      }

      #img4_post{
		position:absolute; 
		left:460px; 
		top:70px;
      }

      #img5_post{
		position:absolute; 
		left:460px; 
		top:105px;
      }
      
      #img6_post{
		position:absolute; 
		left:460px; 
		top:140px;
      }

      #img7_post{
      	position:absolute; 
      	left:460px; 
      	top:175px;
      }

      #head_left{
      	font-size:small; 
      	position:absolute; 
      	left:540px; 
      }

      #head_right{
      	text-align:right; 
      	font-size:small; 
      	position:absolute; 
      	right:630px;
      }

      #para_post{
      	font-size:small; 
      	position:absolute; 
      	top:110px; 
      	left:540px; 
      	right:130px;
      }

      #para_write{
      	text-align:right; 
      	font-size:small; 
      	position:absolute; 
      	top:280px; 
      	left:140px; 
      	right:630px;
      }

      #divider1{
      	width:100%; 
      	padding-left: 0px;
      	padding-top: 120px;
      }
      #divider2{
      	width:100%; 
      	padding-left: 0px;      	
      }

      #img1_write{
      	 border-radius : 6px; 
      	 position:absolute; 
      	 right:440px; 
      	 top:260px; 
      	 box-shadow: 0px 0px 15px #171717;
      }

      #img2_write{
      	border-radius : 6px; 
      	position:absolute; 
      	right:300px; 
      	top:255px; 
      	box-shadow: 0px 0px 15px #171717;
      }

      #img3_write{
      	border-radius : 6px; 
      	position:absolute; 
      	right:140px; 
      	top:250px; 
      	box-shadow: 0px 0px 15px #171717;
      }

      #para_like{
      	font-size:small; 
      	position:absolute; 
      	top:450px; 
      	left:540px; 
      	right:130px;
      }

      #img1_like{
      	 border-radius : 6px;
      	 position:absolute; 
      	 left:140px; 
      	 top:420px; 
      	 box-shadow: 0px 0px 15px #171717;
      }

      #img2_like{
      	 border-radius : 6px; 
      	 position:absolute; 
      	 left:265px; 
      	 top:425px; 
      	 box-shadow: 0px 0px 15px #171717;
      }

      #para_comment{
      	text-align:right; 
      	font-size:small; 
      	position:absolute; 
      	top:620px; 
      	right:630px; 
      	left:140px;
      }

      #img1_comment{
      	  border-radius : 6px; 
      	  position:absolute; 
      	  right:300px; 
      	  top:590px; 
      	  box-shadow: 0px 0px 15px #171717;
      }

      #img2_comment{
      	border-radius : 6px; 
      	position:absolute; 
      	right:140px; 
      	top:585px; 
      	box-shadow: 0px 0px 15px #171717;
      }

      #para_profile{
      	font-size:small; 
      	position:absolute; 
      	top:790px; 
      	left:540px; 
      	right:130px;
      }

      #img1_profile{
      	border-radius : 6px; 
      	position:absolute; 
      	left:140px; 
      	top:755px; 
      	box-shadow: 0px 0px 15px #171717;
      }

      #para_tag{
      	text-align:right; 
      	font-size:small; 
      	position:absolute; 
      	top:960px; 
      	right:630px; 
      	left:140px;
      }

      #img1_tag{
      	 border-radius : 6px; 
      	 position:absolute; 
      	 right:400px; 
      	 top:925px; 
      	 box-shadow: 0px 0px 15px #171717;
      }

      #img2_tag{
      	border-radius : 6px; 
      	position:absolute; 
      	right:280px; 
      	top:920px; 
      	box-shadow: 0px 0px 15px #171717;
      }

      #img3_tag{
      	 border-radius : 6px; 
      	 position:absolute; 
      	 right:140px; 
      	 top:915px; 
      	 box-shadow: 0px 0px 15px #171717;
      }

      #para_score{
      	font-size:small; 
      	position:absolute; 
      	top:1130px; 
      	left:540px; 
      	right:130px;
      }

      #img1_score{
      	border-radius : 6px; 
      	position:absolute; 
      	left:140px; 
      	top:1100px; 
      	box-shadow: 0px 0px 15px #171717;
      }

      #img2_score{
      	border-radius : 6px; 
      	position:absolute; 
      	left:370px; 
      	top:1105px; 
      	box-shadow: 0px 0px 15px #171717;
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
								   
	<script src="http://code.jquery.com/jquery-latest.js"></script>
	<script src="<?=site_url('bootstrap/js/bootstrap-select.min.js');?>"></script>
	<body>
	
	<div class="navbar navbar-inverse navbar-fixed-top">
		<div class="navbar-inner">
			<div class="container"style="width:90%;">
						  
				  <a class="brand" href="<?=site_url('home');?>"> <img src="<?=site_url('images/logo.png');?>" class="pull-left" width = "35px" ></a>
				  <a class="brand" href="<?=site_url('home');?>"><strong>Riklr</strong></a>
				  <ul class="nav">
					<li><a href="<?=site_url('home');?>">Home</a></li>
				  </ul>
				<ul class="nav pull-right">
					<li class="active"><a href="<?=site_url('how_it_works');?>">How it Works?</a></li>
				</ul>
				
			</div>
		</div>
    </div>

	<div class="container-fluid"  >
	<div class="row-fluid" >


		
		<div id = "posts" class="span12 " >

			<div class="container-fluid">
				<!-- <div style = "  text-align:center;">
					<strong style = "font-size:large; box-shadow: 0px 0px 5px #171717;"> &nbsp Post Anonymously &nbsp</strong>
				</div> -->
				
				<div class="span5 row-fluid" >	
					
						
						<img id = "img1_post" src="<?=site_url('images/mask_male.png')?>" >
						<img id = "img2_post" src="<?=site_url('images/mask_female.png')?>">
						<img id = "img3_post" src="<?=site_url('images/mask_other.png')?>">

						<img id = "img4_post" src="<?=site_url('images/lips.png')?>" >
						<img id = "img5_post" src="<?=site_url('images/heart.png')?>">
						<img id = "img6_post" src="<?=site_url('images/compliment.png')?>">
						<img id = "img7_post" src="<?=site_url('images/other.png')?>" >
					
				</div>
				<div class="span4 row-fluid" >
					<h3 id = "head_left" ><em>Posts</em></h3>
					<p3 id = "para_post" ><em>These are what you see in the <strong>Home</strong>, and <strong>Recent</strong> tabs. The thumbnails represent the gender and the small icons represent the type of the post. </em></p3>
				</div> 
			</div>


			<ul id = "divider1" class="nav nav-list " ><!----Divider------------------>
	   
	    		<li class="divider" ></li>
		    
			</ul>



			<div class="container-fluid" >
				
				<div class="span5 row-fluid" >	
											
						<img id = "img1_write" src="<?=site_url('images/post1.PNG')?>">						
						<img id = "img2_write" src="<?=site_url('images/post2.PNG')?>" >
						<img id = "img3_write" src="<?=site_url('images/post3.PNG')?>" >
				</div>
				<div class="span4 row-fluid" >
					<h3 id = "head_right" ><em>Writing Posts</em></h3>
					<p3 id = "para_write"><em>Write your anonymous post in the text-box in the home tab, don't forget to add <strong>#tags</strong> while writing. Select the type of confession, and gender before posting.
						No one can ever know who writes this post, not even us!<br/>
						<strong>*We don't store any user identity along with his/her posts,
						making it completely safe to post a confession/proposal or a compliment.</strong>
					</em></p3>
				</div> 
			</div>
			</br></br></br></br></br></br>
			<ul id = "divider2" class="nav nav-list "  ><!----Divider------------------>
	   
	    		<li class="divider" ></li>
		    
			</ul>



			<div class="container-fluid">
				<div class="span4 row-fluid " >
					<h3 id = "head_left"><em>Like and Share</em></h3>
					<p3 id = "para_like"><em>Love something you read? Like it.</br> Feel like your friends should see this too? Share it directly on Facebook.</em></p3>

				</div>

				<div class="span5 row-fluid"  >	
					
						
						<img id = "img1_like" src="<?=site_url('images/like.PNG')?>">
						<img id = "img2_like" src="<?=site_url('images/share.png')?>">
						
				</div>
				 
			</div>
			</br></br></br></br></br></br>
			<ul id = "divider2" class="nav nav-list "  ><!----Divider------------------>
	   
	    		<li class="divider" ></li>
		    
			</ul>

			<div class="container-fluid">
				<div class="span4 row-fluid " >
					<h3 id = "head_right" ><em>Comments</em></h3>
					<p3 id = "para_comment"><em>Read comments, like them, and comment yourself. You have the flexibility to choose your identity, if you choose an anon identity, your true identity can never be known.</em></p3>

				</div>

				<div class="span5 row-fluid" >	
					
						
						<img id = "img1_comment" src="<?=site_url('images/comment.png')?>">						
						<img id = "img2_comment" src="<?=site_url('images/commentlike.png')?>" >
						
				</div>
				 
			</div>
			</br></br></br></br></br></br>
			<ul id = "divider2" class="nav nav-list "  ><!----Divider------------------>
	   
	    		<li class="divider" ></li>
		    
			</ul>



			<div class="container-fluid" >
				<div class="span4 row-fluid " >
					<h3 id = "head_left" ><em>Profile</em></h3>
					<p3 id = "para_profile"><em>Shows all the posts you liked, or you commented on with 'Self' as an identity. You can also see your score on top, and score distribution.</em></p3>

				</div>

				<div class="span5 row-fluid" >	
					
						
						<img id = "img1_profile" src="<?=site_url('images/profile.png')?>">
						
				</div>
				 
			</div>
			</br></br></br></br></br></br>
			<ul id = "divider2" class="nav nav-list " ><!----Divider------------------>
	   
	    		<li class="divider" ></li>
		    
			</ul>


			<div class="container-fluid" >
				<div class="span4 row-fluid " >
					<h3 id = "head_right" ><em>Tags</em></h3>
					<p3 id = "para_tag"><em>Follow a tag to get its feed in your home. You can also see your followed tags, and trending tags in the right pane.</em></p3>

				</div>

				<div class="span5 row-fluid" >	
					
						
						<img id = "img1_tag" src="<?=site_url('images/tagtrending.png')?>" >						
						<img id = "img2_tag" src="<?=site_url('images/tagfollowed.png')?>">
						<img id = "img3_tag" src="<?=site_url('images/tagprofile.png')?>">
						
				</div>
				 
			</div>
			</br></br></br></br></br></br>
			<ul id = "divider2" class="nav nav-list "  ><!----Divider------------------>
	   
	    		<li class="divider" ></li>
		    
			</ul>


			<div class="container-fluid" >
				<div class="span4 row-fluid " >
					<h3 id = "head_left" ><em>Score and Leaderboard</em></h3>
					<p3 id = "para_score"><em>All your activities on Riklr contribute to your score, but your activities as an anon don't. The leaderboard shows your, and your friends' score rankings. Have fun by competing against them.</em></p3>

				</div>

				<div class="span5 row-fluid"  >	
					
						
						<img id = "img1_score" src="<?=site_url('images/score.PNG')?>">
						<img id = "img2_score" src="<?=site_url('images/leaderboard.PNG')?>" >						
				</div>
				 
			</div>
			</br></br></br></br></br></br>
			<ul id = "divider2" class="nav nav-list " ><!----Divider------------------>
	   
	    		<li class="divider" ></li>
		    
			</ul>

		</div>

		</div>
	</div>
</div>
    <!-- Le javascript
    ================================================== -->
    <!-- Placed at the end of the document so the pages load faster -->
    	<script src="<?=site_url('bootstrap/js/bootstrap.js');?>"></script>

  </body>
</html>

