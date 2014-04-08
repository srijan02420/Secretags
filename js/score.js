
				// Main Long Poll function
				function scoretable(user_id)
				{
					
					// Open an AJAX call to the server's Long Poll PHP file
					$.get("http://localhost/Secretags/json/json_get_points.php", 
					//async = true,
					{ user_id : user_id})
					.done(function(data)
					{
						$( "#loading" ).hide();
						score = JSON.parse(data); // after receiving make a object from it
						if(score.success == 1)
						{
						var total = ((score.comments*1)+(score.got_comment_likes*5));
						
							var varhtml = 
										
								'<table>'+
									'<tr>'+
										'<td style = "width : 40%; border-right:solid white 1px;"></br>'+
											'<ul class="inline">'+
												'<li style = "font-size:30px; color:lightgrey" >'+total+'</li><li style = "color:lightgrey;">SCORE</li>'+
											'</ul>'+
										'</td>'+
										'<td >'+
										'<br/>'+
											'<ul class="inline 	">'+
												'<li style = "font-size:30px; color:lightgrey" >'+(score.got_comment_likes*5)+'</li>'+
												'<li style = "color:lightgrey;">FROM '+(score.got_comment_likes)+' LIKES ON YOUR COMMENTS</li>'+
												'</ul>'+
											'<ul class="inline">'+
												'<li style = "font-size:30px; color:lightgrey" >'+(score.comments*1)+'</li><li style = "color:lightgrey;">FROM YOUR '+score.comments+' COMMENTS</li>'+
											'</ul>'+
										'</td>'+
									'</tr>'+
								'</table>';
								
								$('#score_table').html(varhtml);
								
								
						}
						
					});
					
				}
			