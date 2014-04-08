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

$response["points"] = array();

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
		$get_who_is = mysql_query("SELECT * FROM users where user_id = ".$user_id." ;");
								$get_who_is_info = mysql_fetch_row($get_who_is);
								$name = $get_who_is_info[2];
								
								$user_points = array();
								$user_points["user_id"] = $user_id;
								$user_points["comments"] = $comments;
								$user_points["likes"] = $likes;
								$user_points["got_comment_likes"] = $got_comment_like;
								$user_points["comment_likes"] = $comment_likes;
								$user_points["shares"] = $shares;
								$user_points["name"] = $name;
								$user_points['score'] = ($comments*1) + ($got_comment_like*5);
								
								array_push($response["points"],$user_points);
		
$get_friends = mysql_query("SELECT friend_id FROM user_friend where user_id = ".$user_id." ;");

while($row = mysql_fetch_array($get_friends))
{	
		$user_id = $row['friend_id'];
					$query_comment = mysql_query("SELECT comment_id FROM comment where user_id = $user_id ;");

						$comments = mysql_num_rows($query_comment);
						$got_comment_like = 0;
						while($row = mysql_fetch_array($query_comment))
						{
							$t =  $row['comment_id'];
							$got_comment_likes = mysql_query("SELECT id FROM comment_like where comment_id = $t and user_id NOT IN ($user_id) ;");
							$got_comment_like = $got_comment_like + mysql_num_rows($got_comment_likes);
						}
						
				$query_likes = mysql_query("SELECT id FROM conff_like where user_id = $user_id ;");
						$likes = mysql_num_rows($query_likes);

				$query_comment_likes = mysql_query("SELECT id FROM comment_like where user_id = $user_id ;");
						
						$comment_likes = mysql_num_rows($query_comment_likes);
						
						
				$query_shares = mysql_query("SELECT id FROM user_share where user_id = $user_id ;");
				$get_who_is = mysql_query("SELECT * FROM users where user_id = $user_id ;");
								$get_who_is_info = mysql_fetch_assoc($get_who_is);
								$name = $get_who_is_info['name'];
								//echo $name;
						$shares = mysql_num_rows($query_shares);
						
								$user_points = array();
								$user_points["user_id"] = $user_id;
								$user_points["comments"] = $comments;
								$user_points["likes"] = $likes;
								$user_points["got_comment_likes"] = $got_comment_like;
								$user_points["comment_likes"] = $comment_likes;
								$user_points["shares"] = $shares;
								$user_points["name"] = $name;
								$user_points['score'] = ($comments*1) + ($got_comment_like*5);
								
								array_push($response["points"],$user_points);
								
}
							//print_r($response);
							
							$response["success"] = 1;

							// echoing JSON response
							echo json_encode($response);
				
	


?>
