<?
require_once 'functions/db_connect.php';

    // connecting to db
    $db = new DB_CONNECT();

	$conff = $_POST['conff'];
	$user_id = $_POST['user_id'];
	$gender = $_POST['gender'];
	$type = $_POST['type'];
	$time = time();
	mysql_query("INSERT INTO conff (conff,user_id,gender,type,time,activity_time) 
								VALUES ('$conff','$user_id','$gender','$type','$time','$time')");
								
	$last_conff_id = mysql_insert_id();
	echo $last_conff_id;
	
	
	if(isset($_POST['tags']))
	{
		$tags = $_POST['tags'];
		for($i=0;$i<sizeof($tags);$i++)
		{
			$tag = $tags[$i];
			$check = mysql_query("SELECT * FROM tag WHERE tag = '$tag' ");

			if(mysql_num_rows($check)==0)
			{
				mysql_query("INSERT INTO tag (tag,user_id) 
											VALUES ('$tag','$user_id')");
				$last_tag_id = mysql_insert_id();
			}
			else
				{
				$last_tag_array = mysql_fetch_row($check);
				$last_tag_id = $last_tag_array[0];
				}
			
			$check_user_tag = mysql_query("SELECT * FROM user_tag WHERE user_id = '$user_id' AND tag_id = '$last_tag_id' ");
			if(mysql_num_rows($check_user_tag)==0)
			{
				mysql_query("INSERT INTO user_tag (tag_id,user_id) 
											VALUES ('$last_tag_id','$user_id')");
			}
			mysql_query("INSERT INTO conff_tag (conff_id,tag_id) 
											VALUES ('$last_conff_id','$last_tag_id')");
		}
		
	}
	
?>