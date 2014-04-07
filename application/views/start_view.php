<html xmlns="http://www.w3.org/1999/xhtml" dir="ltr" lang="en-US"
      xmlns:fb="https://www.facebook.com/2008/fbml">
<head>
    <meta charset="utf-8">
    <title>Bootstrap, from Twitter</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="">

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
		margin-top:7%;
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
    <link href="bootstrap/css/bootstrap-responsive.css" rel="stylesheet">
	<link href="http://silviomoreto.github.com/bootstrap-select/stylesheets/bootstrap-select.css" rel="stylesheet">
	
    <!-- HTML5 shim, for IE6-8 support of HTML5 elements -->
    <!--[if lt IE 9]>
      <script src="../bootstrap/js/html5shiv.js"></script>
    <![endif]-->

    <!-- Fav and touch icons -->
    <link rel="shortcut icon" href="bootstrap/img/glyphicons-halflings.png">
    <link rel="shortcut icon" href="bootstrap/img/glyphicons-halflings-white.png">
								   
	<script src="http://code.jquery.com/jquery-latest.js"></script>
	<script src="bootstrap/js/bootstrap-select.min.js"></script>
<script>
$(document).ajaxStart(function() {
		   $( "#loading" ).show();
		 });
		 $(document).ajaxStop(function() {
			  $( "#loading" ).hide();
		});
var tags = new Array();
	$(document).ready(function() {
		//$('#conff_text').focus('2000',function(){ this.rows=7; $('#post_rest').show(); })
		$('.selectpicker').selectpicker();
		});
		
		function post_conff(){
			//alert('yes');
			var text = $('#conff_text').val();
			var tags = new Array();
			var textarray = text.split(/[\s,]+/);
			for(var a=0;a<textarray.length;a++)
				{if(textarray[a].charAt(0)==='#'){
					textarray[a] = textarray[a].slice(1);
					tags.push(textarray[a].toLowerCase());
					}
				}
				alert("Ain't gonna happen dude ain't gonna happen");
		   // $.post("http://secretags.com/post/post_conff", { gender: $('#conff_gender').val(), user_id: 1, conff: $('#conff_text').val().replace(/\n/g, "<br />"), type: $('#conff_type').val(),tags:tags } )
			// .done(function(data) {
				// alert("Thanks for adding up our database! We really appreciate it!");
				// longPollpost(id,data);
				// longPoll(id,0) ;
				// $('#conff_text').val('');
			// });
			}
		
</script>

  </head>
  
  <body>
	<div class="navbar navbar-inverse navbar-fixed-top">
		<div class="navbar-inner">
			<div class="container">
						  
				  <a class="brand" href="#"> <img src="http://secretags.com/images/logo.png" class="pull-left" width = "40px" ></a>
				  <a class="brand" href="#"><strong>Secretags</strong></a>
				 
				<!--<ul class="nav pull-right">
					<li class="active"><a href="#">How it Works?</a></li>
				</ul>-->
				
			</div>
		</div>
    </div>

<div class="container-fluid" >
	<div class="mask" class="span12">
	<div  id="uptext">
		<h1 style="font-weight:normal;">Express yourself anonymously! #secretags</h1>
	</div>
	<div id="aboutus">
		<h3 style="font-weight:normal;">We are going to launch very soon, meanwhile help us build our database for you, and get an early access to the site!</h3>
		<!--<p>Check out <span class="label label-inverse">How it Works</span> for more info.</p>-->
		<h4 style="font-weight:normal;">Write your post freely and use <strong id="big">#</strong> to tag it. For example :</h4>
		<p class="well" id="post">I'm a girl in 4th year. I love making out with my room mate. At the same time, it gave me opportunities to excel, to travel and an awesome job in the end! The best 4 years of my life till now! 
		<strong>#SRCC #DU #lesbian #taboo</strong>		
		</p>
	</div>
		<form id="post_conff">
			<div class="row-fluid">
						<textarea rows="7" class="span12" id="conff_text" style = "width:100%; resize:none; border-radius : 0px;  margin : 0 auto; " placeholder="Anonimously confess something, compliment someone, or propose..."></textarea>

						<div class="navbar span12" style = "margin : 0;" id="post_rest">
							<div class="navbar-inner">
								<div class="container row-fluid" >
									<!-- .btn-navbar is used as the toggle for collapsed navbar content -->
									<!-- Be sure to leave the brand out there if you want it shown -->
										<div class="span9 offset6">
										
										<i class="icon-heart"></i>
										<select id="conff_type" value="Post Type" class="selectpicker span3" placeholder="Comment As">
											<option value="1">Confession</option>
											<option value="2">Compliment</option>
											<option value="3">Proposal</option>
											<option value="4">Other</option>
										</select>
										
										<i class="icon-user"></i>
										<select id="conff_gender" value="Gender" class="selectpicker span3" placeholder="Comment As">
											<option value="1">Anon Male</option>
											<option value="2">Anon Female</option>
											<option value="3">Anon Other</option>
										</select>
									
										<button class="btn btn-small" style="margin-top:-5px;" type="button" onClick="post_conff()">Post</button>
										</div>
								</div>
							</div>
						</div>
			</div>
		</form>
					<small> * Write as many posts as you want.</small>
	</div>
</div>
<div id="loading">
	<img src="http://secretags.com/images/downloader.gif"/>
</div>
    <!-- Le javascript
    ================================================== -->
    <!-- Placed at the end of the document so the pages load faster -->
    	<script src="bootstrap/js/bootstrap.js"></script>

  </body>
</html>

