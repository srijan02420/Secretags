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

//$conff_id = $_GET['conff_id'];
$time = time();

$get_comments = mysql_query("SELECT * FROM comment ;");
	if (mysql_num_rows($get_comments) > 0) 
				{
					$response["comment"] = array();
					while($row = mysql_fetch_array($get_comments))
						{
							if( $time - $row['time'] < 1000){
								
								$time = time_elapsed_string($row['time']);
								//echo time();
								//echo $row->comment_id;
								$comment_id = $row['comment_id'];
								
								$get_likes = mysql_query("SELECT * FROM comment_like where comment_id = ".$comment_id." ;");
								$total_likes = mysql_num_rows($get_likes);
								if($total_likes==null)
									$total_likes = 0;
								$liked = false;
								while($row1 = mysql_fetch_array($get_likes))
								{
									if($row1['user_id']==$user_id)
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
								$comment["total_likes"] = $total_likes;
								$comment["user_name"] = $name;
								$comment["photo"] = $s_pic;
								

								// push single product into final response array
								array_push($response["comment"], $comment);
								//echo $conff["conff_id"];
								
								}
								
						}
							// success
							$response["success"] = 1;

							// echoing JSON response
							echo json_encode($response);
							
				} else {
    // no products found
    $response["success"] = 0;
    $response["message"] = "No products found";

    // echo no users JSON
    echo json_encode($response);
}


?>
