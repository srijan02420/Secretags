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

$query_comment = mysql_query("SELECT comment_id FROM comment where user_id = $user_id ;");
		
		$comments = mysql_num_rows($query_comment);
		$got_comment_like = 0;
						while($row = mysql_fetch_array($query_comment))
						{
							$t =  $row['comment_id'];
							$got_comment_likes = mysql_query("SELECT id FROM comment_like where comment_id = $t and user_id NOT IN ($user_id);");
							$got_comment_like = $got_comment_like + mysql_num_rows($got_comment_likes);
						}
		
$query_likes = mysql_query("SELECT id FROM conff_like where user_id = $user_id ;");
		$likes = mysql_num_rows($query_likes);

$query_comment_likes = mysql_query("SELECT id FROM comment_like where user_id = $user_id ;");
		
		$comment_likes = mysql_num_rows($query_comment_likes);
		
$query_shares = mysql_query("SELECT id FROM user_share where user_id = $user_id ;");
		
		$shares = mysql_num_rows($query_shares);

								// temp user array
								
								$response["user_id"] = $user_id;
								$response["comments"] = $comments;
								$response["likes"] = $likes;
								$response["comment_likes"] = $comment_likes;
								$response["got_comment_likes"] = $got_comment_like;
								$response["shares"] = $shares;
								
								//////////////////////////////////////////////////////////////////////////////////////////////////////////
								
								//array_push($response["points"], $response);
								
							$response["success"] = 1;

							// echoing JSON response
							echo json_encode($response);
				
	


?>
