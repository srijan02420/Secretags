<?
require_once 'functions/db_connect.php';

    // connecting to db
    $db = new DB_CONNECT();

	$user_id = $_POST['user_id'];
	$comment = $_POST['comment'];
	$gender = $_POST['gender'];
	$conff_id = $_POST['conff_id'];
	$time = time();
	$text = "You got a new comment on your post";
	
		mysql_query("INSERT INTO comment (user_id,comment,gender,time,conff_id) 
									VALUES ('$user_id','$comment','$gender','$time','$conff_id')");
									
		mysql_query("UPDATE conff SET activity_time = $time
				WHERE conff_id = $conff_id ");
									
		$get_who_conff = mysql_query("SELECT * FROM conff WHERE conff_id = '$conff_id'");
			while($row = mysql_fetch_array($get_who_conff))
				{
				$user_conff = $row["user_id"];
				mysql_query("INSERT INTO notification(user_id,text,seen,time,link) 
									VALUES ('$user_conff','$text',0,'$time','$conff_id')");
				}	
?>