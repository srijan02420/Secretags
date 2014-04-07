<?
require_once '../functions/db_connect.php';

    // connecting to db
    $db = new DB_CONNECT();

	$response = array();
	$response["tags"] = array();
	
	$get_tag = mysql_query("select tag_id, count(user_id) as c 
							from user_tag group by tag_id 
							order by c desc limit 10;");
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
					
					array_push($response["tags"], $tags_array);
				
				}//echo mysql_fetch_array($get_tag);
				
				
				$response["success"] = 1;

							// echoing JSON response
				echo json_encode($response, JSON_UNESCAPED_UNICODE);
?>
