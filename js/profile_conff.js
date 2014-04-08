				// Main Long Poll function
				function profilelongPoll(user_id,id,first)
				{
					
					if(first==1)
						$( "#loading" ).show();
					$.get("http://localhost/Secretags/json/json_profile_posts.php", 
					//async = true,
					{ user_id : id,my_id : user_id , first:first })
					.done(function(data)
					{
						$( "#loading" ).hide();
						// Callback to handle message sent from server (not illustrated)
						//alert(data);
						//data = jQuery.htmlspecialchars( data, 2 );
						//alert(data);
						conffs = JSON.parse(data); // after receiving make a object from it
						//alert(conffs.conff[0].conff_id);
						if(conffs.success == 1)
						{
							var conf,varhtml,liked,comment_liked,tags,post;
														
						for(var a=conffs.conff.length-1;a>=0;a--)
							{
								conf = conffs.conff[a];
																
								if(conf.user_liked==true)
									liked = 'Unlike';
								else
									liked = 'Like'
									
									tags = ' ';taglist = ' ';
								for(var i=0;i<conf.tags.length;i++)
									{tags += '<a href="http://localhost/Secretags/tags/tag/'+conf.tags[i].tag_id+'"><li class="label label-inverse" ><div style = "padding: 4px; font-size:16px;">#'+conf.tags[i].tag+'</div></li></a>'+
									' ';
									taglist = taglist + '#' + conf.tags[i].tag;
									}
									if(tags!=' ')
									{
										tags += '<br/>';
									}
									//alert(taglist);	
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
																					'<li class="text-info"><a onClick="like_comment('+comm.comment_id+','+conf.conff_id+',this); return false;">'+comment_liked+'</a>&nbsp&nbsp<i class="icon-thumbs-up"></i><span class="noofcommentlikes'+comm.comment_id+'">'+comm.total_likes+'<span></li>'+
																					'<li class="muted" >'+comm.time+'</li>'+
																				'</ul>	'+			
																		'</div>'+
																	'</div>'+
																'</div>'+
															'<ul class="nav nav-list" style = "width:100%; padding-left: 0%;">'+
																'<li class="divider"></li>'+
															'</ul>';
									}
											//=alert(conf.photo);							
									var special = '';
									if(user_id == id)
										conffs.profile_name = 'You';
									if(conf.special_type==1)
										special = '<strong style = "font-size:18px; margin-right: 10px;"><a href="#" style = "color:#002E5C;">'+conffs.profile_name+'</a> commented on a post</strong></br>';
									else if(conf.special_type==2)
										special = '<strong style = "font-size:18px; margin-right: 10px;"><a href="#" style = "color:#002E5C;">'+conffs.profile_name+'</a> liked a post</strong></br>';
										 		post = "postToFeed("+conf.conff_id+",'"+0+"',"+conf.type+","+conf.gender+",'"+0+"'); return false;";	
												//alert(post);
												varhtml =
												special+
									'<a class="pull-left" href="#" style = "margin-left:10px; margin-top:10px; background:white; border-radius:4px; box-shadow: 0px 0px 10px #000000;"><img src="http://localhost/Secretags/images/'+conf.gender+'.jpg" class="media-object" width = "84px" style = " border-radius:4px;"></a>'+
								'<img src="http://localhost/Secretags/images/type_'+conf.type+'.png" width="30px" height="30px" style="margin-top:79px; margin-left:-32px; position:absolute;">'+
								'<div class="media-body" style = "margin-right:10px; margin-top:10px; margin-bottom:10px; background: rgba(255,255,255,0.6); border-radius:2px; box-shadow: 0px 0px 10px #171717;">'+
								'<ul class="media inline" style = "margin: 8px; ">'+
										tags+
										'<li style = "padding-top:6px;">'+
											conf.conff+
										'</li>'+
									'<ul class="inline" style = "margin-left: 10px; margin-right: 10px;">'+
									'<li class="text-info"><a onClick="like('+conf.conff_id+',this); return false;">'+liked+'</a>&nbsp&nbsp<i class="icon-thumbs-up"></i><span class="nooflikes'+conf.conff_id+'">'+conf.total_likes+'</span></li>'+
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
													
									if($('#conff'+conf.conff_id).doesExist())
									{
										$('#conff'+conf.conff_id).html(varhtml);
									}
									else
									{				
										$('#all_posts').prepend('<li class="media" id="conff'+conf.conff_id+'">'+varhtml+'</li>');
									}
									//alert(varhtml);
									$('.selectpicker').selectpicker();
									
									//$('.comment_rest').hide();
									
									//$('.comment_box').focus('2000',function(){ this.rows=2; $('.comment_rest').show(); });
									
								//}
								
							}
						
						}
						//alert("Data Loaded: " + data);
						// $('#all_posts').prepend(data);
						//Open the Long Poll again
						  setTimeout(function () {
								  profilelongPoll(user_id,id,0);
							  }, 30000);
						// setTimeout(longPoll(),15000000);
						
					});
					
				}
			