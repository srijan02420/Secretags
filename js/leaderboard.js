
				// Main Long Poll function
				function leaderboard(user_id)
				{
					
					// Open an AJAX call to the server's Long Poll PHP file
					$.get("http://localhost/Secretags/json/json_get_scoreboard.php", 
					//async = true,
					{ user_id : user_id})
					.done(function(data)
					{
					//alert(data);
					$( "#loading" ).hide();
						score = JSON.parse(data);
						scor = score.points.sort(SortByID);
						
						if(score.success == 1)
						{
							
							//alert(scor[0]);
							var varhtml = '';var var2html='';
							var temp,user_rank;
							for(var i=0;i<scor.length;i++)
							{
								if(scor[i].user_id==user_id)
											{temp = '<tr>'+
												'<td style = "background-color : #7F7F7F; box-shadow: 0px 0px 5px #171717; ">'+(i+1)+'</td><td style = "background-color : #7F7F7F; box-shadow: 0px 0px 5px #171717; ">'+scor[i].name+'</td><td style = "background-color : #7F7F7F; box-shadow: 0px 0px 5px #171717; ">'+scor[i].score+'</td>'+
											'</tr>';
											user_rank = i+1;
											}
								else
									{temp = '<tr>'+
												'<td style = "">'+(i+1)+'</td><td >'+scor[i].name+'</td><td >'+scor[i].score+'</td>'+
											'</tr>';}
								
								varhtml += temp;
							}
							
							if(user_rank==1 || user_rank==2)
								user_rank=3;
							
							else if(user_rank==scor.length || user_rank==scor.length-1)
								user_rank=(scor.length-1)-5+3;
							
							else
								user_rank=user_rank;
								
							for(i=user_rank-3;i<=user_rank+1;i++)
							{
								
								if(i>=0 && i<scor.length)
								{
								if(scor[i].user_id==user_id)
											{temp = '<tr>'+
												'<td style = "background-color : #7F7F7F; box-shadow: 0px 0px 5px #171717; ">'+(i+1)+'</td><td style = "background-color : #7F7F7F; box-shadow: 0px 0px 5px #171717; ">'+scor[i].name+'</td><td style = "background-color : #7F7F7F; box-shadow: 0px 0px 5px #171717; ">'+scor[i].score+'</td>'+
											'</tr>';
											var2html += temp;
											}
								else
									{temp = '<tr>'+
												'<td style = "">'+(i+1)+'</td><td >'+scor[i].name+'</td><td >'+scor[i].score+'</td>'+
											'</tr>';
											var2html += temp;
											}
								}
								
							}
							
							$('#leaderboard_modal').html(varhtml);
							$('#profile_leaderboard').html(var2html);
								
						}
						
					});
					
				}
				
				
			function SortByID(x,y) {
			  return -1*(x.score - y.score); 
			}
			