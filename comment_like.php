<?
require_once 'functions/db_connect.php';

    // connecting to db
    $db = new DB_CONNECT();

	$comment_id = $_POST['comment_id'];
	$user_id = $_POST['user_id'];
	$time = time();
	$text = "You got a like in your comment";

	
	$check = mysql_query("SELECT * FROM comment_like WHERE comment_id = '$comment_id' AND user_id = '$user_id' ");

	if(mysql_num_rows($check)==0)
	{
		mysql_query("INSERT INTO comment_like (comment_id,user_id) 
									VALUES ('$comment_id','$user_id')");
									
		
		
		$get_who_commented = mysql_query("SELECT * FROM comment WHERE comment_id = '$comment_id'");
			while($row = mysql_fetch_array($get_who_commented))
				{
				$user_conff = $row["user_id"];
				$conff_id = $row['conff_id'];
				mysql_query("INSERT INTO notification(user_id,text,seen,time,link) 
									VALUES ('$user_conff','$text',0,'$time','$conff_id')");
				}
				
		mysql_query("UPDATE conff SET activity_time = $time
				WHERE conff_id = $conff_id ");
	}
	else 
	{
		mysql_query("DELETE FROM comment_like WHERE comment_id = '$comment_id' AND user_id = '$user_id' ");
	}
	
?>