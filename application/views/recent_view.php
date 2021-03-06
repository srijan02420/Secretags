<?
	$get_user_info = $this->db->query("SELECT * FROM users where user_id = ".$user_id." ;");
	$name = $get_user_info->row()->name;
	$photo = $get_user_info->row()->s_pic;
	
?>
	<link rel="stylesheet" type="text/css" href="<?=site_url('css/style.css')?>" />
	<script src="<?=site_url('js/recent_post_conff.js');?>"></script>
	<script src="<?=site_url('js/refresh_tags.js')?>"></script>
	<script src="<?=site_url('js/refresh_conff.js"')?>"></script>
	
	<script src="<?=site_url('js/tags_friends.js')?>"></script>
	<script src="<?=site_url('js/leaderboard.js')?>"></script>
	<script src="<?=site_url('js/trending_tags.js')?>"></script>
	
	<script>
	
	$(document).ready(function() {
	
		var id = <?=$user_id;?>;
		refreshTags(id,0);
		trendingTags();
		leaderboard(id);
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
		   	<div class="span9 "  style = " padding-left: 1.5%; padding-top:60px">
				<!--------------------------------------Post Confession------------------------------>
				<div  id="tag_table" style = "background-color : #303033; width:100%; border-radius:2px; padding-top:0px;  box-shadow: 0px 0px 10px #171717;">	
							
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
	
			<div class="span3 "  style = " padding-right: 1.5%; padding-top:60px;  " >
				<div class="well sidebar-nav " style = "box-shadow: 0px 0px 10px #171717; " >
					<div class="row-fluid"  >
						<div class="span3 "  >				
							<img src="<?=$photo?>">						    		
						</div>
				
						<div class="span9 "  >				
							<a href="../../home/profile/<?=$user_id?>"><strong><?=$name?>&nbsp</strong></a>
							<p class="muted"><a href="../../home/profile/<?=$user_id?>" class="muted">See Your Profile</a></p>
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
<!-- Modal -->
									<!-- Modal -->
							<div id="Leaderboard" class="modal hide fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
								<div class="modal-header">
									<button type="button" class="close" data-dismiss="modal" aria-hidden="true">�</button>
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
<!-----------------------Modal ends-------------------------------------->

    <!-- Le javascript
    ================================================== -->
    <!-- Placed at the end of the document so the pages load faster -->
    	<script src="<?=site_url('bootstrap/js/bootstrap.js');?>"></script>

  </body>
</html>

