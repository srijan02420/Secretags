<?
require_once 'functions/db_connect.php';

    // connecting to db
    $db = new DB_CONNECT();

	$conff_id = $_POST['conff_id'];
	$user_id = $_POST['user_id'];
	$time = time();
	$text = "You got a new like on your post";
	
	$check = mysql_query("SELECT * FROM conff_like WHERE conff_id = '$conff_id' AND user_id = '$user_id' ");

	if(mysql_num_rows($check)==0)
	{
		mysql_query("INSERT INTO conff_like (conff_id,user_id) 
									VALUES ('$conff_id','$user_id')");
									
		mysql_query("UPDATE conff SET activity_time = $time
				WHERE conff_id = $conff_id ");
									
		$get_who_conff = mysql_query("SELECT * FROM conff WHERE conff_id = '$conff_id'");
			while($row = mysql_fetch_array($get_who_conff))
				{
				$user_conff = $row["user_id"];
				mysql_query("INSERT INTO notification(user_id,text,seen,time,link) 
									VALUES ('$user_conff','$text',0,'$time','$conff_id')");
				}	
	}
	else 
	{
		mysql_query("DELETE FROM conff_like WHERE conff_id = '$conff_id' AND user_id = '$user_id' ");
	}
	
?>