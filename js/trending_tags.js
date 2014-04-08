
				// Main Long Poll function
				function trendingTags()
				{
					
					// Open an AJAX call to the server's Long Poll PHP file
					$.get("http://localhost/Secretags/json/json_get_trending_tags.php"
					//async = true,
					)
					.done(function(data)
					{
						$( "#loading" ).hide();
						tags = JSON.parse(data); // after receiving make a object from it
						
						if(tags.success == 1)
						{
							var varhtml = '';
										
								for(var i=0;i<tags.tags.length;i++)
								{
									tag = tags.tags[i];
									
									varhtml = varhtml+'<a href="http://localhost/Secretags/tags/tag/'+tag.tag_id+'"><li class="label label-info" >#'+tag.tag+'</li></a><li class = "muted" > x '+tag.total_posts+'</li></br>';
								}
									
								$('#trending_tags').html('<li style = "color:#4E4E4E;">Trending Tags</li></br>'+varhtml);
								
								
						}
						
					});
					
				}
			