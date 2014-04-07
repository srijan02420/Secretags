<?
require_once 'functions/db_connect.php';

    // connecting to db
    $db = new DB_CONNECT();

	$user_id = $_POST['user_id'];
	$tags = $_POST['tag'];
	$conff_id = $_POST['conff_id'];
	
	for($i=0;$i<sizeof($tags);$i++)
	{
	$tag = $tags[$i];
	
		$check = mysql_query("SELECT * FROM tag WHERE tag = '$tag' ");

		if(mysql_num_rows($check)==0)
		{
			mysql_query("INSERT INTO tag (tag) 
										VALUES ('$tag')");
			$last_tag = mysql_insert_id();
		}
		else
			{
			$last_tag_array = mysql_fetch_row($check);
			$last_tag = $last_tag_array[1];
			}
		
		$check1 = mysql_query("SELECT * FROM user_tag WHERE tag_id = '$last_tag' ");
		if(mysql_num_rows($check1)==0)
		{
			mysql_query("INSERT INTO user_tag (tag_id,user_id) 
										VALUES ('$tag_id','$user_id')");
		}
		mysql_query("INSERT INTO user_tag (tag_id,user_id) 
										VALUES ('$tag_id','$user_id')");
		
	}
	
?>