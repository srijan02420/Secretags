<?
require_once '../functions/db_connect.php';
$user_id = $_GET['user_id'];
    // connecting to db
    $db = new DB_CONNECT();

	$get_tag = mysql_query("SELECT * FROM tag ");
	$i =0 ;
			while($row = mysql_fetch_array($get_tag))
				{
					// print_r($row);
				$data[$i] = array("tag"=>$row['tag'],"tag_id"=>$row['tag_id'],"tag_friend"=>0);	 
					$i++;
				}//echo mysql_fetch_array($get_tag);
				
				$get_tag = mysql_query("SELECT friend_id FROM user_friend where user_id = $user_id ");
	
			while($friend_id = mysql_fetch_array($get_tag))
				{
					$id = $friend_id['friend_id'];
					$row = mysql_fetch_assoc(mysql_query("SELECT * FROM users where user_id = $id "));
					// print_r($row);
				$data[$i] = array("tag"=>$row['name'],"tag_id"=>$row['user_id'],"tag_friend"=>1);	 
					$i++;
				}//echo mysql_fetch_array($get_tag);
				
				echo json_encode($data);
?>
