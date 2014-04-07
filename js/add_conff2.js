$(function()
			{
				// Main Long Poll function
				function longPoll(user_id,first)
				{
					//alert(user_id);
					// Open an AJAX call to the server's Long Poll PHP file
					$.get("json/json_get_conff.php", 
					//async = true,
					{ user_id : user_id, first:first })
					.done(function(data)
					{
						// Callback to handle message sent from server (not illustrated)
						//alert(data);
						conffs = JSON.parse(data); // after receiving make a object from it
						//alert(conffs.conff[0].conff_id);
						if(conffs.success == 1)
						{
							var conf,varhtml,liked,tags;
														
						for(var a=conffs.conff.length-1;a>=0;a--)
							{
								conf = conffs.conff[a];
								
								
								if(conf.user_liked==true)
									liked = 'Unlike';
								else
									liked = 'Like'
									
									tags = ' ';taglist = ' ';
								for(var i=0;i<conf.tags.length;i++)
									{tags += '<span class="label label-inverse">#'+conf.tags[i].tag+'</span>';}
											//alert(tags);	


								comments = ' ';
								for(i=0;i<conf.comment.length;i++)
									{
										var comm = conf.comment[i]; 
										comments += '<div class="media-body" id ="comment'+comm.comment_id+'">'+		
																	'<div class="row-fluid">'+
																		'<div class="span1 ">'+
																			'<li ><a href="#"><img src="'+comm.photo+'"></a></li>	'+						   
																		'</div>'+
																		'<div class="span11 ">'+
																			
																			'<li ><a href="#"><strong>'+comm.user_name+'&nbsp </a></strong><div class="trim">'+comm.comment+'</div></li>'+
																				'<ul class="inline">'+
																					'<li class="text-info"><a onClick="like_comment('+comm.comment_id+',this)">'+liked+'</a>&nbsp&nbsp<i class="icon-star"></i><span class="noofcommentlikes'+comm.comment_id+'">'+comm.total_likes+'<span></li>'+
									
																					'<li class="muted" >'+comm.time+'</li>'+
																				'</ul>	'+			
																		'</div>'+
																	'</div>'+
																	'</br>'+
																'</div>';
									}
											//alert(tags);							
									
									var post = "postToFeed("+conf.conff_id+",'"+0+"',"+conf.type+","+conf.gender+",'"+0+"'); return false;";					
										 		varhtml = '<li class="media" id="conff'+conf.conff_id+'">'+
									'<a class="pull-left" href="#"><img src="http://secretags.com/images/anon.png" class="media-object" width = "84px"></a>'+
								
								'<div class="media-body">'+
								'<p6 class="media">'+
										tags+
										'</br>'+
											'<div class="trim">'+conf.conff+'</div>'+
									'</p6 >'+
									'<ul class="inline">'+
									'<li class="text-info"><a onClick="like('+conf.conff_id+',this); return false;"  >'+liked+'</a>&nbsp&nbsp<i class="icon-star"></i><span class="nooflikes'+conf.conff_id+'">'+conf.total_likes+'</span></li>'+
									'<li class="text-info"><a href="#" onClick="showComm('+conf.conff_id+'); return false;">Comment</a>&nbsp&nbsp<i class="icon-comment"></i>'+conf.comment.length+'</li>'+
									'<li class="text-info"><a onclick="'+post+'">Share</a>&nbsp&nbsp<i class="icon-share"></i><span class="noofshares'+conf.conff_id+'">'+conf.shares+'</span></li>'+
									'<li class="muted" >'+conf.time+'</li>'+
									'</ul>'+
									
										'<div class="media">'+
											'<ul class="breadcrumb comments" id="'+conf.conff_id+'" >'+
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
																			'<form id="post_comment'+conf.conff_id+'">'+
																			'<textarea rows="1" id="comment'+conf.conff_id+'"></textarea>'+
																				'<ul class="inline ">'+
																						
																						'<i class="icon-user"></i>'+
																						'<select id="gender'+conf.conff_id+'" value="Comment As" class="input-small" placeholder="Comment As">'+
																						 ' <option value="0">Self</option>'+
																						  '<option value="1">Anon Male</option>'+
																						  '<option value="2">Anon Female</option>'+
																						  '<option value="3">Anon Other</option>'+
																						'</select>'+
																						'<li><input type="submit" class="btn btn-mini btn-inverse offset4" onClick="add_comment('+conf.conff_id+');return false;" value="Comment"></li>'+
																				'</ul>'+
																			'</form>'+
																		'</div>'+
																	'</div>'+
																'</div>'+	
											'</ul>'+
										'</div>'+
														
									<!-- Nested media object -->
								'</div>'+
							'</li>';
						
								if($('#conff'+conf.conff_id).doesExist())
								{
									$('#conff'+conf.conff_id).html(varhtml);
								}
								else
								{				
									$('#all_posts').prepend(varhtml);
								}
									//alert(varhtml);
								//}
								
							}
						
						}
						//alert("Data Loaded: " + data);
						// $('#all_posts').prepend(data);
						//Open the Long Poll again
						  setTimeout(function () {
								  longPoll(user_id,0);
							  }, 1000);
						// setTimeout(longPoll(),15000000);
						
					});
					
				}
			 
				// Make the initial call to Long Poll
				longPoll('100001010584091',1) ;
				
			});