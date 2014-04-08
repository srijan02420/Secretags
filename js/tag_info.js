
				// Main Long Poll function
				function tag_info(user_id,tag_id)
				{
					
					// Open an AJAX call to the server's Long Poll PHP file
					$.get("http://localhost/Secretags/json/json_get_tag_info.php", 
					//async = true,
					{ user_id : user_id,tag_id : tag_id})
					.done(function(data)
					{
						tag = JSON.parse(data); // after receiving make a object from it
						
						if(tag.success == 1)
						{
							var varhtml = 
								'<table>'+
									'<tr>'+
										'<td style = "width : 30%; border-right:solid white 1px;"></br>'+
											'<div>'+
												'<ul class="inline">'+
													'<li style = "font-size:30px; color:lightgrey" >'+tag.total_posts+'</li><li style = "color:lightgrey;">POSTS</li>'+
												'</ul>'+
											'</div>'+
											'<div>'+
												'<ul class="inline">'+
													'<li style = "font-size:30px; color:lightgrey" >'+tag.users_following+'</li><li style = "color:lightgrey;">FOLLOWERS</li>'+
												'</ul>'+
											'</div>'+										
										'</td>'+
										'<td></br>'+
											'<ul class="inline">'+
												'<li style = "font-size:30px;  padding-top:10px; padding-bottom:15px; color:lightgrey;" >#'+tag.tag+'</li></br>'+
											'</ul>'+			
										'</td>'+
										'<td style = "width:100%""></br>'+
											'<ul class="inline pull-right">'+
												'<li style = "background-color : #303033; border-radius:2px; box-shadow: 0px 0px 10px #171717; color:white; " ><a href="#" onClick=" follow_tag('+tag_id+','+user_id+'); return false;" style="color:white;">'+tag.follow+'</a></li>'+
											'</ul>'+
										'</td>'+
									'</tr>'+
								'</table>';
								
								
								$('#tag_table').html(varhtml);
								
								
						}
						
					});
					
				}
			