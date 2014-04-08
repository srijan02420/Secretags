
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
									
									tags = ' ';taglist = ' ';
								for(var i=0;i<conf.tags.length;i++)
									{tags += '<a href="#"><li class="label label-inverse" ><div style = "padding: 4px; font-size:16px;">#'+conf.tags[i].tag+'</div></li></a>'+
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
										var link = 'http://localhost/Secretags/profile/'+comm.user_id;
										if(comm.gender != 0)
											{com_photo = 'http://localhost/Secretags/images/'+comm.gender+'.jpg';
											link = '#';
											if(comm.gender == 1)
												comm.user_name = 'Anon male';
											else if(comm.gender == 2)
												comm.user_name = 'Anon female';
											else if(comm.gender == 3)
												comm.user_name = 'Anonimous';
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
									'<a class="pull-left" href="#" style = "margin-left:10px; margin-top:10px; background:white; border-radius:4px; box-shadow: 0px 0px 10px #000000;"><img src="http://localhost/Secretags/images/'+conf.gender+'.jpg" class="media-object" width = "84px" style = " border-radius:4px;"></a>'+
								'<img src="http://localhost/Secretags/images/type_'+conf.type+'.png" width="30px" height="30px" style="margin-top:79px; margin-left:-32px; position:absolute;">'+
								'<div class="media-body" style = "margin-right:10px; margin-top:10px; margin-bottom:10px; background: rgba(255,255,255,0.6); border-radius:2px; box-shadow: 0px 0px 10px #171717;">'+
								'<ul class="media inline" style = "margin: 8px; ">'+
										tags+
										'<li style = "padding-top: 6px;">'+
											'<div class="trim">'+conf.conff+'</div>'+
										'</li>'+
									'<ul class="inline" style = "margin-left: 10px; margin-right: 10px;">'+
									'<li class="text-info"><a onClick="like('+conf.conff_id+',this); return false;"  >'+liked+'</a>&nbsp&nbsp<i class="icon-star"></i><span class="nooflikes'+conf.conff_id+'">'+conf.total_likes+'</span></li>'+
									'<li class="text-info"><a href="#" onClick="showComm('+conf.conff_id+'); return false;">Comment</a>&nbsp&nbsp<i class="icon-comment"></i>'+conf.comment.length+'</li>'+
									'<li class="text-info"><a onclick="'+post+'">Share</a>&nbsp&nbsp<i class="icon-share"></i><span class="noofshares'+conf.conff_id+'">'+conf.shares+'</span></li>'+
									'<li class="muted" >'+conf.time+'</li>'+
									'</ul>'+
									
										'<div class="media">'+
											'<ul class="breadcrumb comments" id="'+conf.conff_id+'" style = "margin-bottom:0px; display:block;" >'+
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
																		'<div  style =" background: #DCDCE8; width:100%; padding-top:0px; border-radius : 0px;">'+
																			'<form id="post_comment'+conf.conff_id+'">'+
																			'<textarea rows="1" style = "width:100%; resize:none; border-radius : 0px;  margin : 0 auto; " placeholder="Comment here..." id="commnt'+conf.conff_id+'" class="comment_box"></textarea>'+
																				'<div class="navbar comment_rest" style = "margin : 0 auto;">'+
																					'<div class="navbar-inner">'+
																						'<div class="container" >'+
																							'<ul class="nav pull-right">'+
																								'<li ><a href="#"><button class="btn btn-small" style = "margin-top : -3px;" type="button" onClick="add_comment('+conf.conff_id+');return false;">Comment</button></a></li>'+
																							'</ul>'+
																							'<ul class="nav pull-right">'+
																								'<i class="icon-user"></i>'+
																								'<select id="gender'+conf.conff_id+'" value="Gender" class="" placeholder="Comment As">'+
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
						
								//alert(data);
								if($('#conff'+conf.conff_id).doesExist())
									{
										$('#conff'+conf.conff_id).html(varhtml);
									}
									else
									{				
										$('#all_posts').prepend('<li class="media" id="conff'+conf.conff_id+'">'+varhtml+'</li>');
									}
									refreshScore(user_id);
								
								
						}
						
					});
					
				}
			