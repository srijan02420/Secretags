
				// Main Long Poll function
				function longPollpost(user_id,conff_id)
				{
					//alert(user_id);
					// Open an AJAX call to the server's Long Poll PHP file
					$.get("http://localhost/Secretags/json/json_get_refresh_post.php", 
					//async = true,
					{ user_id : user_id, conff_id:conff_id })
					.done(function(data)
					{
					//alert(data);
					$( "#loading" ).hide();
						conffs = JSON.parse(data); // after receiving make a object from it
						
						if(conffs.success == 1)
						{
							var conf,varhtml,comment_liked,liked,tags;
														
								conf = conffs.conff[0];
																
								if(conf.user_liked==true)
									liked = 'Unlike';
								else
									liked = 'Like'
									
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
										 		varhtml = 
									'<li class="text-info"><a onClick="like('+conf.conff_id+',this); return false;"  >'+liked+'</a>&nbsp&nbsp<i class="icon-star"></i><span class="nooflikes'+conf.conff_id+'">'+conf.total_likes+'</span></li>'+
									'<li class="text-info"><a href="#" onClick="showComm('+conf.conff_id+'); return false;">Comment</a>&nbsp&nbsp<i class="icon-comment"></i>'+conf.comment.length+'</li>'+
									'<li class="text-info"><a onclick="'+post+'">Share</a>&nbsp&nbsp<i class="icon-share"></i><span class="noofshares'+conf.conff_id+'">'+conf.shares+'</span></li>'+
									'<li class="muted" >'+conf.time+'</li>';
									
										
								//alert(data);
								if($('#conff'+conf.conff_id).doesExist())
									{
										$('#activity'+conf.conff_id).html(varhtml);
										$('#comments'+conf.conff_id).html(comments);
									}
									
						}
						if ($("#"+conff_id).is(':visible')) {
							setTimeout(function () {
									  longPollpost(user_id,conff_id);
								  }, 10000);
						}
						
					});
					
				}
			