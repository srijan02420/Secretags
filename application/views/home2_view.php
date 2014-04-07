<html xmlns="http://www.w3.org/1999/xhtml" dir="ltr" lang="en-US"
      xmlns:fb="https://www.facebook.com/2008/fbml">
<head>
    <meta charset="utf-8">
    <title>Bootstrap, from Twitter</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="">
    <meta name="author" content="">
	<head prefix="og: http://ogp.me/ns# fb: http://ogp.me/ns/fb# secretags: http://ogp.me/ns/fb/secretags#">
  <meta property="fb:app_id" content="481439511903117" /> 
  <meta property="og:type"   content="object" /> 
  <meta property="og:url"    content="http://localhost/secretags/home/test.html" /> 
  <meta property="og:title"  content="Sample Demo" /> 
  <meta property="og:image"  content="https://fbstatic-a.akamaihd.net/images/devsite/attachment_blank.png" /> 
	<meta property="og:site_name" content="Secertags" />
	<meta property="fb:admins" content="100001010584091" />

    <!-- Le styles -->
    <link href="bootstrap/css/bootstrap.css" rel="stylesheet">
	
    <style>
      body {
        background: url('images/dottedtexture5.jpg');
		background-repeat:no-repeat;
		background-attachment:fixed;
		background-position:centre;
		background-size:cover;
      }
    </style>
    <link href="bootstrap/css/bootstrap-responsive.css" rel="stylesheet">
	<link href="http://ajax.microsoft.com/ajax/jquery.ui/1.8.7/themes/black-tie/jquery-ui.css" rel="stylesheet">
	<link href="http://silviomoreto.github.com/bootstrap-select/stylesheets/bootstrap-select.css" rel="stylesheet">
	
    <!-- HTML5 shim, for IE6-8 support of HTML5 elements -->
    <!--[if lt IE 9]>
      <script src="../bootstrap/js/html5shiv.js"></script>
    <![endif]-->

    <!-- Fav and touch icons -->
    <link rel="shortcut icon" href="bootstrap/img/glyphicons-halflings.png">
    <link rel="shortcut icon" href="bootstrap/img/glyphicons-halflings-white.png">
								   
	<script src="http://code.jquery.com/jquery-latest.js"></script>
	<script src="http://ajax.aspnetcdn.com/ajax/jquery.ui/1.8.7/jquery-ui.min.js"></script>
	<script src="js/add_conff.js"></script>
	<script src="js/tag.js"></script>
	<script src="js/add_comment.js"></script>
	
								   
	<script>$('.dropdown-toggle').dropdown();</script> 
	<script src="bootstrap/js/bootstrap-select.min.js"></script>
	<script>
var tags = new Array();
	$(document).ready(function() {
	
		$('.selectpicker').selectpicker();
		
		$.get("get_tags.php", function(data) {
			students = JSON.parse(data); // after receiving make a object from it
			alert(students[0].tag);
			
			for(var a=0;a<students.length;a++)
				tags.push(students[a].tag);
		});
		
		$('.search-query').typeahead({source: tags}) ; 
		
		$(".trim").text('hello');
	});
	$.fn.doesExist = function(){
		return jQuery(this).length > 0;
		};
		
		function showComm(conff_id){
			$("#"+conff_id).toggle(500);
		}
	</script>
<style>
#label{border:1px solid red; width:auto;
display:none;

margin:0 auto;}
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
	<script src="js/fb.js"></script>
			
	<!--<button type="button" onClick="logout();">Logout</button>
	 <p><a onclick='postToFeed(); return false;'>Post to Feed</a></p>
    <p id='msg'></p>
	
		<textarea class='mention'>
		</textarea>-->

<!--header-->
    <div class="navbar navbar-inverse navbar-fixed-top">
		<div class="navbar-inner">
			<div class="container">
				<button type="button" class="btn btn-navbar" data-toggle="collapse" data-target=".nav-collapse">
					<span class="icon-bar"></span>
					<span class="icon-bar"></span>
					<span class="icon-bar"></span>
				</button>
		  
				  <a class="brand" href="#"> <img src="images/logo.png" class="pull-left" width = "40px" ></a>
				  <a class="brand" href="#"><strong>Secretags</strong></a>
				  <div class="nav-collapse collapse">
					<ul class="nav">
						<li class="active"><a href="#">Home</a></li>
						<li><a href="#about">About</a></li>
						<li><a href="#contact">Contact</a></li>
					</ul>

				  </div><!--/.nav-collapse -->
			
				<ul class="nav pull-right">
					<li class="dropdown pull-right">
						<a href="#" class="dropdown-toggle pull-right" data-toggle="dropdown"><i class="icon-wrench icon-white"></i><b class="caret"></b></a>
						<ul class="dropdown-menu ">
							  <li><a href="#">Action</a></li>
							  <li><a href="#">Another action</a></li>
							  <li><a href="#">Something else here</a></li>
							  <li class="divider"></li>
							  <li class="nav-header">Nav header</li>
							  <li><a href="#">Separated link</a></li>
							  <li><a href="#" onClick="logout();">Logout</a></li>
						</ul>
					</li>
				</ul>
				<form class="navbar-search pull-right ">
					<i class="icon-search icon-white  "></i>
					<input type="text" class="search-query" data-provide="typeahead" placeholder="Search for tags, friends">
				</form>
			</div>
		</div>
    </div>


<!--header ends---->

<!--------------------------------------Newsfeed--------------------------------->


<?
	$get_user_info = $this->db->query("SELECT * FROM users where user_id = ".$user_id." ;");
	$name = $get_user_info->row()->name;
	$photo = $get_user_info->row()->s_pic;
	
?>


    <div class="container-fluid">
	    <div class="row-fluid"  >
			<div class="span1 "   ><!------------side space of 1 span-------------->
			</div>
			    <div class="span3 "   >

					<div class="well sidebar-nav "  >
						<div class="row-fluid"  >
							<div class="span3 "  >
													
								<img src="<?=$photo?>">						    
											
							</div>

					
							<div class="span9 "  >
												
								<a href="#"><strong><?=$name?>&nbsp</strong></a>
								<p class="muted">View profile</p>

							</div>
						</div>
						<ul class="nav nav-list"><!----Divider------------------>
						   
								<li class="divider"></li>
							
						</ul>
						<div class="row-fluid"  ><!----Score------------------>
							

							<div class="span1 "   ><!------------side space of 1 span-------------->
							</div></br>
								
							<div class="span11  "  >
								<ul class="inline">
								<li style = "font-size:45px;" >22</li><li class="muted">SCORE</li>
								</ul>					
							</div>		
							
						</div>
						<ul class="nav nav-list"><!----Divider------------------>				   
								<li class="divider"></li>
						</ul>
						
						<ul class="inline">
							<li class="muted">Tags Following:</li>
							<?$get_user_tags = $this->db->query("SELECT * FROM user_tag where user_id = ".$user_id." ;");
							foreach($get_user_tags->result() as $arow)
								{
									$tag_id = $arow->tag_id ;
									$get_user_tags_name = $this->db->query("SELECT * FROM tag where tag_id = ".$tag_id." ;");?>
										<a href="#"><li class="label label-inverse" >#<?=$get_user_tags_name->row()->tag?></li></a><?
								}
							?>
							
							<a href="#"><li >more</li><b class="caret"></b></a><!-- more -->

						</ul>
					</div>
						

					<div class="well sidebar-nav "  >
						<div class="row-fluid"  >
							<ul class="inline">
								<li class="muted">Trending Tags:</li>
								<?$get_trending_tags = $this->db->query("SELECT DISTINCT tag_id FROM user_tag GROUP BY tag_id ORDER BY COUNT( user_id ) LIMIT 100;");
									foreach($get_trending_tags->result() as $arow)
								{
									$tag_id = $arow->tag_id ;
									$get_trending_tags_name = $this->db->query("SELECT tag FROM tag where tag_id = ".$tag_id." ;");?>
										<a href="#"><li class="label label-inverse" >#<?=$get_trending_tags_name->row()->tag?></li></a><?
								}
							?>
								<a href="#"><li >more</li><b class="caret"></b></a><!-- more -->

							</ul>				
							
						</div>
					</div>
				</div>
	    	<!------------end side space-------------->
			
			<!------------center space-------------->

	    	<div class="span7">
			
				<!------------post confession-------------->
				<form id="post_conff">
					<textarea rows="1" id="conff_text" style = "width:70%;" placeholder="Anonimously confess something, compliment someone, or propose..."></textarea>
			
					<ul class="inline ">
					    	

								<i class="icon-user"></i>
									<select id="conff_gender" value="Gender" class="span2 selectpicker" placeholder="Comment As">
										<option value="1">Anon Male</option>
										<option value="2">Anon Female</option>
										<option value="3">Anon Other</option>
									</select>
              				

					    	<i class="icon-heart"></i>
								<select id="conff_type" value="Post Type" class="span2 selectpicker" placeholder="Comment As">
									<option value="1">Confession</option>
									<option value="2">Compliment</option>
									<option value="3">Proposal</option>
								</select>
							
						 <li><button class="btn btn-mini btn-inverse offset4" onClick="post_conff()" type="button">Post</button></li>

					</ul>
				</form>
					<ul class="nav nav-list"><!----Divider------------------>
				   
				    	<li class="divider"></li>
				    
				    </ul>
					</br>
				<!------------post confession ends-------------->
			
			
				<!------------wall posts starts-------------->
		    	<ul class="media-list" id="all_posts">
				
					
				</ul>
			</div>   
<!---------------------------------------------------------------jjj-->
			       
			

			<!--Body content-->
			
	    </div>
    </div>
    <!-- Le javascript
    ================================================== -->
    <!-- Placed at the end of the document so the pages load faster -->
    	<script src="bootstrap/js/bootstrap.js"></script>

	<p id="label"/></p>
  </body>
</html>

<?
function time_elapsed_string($ptime) {
    $etime = time() - $ptime;
    
    if ($etime < 1) {
        return '0 seconds';
    }
    
    $a = array( 12 * 30 * 24 * 60 * 60  =>  'year',
                30 * 24 * 60 * 60       =>  'month',
                24 * 60 * 60            =>  'day',
                60 * 60                 =>  'hour',
                60                      =>  'minute',
                1                       =>  'second'
                );
    
    foreach ($a as $secs => $str) {
        $d = $etime / $secs;
        if ($d >= 1) {
            $r = round($d);
            return $r . ' ' . $str . ($r > 1 ? 's' : '') . ' ago';
        }
    }
}

?>
