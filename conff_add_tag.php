<?
require_once 'functions/db_connect.php';

    // connecting to db
    $db = new DB_CONNECT();

	$conff_id = $_POST['conff_id'];
	$tag_id = $_POST['tag_id'];
	
	for($i=0;$i<sizeof($tags);$i++)
	{
	$tag = $tags[$i];
	
		$check = mysql_query("SELECT * FROM conff_tag WHERE conff_id = '$conff_id' AND tag_id = '$tag_id' ");

		if(mysql_num_rows($check)==0)
		{
			mysql_query("INSERT INTO conff_tag (conff_id,tag_id) 
										VALUES ('$conff_id','$tag_id')");
										
		}
		else 
		{
			mysql_query("DELETE FROM conff_tag WHERE conff_id = '$conff_id' AND tag_id = '$tag_id' ");
		}
	}
	
?>