<?php

/*
 * Following code will list all the products
 */

// array for JSON response
$response = array();

// include db connect class
require_once '../functions/db_connect.php';

// connecting to db
$db = new DB_CONNECT();

$user_id = $_GET['user_id'];
$my_id = $_GET['my_id'];
$time = time();
$conff = array();
$liked_arr = array();
$commented = array();

$query_comment = mysql_query("SELECT * FROM comment where user_id = $user_id limit 100 ;");
		while($row = mysql_fetch_array($query_comment))
		{
				array_push($conff, $row['conff_id']);
				array_push($commented, $row['conff_id']);
		}

		
		$like_conff = mysql_query("SELECT * FROM conff_like where user_id = $user_id limit 100 ;");
		//many conff_id
		while($row = mysql_fetch_array($like_conff))
			{
				array_push($conff, $row['conff_id']);
				array_push($liked_arr, $row['conff_id']);
			}
		//print_r($liked_arr);

		
				$result = array_unique($conff);
				$conff = array_values($result);
				
		if(sizeof($conff)>0)
		{
/////////////////////////////////////////////////////////////////////////////////////////////////////////
					$orconff = "conff_id = ".$conff[0];
					for($i=1;$i<sizeof($conff);$i++)
					{
						$orconff = $orconff." or conff_id = ".$conff[$i];
					}
						//print_r($orconff);
						//for($i=sizeof($conff)-1;$i>=0;$i--)
						//{
						$get_conff = mysql_query("SELECT * FROM conff where $orconff order by activity_time desc limit 100;");
						$response["conff"] = array();
				if (mysql_num_rows($get_conff) > 0) 
				{
					//print_r(mysql_num_rows($get_conff));
						while($row = mysql_fetch_array($get_conff))
						{
							if( $time - $row['activity_time'] < 50 || $_GET['first']==1){
								$time = time_elapsed_string($row['time']);
								$activity_time = $row['activity_time'];
								//echo time();
								//echo $row->conff_id;
								$conff_id = $row['conff_id'];
								
								$get_likes = mysql_query("SELECT * FROM conff_like where conff_id = ".$conff_id." ;");
								$total_likes = mysql_num_rows($get_likes);
								if($total_likes==null)
									$total_likes = 0;
								$liked = false;
								while($row1 = mysql_fetch_array($get_likes))
								{
									if($row1['user_id']==$my_id)
										$liked = true;
									//print_r($row->user_id);
									 
								}
								$conff = array();
								
								//print_r($commented);
								
								if(in_array($row['conff_id'], $commented))
									{
										$get_person_id = mysql_query("SELECT user_id FROM comment where conff_id = ".$conff_id." ORDER BY comment_id DESC LIMIT 1 ;");
										if (mysql_num_rows($get_person_id) > 0) 
										{
											$row1 = mysql_fetch_row($get_person_id);
											$get_person_name = mysql_query("SELECT name FROM users where user_id = '$row1[0]' ;");
											$person = mysql_fetch_row($get_person_name);
											$conff["special_name"] = $person[0];
											$conff["special_id"] = $row1[0];
											$conff["special_type"] = 1;
										}
									}
								
								else if(in_array($row['conff_id'], $liked_arr))
									{
										$get_person_id = mysql_query("SELECT user_id FROM conff_like where conff_id = ".$conff_id." ORDER BY id DESC LIMIT 1 ;");
										if (mysql_num_rows($get_person_id) > 0) 
										{
											$row1 = mysql_fetch_row($get_person_id);
											$get_person_name = mysql_query("SELECT name FROM users where user_id = '$row1[0]' ;");
											$person = mysql_fetch_row($get_person_name);
											$conff["special_name"] = $person[0];
											$conff["special_id"] = $row1[0];
											$conff["special_type"] = 2;
											
										}
									}
								
								
								else{
									$conff["special_name"] = '';
									$conff["special_id"] = 0;
									$conff["special_type"] = 0;
								}
								
								
							
								$get_who_is = mysql_query("SELECT * FROM users where user_id = ".$my_id." ;");
								$get_who_is_info = mysql_fetch_row($get_who_is);
								$s_pic = $get_who_is_info[8];
								$name = $get_who_is_info[2];
														
								// temp user array
								
								$conff["conff_id"] = $row['conff_id'];
								$conff["conff"] = preg_replace($quotes,$replacements,$row["conff"]);
								$conff["type"] = $row["type"];
								$conff["gender"] = $row["gender"];
								$conff["time"] = $time;
								$conff["shares"] = $row["share"];
								$conff["user_liked"] = $liked;
								$conff["total_likes"] = $total_likes;
								$conff["user_name"] = $name;
								$conff["photo"] = $s_pic;
								$conff["activity_time"] = $activity_time;

								$conff["tags"] = array();
								
						
								$get_tags_id = mysql_query("SELECT * FROM conff_tag where conff_id = ".$conff_id." ;");
											while($row2 = mysql_fetch_array($get_tags_id))
											{
												$get_tags_names = mysql_query("SELECT * FROM tag where tag_id = ".$row2['tag_id']." ;");
												$tags = mysql_fetch_row($get_tags_names);
												$tag = $tags[1];
												
												$taga = array();
												$taga["tag_id"] = $row2['tag_id'];
												$taga["tag"] = preg_replace($quotes,$replacements,$tag);
												
												array_push($conff["tags"], $taga);
											}
								
								
								
								/////////////////////////////////comments////////////////////////////////////////////////////////////////
								$get_comments = mysql_query("SELECT * FROM comment where conff_id = ".$conff_id." ;");
								
									$conff["comment"] = array();
									while($row = mysql_fetch_array($get_comments))
									{
											
											$time = time_elapsed_string($row['time']);
											
											$comment_id = $row['comment_id'];
											
											$get_likes_comments = mysql_query("SELECT * FROM comment_like where comment_id = ".$comment_id." ;");
											$total_likes_comments = mysql_num_rows($get_likes_comments);
											if($total_likes_comments==null)
												$total_likes_comments = 0;
											$liked = false;
											while($row1 = mysql_fetch_array($get_likes_comments))
											{
												if($row1['user_id']==$my_id)
													$liked = true;
												//print_r($row->user_id);
												 
											}
											$user_id_comment = $row["user_id"];
											$get_who_commented = mysql_query("SELECT * FROM users where user_id = ".$user_id_comment." ;");
											$get_who_commented_info = mysql_fetch_row($get_who_commented);
											$s_pic = $get_who_commented_info[8];
											$name = $get_who_commented_info[2];
							
											// temp user array
											$comment = array();
											$comment["conff_id"] = $row['conff_id'];
											$comment["comment_id"] = $row['comment_id'];
											$comment["user_id"] = $row["user_id"];
											$comment["comment"] = preg_replace($quotes,$replacements,$row['comment']);
											$comment["gender"] = $row["gender"];
											$comment["time"] = $time;
											$comment["user_liked"] = $liked;
											$comment["total_likes"] = $total_likes_comments;
											$comment["user_name"] = $name;
											$comment["photo"] = $s_pic;
											
											array_push($conff["comment"], $comment);
									}
								
								
								//////////////////////////////////////////////////////////////////////////////////////////////////////////
								
								// push single product into final response array
								array_push($response["conff"], $conff);
								//echo $conff["conff_id"];\\
							}
						}
							$get_profile = mysql_query("SELECT name FROM users where user_id = ".$user_id." ;");
							$profile_name = mysql_fetch_assoc($get_profile);
							$response["profile_name"] = $profile_name['name'];
							// success
							$response["success"] = 1;

							// echoing JSON response
							echo json_encode($response);
				}
				
		} else {
    // no products found
    $response["success"] = 0;
    $response["message"] = "No products found";

    // echo no users JSON
    echo htmlentities(json_encode($response),ENT_QUOTES);
}

?>
