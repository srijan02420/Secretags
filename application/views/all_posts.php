<?
					$orconff = "conff_id = ".$conff[0];
					for($i=1;$i<sizeof($conff);$i++)
					{
						$orconff = $orconff." or conff_id = ".$conff[$i];
					}
					//print_r($orconff);
					//for($i=sizeof($conff)-1;$i>=0;$i--)
					//{
						$get_conff = $this->db->query("SELECT * FROM conff where $orconff order by time desc limit 100;");

						foreach($get_conff->result() as $row)
						{
								$total_shares = $row->share;
								$time_conff = time_elapsed_string($row->time);
								//echo time();
								//echo $row->conff_id;
								$conff_id = $row->conff_id;
								$confession = $row->conff;
								$get_likes = $this->db->query("SELECT * FROM conff_like where conff_id = ".$conff_id." ;");
								$total_likes = $get_likes->num_rows;
								$liked = false;
								foreach($get_likes->result() as $row)
								{
									if($row->user_id==$user_id)
										$liked = true;
									//print_r($row->user_id);
									 
								}
								
								?>
							<li class="media" id="conff<?=$conff_id?>">
								<a class="pull-left" href="#"><img src="http://secretags.com/images/anon.png" class="media-object" width = "84px"></a>
								
								<div class="media-body">
									<p6 class="media">
										<?
											$get_tags_id = $this->db->query("SELECT * FROM conff_tag where conff_id = ".$conff_id." ;");
											foreach($get_tags_id->result() as $row)
											{
												$get_tags_names = $this->db->query("SELECT * FROM tag where tag_id = ".$row->tag_id." ;");
												foreach($get_tags_names->result() as $row)
												{
													?><span class="label label-inverse">#<?=$row->tag?></span><?
												}
											}									
										?>
										</br>
											<?=$confession?>
									</p6 >


									<ul class="inline">
									<li class="text-info"><a onClick="like(<?=$conff_id?>,this)"><?if($liked==true)echo 'Unlike';else echo 'Like';?></a>&nbsp&nbsp<i class="icon-star"></i><span class="nooflikes<?=$conff_id?>"><?=$total_likes?></span></li>
									<li class="text-info"><a href="#" onClick="showComm(<?=$conff_id?>); return false;">Comment</a>&nbsp&nbsp<i class="icon-comment"></i> 12</li>
									<li class="text-info"><a onclick='postToFeed(<?=$conff_id?>); return false;'>Share</a>&nbsp&nbsp<i class="icon-share"></i><span class="noofshares<?=$conff_id?>"><?=$total_shares?></span></li>
									<li class="muted" ><?=$time_conff?></li>
									</ul>
									
										<div class="media">
											<ul class="breadcrumb comments" id="<?=$conff_id?>" >
												<div id="comments<?=$conff_id?>">
													<?
													$get_comment = $this->db->query("SELECT * FROM comment where conff_id = ".$conff_id." ;");	
															foreach($get_comment->result() as $row)
															{
																$get_who_commented = $this->db->query("SELECT * FROM users where user_id = ".$row->user_id." ;");
																$comment_id = $row->comment_id;
																//print_r($row);
															
																$get_comment_likes = $this->db->query("SELECT * FROM comment_like where comment_id = ".$comment_id." ;");
																$liked_comment = false;
																$total_likes_comment = $get_comment_likes->num_rows;
																foreach($get_comment_likes->result() as $nolikes)
																{
																	if($nolikes->user_id==$user_id)
																		$liked_comment = true;
																	//print_r($nolikes->user_id);
																}
																?>
									
																<div class="media-body" id="comment<?=$comment_id?>">		<!---comment starts-->
																	<div class="row-fluid">
																		<div class="span1 ">
																			<li ><a href="#"><img src="<?=$get_who_commented->row()->s_pic?>"></a></li>							   
																		</div>
																		<div class="span11 ">
																			
																			<li ><a href="#"><strong><?=$get_who_commented->row()->name?>&nbsp </a></strong><?=$row->comment?></li>
																				<ul class="inline">
																					<li class="text-info"><a onClick="like_comment(<?=$comment_id?>,this)"><?if($liked_comment==true)echo 'Unlike';else echo 'Like';?></a>&nbsp&nbsp<i class="icon-star"></i><span class="noofcommentlikes<?=$comment_id?>"><?=$total_likes_comment?></span></li>
									
																					<li class="muted" ><?=time_elapsed_string($row->time)?></li>
																				</ul>				
																		</div>
																	</div>
																	</br>
																</div>						<!---comment ends-->
															<?
															}
														?>	
												</div>
															<!-----------------------------user comment input --------------->
																<div class="media-body">
																	<div class="row-fluid"  >
																		<div class="span1 " >
																			
																			<li ><a href="#"><img src="<?=$photo?>"></a></li>							   
																			
																		</div>
																		<div class="span11 ">
																			<form id="post_comment<?=$conff_id?>">
																				
																				<textarea rows="1" id="comment<?=$conff_id?>"></textarea>
																				<ul class="inline ">
																						<!--<ul class="dropdown pull-left">
																							 
																							<a data-toggle="dropdown" class = "muted pull-left"><i class="icon-user"></i>Comment As<b class="caret"></b></a>
												
																							<ul class="dropdown-menu" id="gender">
												
																							  <li><a href="#">Self</a></li>
																							  <li><a href="#">Anon Male</a></li>
																							  <li><a href="#">Anon Female</a></li>
																							  <li><a href="#">Anon Other</a></li>
																																  
																							</ul>
																						</ul>-->
																						<i class="icon-user"></i>
																						<select id="gender<?=$conff_id?>" value="Comment As" class="input-small" placeholder="Comment As">
																						  <option value="0">Self</option>
																						  <option value="1">Anon Male</option>
																						  <option value="2">Anon Female</option>
																						  <option value="3">Anon Other</option>
																						</select>
																						<li><input type="submit" class="btn btn-mini btn-inverse offset4" onClick="add_comment(<?=$conff_id?>);return false;" value="Comment"></li>
																				</ul>
																			</form>
																		</div>
																	</div>
																</div>	
											</ul>
										</div>
														
									<!-- Nested media object -->
								</div>
							</li>
							<?	
						}					
						?>