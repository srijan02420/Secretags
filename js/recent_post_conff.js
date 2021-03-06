(function($) {
	$.fn.scrollPagination = function(options) {
		//alert(options.user_id);
		var settings = { 
			nop     : 5, // The number of posts per scroll to be loaded
			offset  : 0, // Initial offset, begins at 0 in this case
			error   : 'No More Posts!', // When the user reaches the end this is the message that is
			                            // displayed. You can change this if you want.
			delay   : 500, // When you scroll down the posts will load after a delayed amount of time.
			               // This is mainly for usability concerns. You can alter this as you see fit
			scroll  : true, // The main bit, if set to false posts will not load as the user scrolls. 
			               // but will still load if the user clicks.
			user_id : options.user_id
		}
		
		// Extend the options so they work with the plugin
		if(options) {
			$.extend(settings, options);
		}
		
		// For each so that we keep chainability.
		return this.each(function() {		
			
			// Some variables 
			$this = $(this);
			$settings = settings;
			var offset = $settings.offset;
			var busy = false; // Checks if the scroll action is happening 
			                  // so we don't run it multiple times
			
			// Custom messages based on settings
			if($settings.scroll == true) $initmessage = 'Scroll for more or click here';
			else $initmessage = 'Click for more';
			
			// Append custom messages and extra UI
			//$this.append('<div class="all_posts"></div><div class="loading-bar">'+$initmessage+'</div>');
			$('.loading-bar').show();
			function getData() {
				
				// Post data to ajax.php
				$.post('http://localhost/Secretags/json/json_get_recent_conff.php', {
						
					action        : 'scrollpagination',
				    number        : $settings.nop,
				    user_id        : $settings.user_id,
				    offset        : offset,
									    
				}, function(data) {
					//alert(data);
					// Change loading bar all_posts (it may have been altered)
					$('.loading-bar').hide();
					conffs = JSON.parse(data);
					// If there is no data returned, there are no more posts to be shown. Show error
					if(conffs.conff.length == 0) { 
						$('.loading-bar').html($settings.error);
						busy = true;
					}
					else {
						
						// Offset increases
					    offset = offset+$settings.nop; 
						var conf,varhtml,liked,comment_liked,tags;
														
						for(var a=0;a<conffs.conff.length;a++)
							{
								conf = conffs.conff[a];
																
								if(conf.user_liked==true)
									liked = 'Unlike';
								else
									liked = 'Like'
									
									tags = ' ';taglist = ' ';
								for(var i=0;i<conf.tags.length;i++)
									{tags += '<a href="http://localhost/Secretags/tags/tag/'+conf.tags[i].tag_id+'"><li class="label label-inverse" ><div style = "padding: 4px; font-size:16px;">#'+conf.tags[i].tag+'</div></li></a>'+
									' ';taglist = taglist + '#' + conf.tags[i].tag;} 
									
									if(tags!=' ')
									{
										tags += '<br/>';
									}
											
								comments = ' ';
								for(i=0;i<conf.comment.length;i++)
									{
										var comm = conf.comment[i]; 
										if(comm.user_liked==true)
											comment_liked = 'Unlike';
										else
										comment_liked = 'Like';
										var com_photo = comm.photo;
										var link = 'http://localhost/Secretags/home/profile/'+comm.user_id;
										if(comm.gender != 0)
											{com_photo = 'http://localhost/Secretags/images/'+comm.gender+'.jpg';
											link = '#';
											if(comm.gender == 1)
												comm.user_name = 'Anon male';
											else if(comm.gender == 2)
												comm.user_name = 'Anon female';
											else if(comm.gender == 3)
												comm.user_name = 'Anonymous';
											}
										
										comments += '<div class="media-body" id ="comment'+comm.comment_id+'">'+		
																	'<div class="row-fluid">'+
																		'<div class="span1 ">'+
																			'<li ><a href="'+link+'"><img src="'+com_photo+'"></a></li>	'+						   
																		'</div>'+
																		'<div class="span11 ">'+	
																			'<li ><a href="'+link+'"><strong>'+comm.user_name+'&nbsp </a></strong><div class="trim">'+comm.comment+'</div></li>'+
																				'<ul class="inline">'+
																					'<li class="text-info"><a onClick="like_comment('+comm.comment_id+','+conf.conff_id+',this); return false;">'+comment_liked+'</a>&nbsp&nbsp<i class="icon-star"></i><span class="noofcommentlikes'+comm.comment_id+'">'+comm.total_likes+'<span></li>'+
																					'<li class="muted" >'+comm.time+'</li>'+
																				'</ul>	'+			
																		'</div>'+
																	'</div>'+
																'</div>'+
															'<ul class="nav nav-list" style = "width:100%; padding-left: 0%;">'+
																'<li class="divider"></li>'+
															'</ul>';
									}
											var post = "postToFeed("+conf.conff_id+",'"+0+"',"+conf.type+","+conf.gender+",'"+0+"'); return false;";					
											//alert(post);
									var special = '';
									if(conf.commenter.length != 0)
										{
										//if(conf.user_liked==true)
											
										special = '<strong style = "font-size:18px; margin-right: 10px;"><a href="http://localhost/Secretags/home/profile/'+conf.commenter[0].user_id+'" style = "color:#002E5C;">'+conf.commenter[0].name+'</a> commented on a post</strong></br>';
										}
									else {
										if(conf.liker.length != 0)
											{
											special = '<strong style = "font-size:18px; margin-right: 10px;"><a href="http://localhost/Secretags/home/profile/'+conf.liker[0].user_id+'" style = "color:#002E5C;">'+conf.liker[0].name+'</a> liked a post</strong></br>';
											}
										 }
										 var text = "'"+escape(conf.conff)+"'";
										 if(conf.conff.length > 2000)
											conf.conff = conf.conff.substring(0,500) + '.....<a href="http://localhost/Secretags/secretpost/post/'+conf.conff_id+'">continue reading</a>';
										 else if(conf.conff.length > 500 && conf.conff.length < 2000)	
											conf.conff = conf.conff.substring(0,500) + '.....<a onClick="makeitbig('+text+','+conf.conff_id+'); return false;"  >continue reading</a>';
												
												varhtml =
												
									'<a class="pull-left" href="http://localhost/Secretags/secretpost/post/'+conf.conff_id+'" style = "margin-left:10px; margin-top:10px; background:white; border-radius:4px; box-shadow: 0px 0px 10px #000000;"><img src="http://localhost/Secretags/images/'+conf.gender+'.jpg" class="media-object" width = "84px" style = " border-radius:4px;"></a>'+
									'<img src="http://localhost/Secretags/images/type_'+conf.type+'.png" width="30px" height="30px" style="margin-top:79px; margin-left:-32px; position:absolute;">'+
								'<div class="media-body" style = "margin-right:10px; margin-top:10px; margin-bottom:10px; background: rgba(255,255,255,0.6); border-radius:2px; box-shadow: 0px 0px 10px #171717;">'+
								'<ul class="media inline" style = "margin: 8px; ">'+
										tags+
										'<li style = "padding-top:6px;" id="post_conf'+conf.conff_id+'">'+
											conf.conff+
										'</li>'+
									'<ul class="inline" id="activity'+conf.conff_id+'" style = "margin-left: 10px; margin-right: 10px; ">'+
									'<li class="text-info" ><a onClick="like('+conf.conff_id+',this); return false;"  >'+liked+'</a>&nbsp&nbsp<i class="icon-star"></i><span class="nooflikes'+conf.conff_id+'">'+conf.total_likes+'</span></li>'+
									'<li class="text-info"><a onClick="showComm('+conf.conff_id+'); return false;">Comment</a>&nbsp&nbsp<i class="icon-comment"></i>'+conf.comment.length+'</li>'+
									'<li class="text-info"><a onclick="'+post+'">Share</a>&nbsp&nbsp<i class="icon-share"></i><span class="noofshares'+conf.conff_id+'">'+conf.shares+'</span></li>'+
									'<li class="muted" >'+conf.time+'</li>'+
									'</ul>'+
									
										'<div class="media">'+
											'<ul class="breadcrumb comments" id="'+conf.conff_id+'" style = "margin-bottom:0px; " >'+
												'<div id="comments'+conf.conff_id+'">'+
													
													comments+
									
																					<!---comment ends-->
														
												'</div>'+
												'<div class="media-body">'+
																	'<div class="row-fluid"  >'+
																		'<div class="span1 " >'+
																			'<li ><a href="#"><img src="'+conf.photo+'"></a></li>'+							   
																		'</div>'+
																		'<div class="span11 ">'+
																		'<div  style =" background: #DCDCE8; width:100%; padding-top:0px; border-radius : 0px; ">'+
																			'<form id="post_comment'+conf.conff_id+'">'+
																			'<textarea rows="1" style = "width:100%; resize:none; border-radius : 0px;  margin : 0 auto; " placeholder="Comment here..." id="commnt'+conf.conff_id+'" class="comment_box"></textarea>'+
																				'<div class="navbar" style = "margin : 0 auto; " id="comment_rest'+conf.conff_id+'">'+
																					'<div class="navbar-inner">'+
																						'<div class="container" >'+
																							'<ul class="nav pull-right">'+
																								'<li ><a href="#"><button class="btn btn-small" style = "margin-top : -3px;" type="button" onClick="add_comment('+conf.conff_id+');return false;">Comment</button></a></li>'+
																							'</ul>'+
																							'<ul class="nav pull-right">'+
																								'<i class="icon-user"></i>'+
																								'<select id="gender'+conf.conff_id+'" value="Gender" class="" style="" placeholder="Comment As">'+
																								 ' <option value="0">Self</option>'+
																								  '<option value="1">Anon Male</option>'+
																								  '<option value="2">Anon Female</option>'+
																								  '<option value="3">Anon Other</option>'+
																								'</select>'+
																							'</ul>'+
																							'<div class="nav-collapse collapse"></div>'+
																						'</div>'+
																					'</div>'+
																				'</div>'+
																			'</form>'+
																		'</div>'+
																	'</div>'+
																'</div>'+
															'</div>'+
														'</ul>'+
													'</div>'+
												'</ul>'+
											'</div>'+
									'<ul class="nav nav-list" style = "width:100%; padding-left: 0%;">'+
										'<li class="divider"></li>'+
									'</ul>';						
													
									// if($('#conff'+conf.conff_id).doesExist())
									// {
										// $('#conff'+conf.conff_id).html(varhtml);
									// }
									// else
									// {				
										$('#all_posts').append('<li class="media" id="conff'+conf.conff_id+'">'+varhtml+'</li>');
									// }
						
							}	
						// No longer busy!	
						busy = false;
					}
						
				});
					
			}	
			//alert('hello');
			getData(); // Run function initially
			
			// If scrolling is enabled
			if($settings.scroll == true) {
				// .. and the user is scrolling
				$(window).scroll(function() {
					
					if($(window).scrollTop() + screen.height > $('body').height() && !busy) {
						
						// Now we are working, so busy is true
						busy = true;
						
						// Tell the user we're  
						$('.loading-bar').show();
						
						// Run the function to fetch the data inside a delay
						// This is useful if you have content in a footer you
						// want the user to see.
						setTimeout(function() {
							
							getData();
							
						}, $settings.delay);
							
					}	
				});
			}
			
			// Also content can be loaded by clicking the loading bar/
			$('.loading-bar').click(function() {
			
				if(busy == false) {
					busy = true;
					getData();
				}
			
			});
			
		});
	}

})(jQuery);
