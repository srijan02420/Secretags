<?
require_once '../functions/db_connect.php';

    // connecting to db
    $db = new DB_CONNECT();
	$user_id = $_GET['user_id'];
	$response = array();
	$response["user_tags"] = array();
	
	$get_tag = mysql_query("SELECT tag_id FROM user_tag where user_id = $user_id ");
	$i =0 ;
			while($row = mysql_fetch_array($get_tag))
				{
					 //print_r($row);
					$total_user_following = mysql_num_rows(mysql_query("SELECT id FROM user_tag where tag_id = $row[0] "));
					$total_posts = mysql_num_rows(mysql_query("SELECT id FROM conff_tag where tag_id = $row[0] "));
					
					$get_tags = mysql_query("SELECT tag FROM tag where tag_id = $row[0] ");
					
					$tag_name = mysql_fetch_assoc($get_tags);
					$tag_name = $tag_name['tag'];
				
					
					$tags_array = array();
					$tags_array["tag_id"] = $row[0];
					$tags_array["tag"] = $tag_name;
					$tags_array["users_following"] = $total_user_following;
					$tags_array["total_posts"] = $total_posts;
					
					array_push($response["user_tags"], $tags_array);
				
				}//echo mysql_fetch_array($get_tag);
				
				
				$response["success"] = 1;

							// echoing JSON response
				echo json_encode($response);
?>
