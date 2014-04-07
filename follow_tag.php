<?
require_once 'functions/db_connect.php';

    // connecting to db
    $db = new DB_CONNECT();

	$user_id = $_POST['user_id'];
	$tag_id = $_POST['tag_id'];
	
	
	$check = mysql_query("SELECT * FROM user_tag WHERE tag_id = '$tag_id' AND user_id = '$user_id' ");

	if(mysql_num_rows($check)==0)
	{
		mysql_query("INSERT INTO user_tag (tag_id,user_id) 
									VALUES ('$tag_id','$user_id')");
		
	}
	else 
	{
		mysql_query("DELETE FROM user_tag WHERE tag_id = '$tag_id' AND user_id = '$user_id' ");
	}
	
?>