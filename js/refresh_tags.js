
				// Main Long Poll function
				function refreshTags(user_id,all)
				{
					// Open an AJAX call to the server's Long Poll PHP file
					$.get("http://localhost/Secretags/json/json_get_user_tags.php", 
					//async = true,
					{ user_id : user_id})
					.done(function(data)
					{
						$( "#loading" ).hide();
						tags = JSON.parse(data); // after receiving make a object from it
						
						if(tags.success == 1)
						{
							var varhtml = '';
										
								for(var i=0;i<tags.user_tags.length;i++)
								{
									tag = tags.user_tags[i];
									
									if(i==8 && all==0)
										break;
									varhtml = varhtml+'<a href="http://localhost/Secretags/tags/tag/'+tag.tag_id+'"><li class="label label-info" >#'+tag.tag+'</li></a><li class = "muted" > x '+tag.total_posts+'</li></br>';
								}
								//alert(data);
								if(all==0)
									varhtml = varhtml+'<a href="http://localhost/Secretags/tags/tag/'+tag.tag_id+'" onClick="refreshTags('+user_id+',1); return false;"><li id="more_tags">more</li><b class="caret"></b></a>';
									
									
									
								$('#user_tags').html('<li style = "color:#4E4E4E;">Tags Following:</li></br>'+varhtml);
								
								
						}
						
					});
					
				}
			