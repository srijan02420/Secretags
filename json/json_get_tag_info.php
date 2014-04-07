<?
require_once '../functions/db_connect.php';

    // connecting to db
    $db = new DB_CONNECT();
	$tag_id = $_GET['tag_id'];
	$user_id = $_GET['user_id'];
	$response = array();

	

					 //print_r($row);
					$total_user_following = mysql_num_rows(mysql_query("SELECT id FROM user_tag where tag_id = $tag_id "));
					$follow = mysql_num_rows(mysql_query("SELECT id FROM user_tag where tag_id = $tag_id and user_id = $user_id "));
					$total_posts = mysql_num_rows(mysql_query("SELECT id FROM conff_tag where tag_id = $tag_id "));
					
					$get_tags = mysql_query("SELECT tag FROM tag where tag_id = $tag_id  ");
					
					$tag_name = mysql_fetch_assoc($get_tags);
					$tag_name = $tag_name['tag'];
				
						if($follow>0)
							$response["follow"] = 'Unfollow';
						else
							$response["follow"] = 'Follow';
				
					$response["tag_id"] = $tag_id;
					$response["tag"] = $tag_name;
					$response["users_following"] = $total_user_following;
					$response["total_posts"] = $total_posts;
					
				$response["success"] = 1;

							// echoing JSON response
				echo json_encode($response, JSON_UNESCAPED_UNICODE);
?>
