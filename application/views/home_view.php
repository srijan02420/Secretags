<link rel="stylesheet" type="text/css" href="<?=site_url('css/style.css')?>" />
	<script src="<?=site_url('js/home_conff.js')?>"></script>
	<script src="<?=site_url('js/refresh_conff.js"')?>"></script>
	
	<script src="<?=site_url('js/refresh_tags.js')?>""></script>
	<script src="<?=site_url('js/trending_tags.js')?>""></script>
	<script src="<?=site_url('js/leaderboard.js')?>"></script>
	
	<script>
var tags = new Array();
	$(document).ready(function() {
		
		var userid = <?=$user_id?>;
	
				$('body').click(function(e){
		  //alert('in');
				if ($(e.target).is('#conff_text')) {
					//do something when clicked inside dropdown
					$('#conff_text').attr('rows',4);
					$('#post_rest').show();
				}
				// else{
					// $('#conff_text').attr('rows',1);
					// $('#post_rest').hide();
				// }
			});
		
		refreshTags(userid,0);
		trendingTags();
		leaderboard(userid);
		//refreshScore(userid);
		
	});
	
	$.fn.doesExist = function(){
		return jQuery(this).length > 0;
		};
		
		function showComm(conff_id){
			longPollpost(<?=$user_id?>,conff_id);
			$("#"+conff_id).toggle(500);
		}
		
$(document).ready(function() {
	$('#all_posts').scrollPagination({

		nop     : 5, // The number of posts per scroll to be loaded
		offset  : 0, // Initial offset, begins at 0 in this case
		error   : 'No More Posts!', // When the user reaches the end this is the message that is
		                            // displayed. You can change this if you want.
		delay   : 500, // When you scroll down the posts will load after a delayed amount of time.
		               // This is mainly for usability concerns. You can alter this as you see fit
		scroll  : true, // The main bit, if set to false posts will not load as the user scrolls. 
		               // but will still load if the user clicks.
		user_id : <?=$user_id?>
	});
});
</script>
 
<!--header ends---->
<!--------------------------------------Sidebar--------------------------------->

<div class="container-fluid" >
	<div class="row-fluid" >
		<div class="span11 " style = " margin-left:4.16%; *zoom: 1; background : rgba(255,255,255,0.3); box-shadow: 0px 0px 20px #171717; "  >
		<!--------------------------------------Newsfeed--------------------------------->
		   	<div class="span9" id="main"  style = " padding-left: 1.5%; padding-top:60px">
				<!--------------------------------------Post Confession------------------------------>
				<div  style = " background: #DCDCE8; width:100%; padding-top:0px; border-radius : 0px; box-shadow: 0px 0px 10px #171717;" id="post_all">
					<form id="post_conff">
						<div class="row-fluid">
									<textarea rows="1" class="span12" id="conff_text" style = "width:100%; resize:none; border-radius : 0px;  margin : 0 auto; " placeholder="Express yourself anonymously..."></textarea>

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
				</div>

<!--------------------------------------post Confession ends------------------------------>

 				<ul class="nav nav-list " style = "width:100%; padding-left: 0%; " ><!----Divider------------------>
				    	<li class="divider"></li> 
				</ul>
				
		    	<div id="all_posts" class="media-list">
				</div>
				<div class="loading-bar">
					<img src="<?=site_url('images/loading.gif');?>"/> 
				</div>
				
				<!--Posts content ends-->
			</div>
			
			
			<!----sidebar--->
			<div class="span3 "  style = " padding-right: 1.5%; padding-top:60px;  " >
				<div class="well sidebar-nav " style = "box-shadow: 0px 0px 10px #171717; " >
					<div class="row-fluid"  >
						<div class="span3 "  >	
							<a href="http://riklr.com/home/profile/<?=$user_id?>">
								<img src="<?=$photo?>">		
							</a>
						</div>
				
						<div class="span9 "  >				
							<a href="http://riklr.com/home/profile/<?=$user_id?>"><strong><?=$name?>&nbsp;</strong></a>
							<p class="muted"><a href="http://riklr.com/home/profile/<?=$user_id?>" class="muted">View profile</a></p>
						</div>
					</div>
					<ul class="nav nav-list"><!----Divider------------------>
						<li class="divider"></li>
					</ul>
					<div class="row-fluid"><!----Score------------------>
						<div class="span1 "   ><!------------side space of 1 span-------------->
						</div></br>
	    				
					<div class="span11  " style = "margin-left:0px; margin-top:0px; " >
						<a href="#Leaderboard" data-toggle="modal" ><div style = "background-color : #303033; margin-top:10px;border-radius:2px; box-shadow: 0px 0px 5px #171717;  margin-top:-20px;"><p style = "color:white; text-align: center; ">Check the Leaderboard</p></div></a>
						<!-- Modal -->
							
<!-----------------------Modal ends-------------------------------------->

						<table class="table table-condensed " style = "margin-bottom:0px;" id="profile_leaderboard">
    						
    					</table>					
					</div>		
					
				</div>
				<ul class="nav nav-list" style = "width:100%; padding-left: 0%;"><!----Divider------------------>				   
				    	<li class="divider"></li>
				</ul>
					
					<ul class="inline" id="user_tags">						
					</ul>
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
<div id="Leaderboard" class="modal hide fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
								<div class="modal-header">
									<button type="button" class="close" data-dismiss="modal" aria-hidden="true">X</button>
									<h3 id="myModalLabel">Leaderboard</h3>
								</div>
								<div class="modal-body">
									<table class="table table-condensed table-striped" style = "margin-bottom:0px;" id="leaderboard_modal">
			    						
			    					</table>	
								</div>
								<div class="modal-footer">
									<button class="btn" data-dismiss="modal" aria-hidden="true">Okay</button>
								</div>
							</div>
    <!-- Le javascript
    ================================================== -->
    <!-- Placed at the end of the document so the pages load faster -->
    	<script src="bootstrap/js/bootstrap.js"></script>

  </body>
</html>

