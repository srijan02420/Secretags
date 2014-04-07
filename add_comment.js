$(function()
			{
				// Main Long Poll function
				function longPollcomment()
				{
					//alert('yes');
					//alert(user_id);
					// Open an AJAX call to the server's Long Poll PHP file
					$.get("json/json_get_comments.php" )
					//async = true,
					//{ user_id : user_id })
					.done(function(data)
					{
						// Callback to handle message sent from server (not illustrated)
						
						comments = JSON.parse(data); // after receiving make a object from it
						//alert(conffs.conff[0].conff_id);
						if(comments.success == 1)
						{
							var comment,varhtml,liked;
						for(var a=0;a<comments.comment.length;a++)
							{
								comm = comments.comment[a];
								if($('#comment'+comm.comment_id).doesExist())
								{
									//alert('yes');
								}
								else
								{
								
								if(comm.user_liked==true)
									liked = 'Unlike';
								else
									liked = 'Like'
									
										 		var varhtml = '<div class="media-body" id ="comment'+comm.comment_id+'">'+		
																	'<div class="row-fluid">'+
																		'<div class="span1 ">'+
																			'<li ><a href="#"><img src="'+comm.photo+'"></a></li>	'+						   
																		'</div>'+
																		'<div class="span11 ">'+
																			
																			'<li ><a href="#"><strong>'+comm.user_name+'&nbsp </a></strong>'+comm.comment+'</li>'+
																				'<ul class="inline">'+
																					'<li class="text-info"><a onClick="like_comment('+comm.comment_id+',this)">'+liked+'</a>&nbsp&nbsp<i class="icon-star"></i><span class="noofcommentlikes'+comm.comment_id+'">'+comm.total_likes+'<span></li>'+
									
																					'<li class="muted" >'+comm.time+'</li>'+
																				'</ul>	'+			
																		'</div>'+
																	'</div>'+
																	'</br>'+
																'</div>';
						
													
									$('#comments'+comm.conff_id).append(varhtml);
									//alert(varhtml);
								}
								
							}
						
						}
						//alert("Data Loaded: " + data);
						// $('#all_posts').prepend(data);
						//Open the Long Poll again
						  setTimeout(function () {
								  longPollcomment();
							  }, 1000);
						// setTimeout(longPoll(),15000000);
						
					});
					
				}
			 
				// Make the initial call to Long Poll
				longPollcomment();
				
			});