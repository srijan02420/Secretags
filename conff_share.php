<?
require_once 'functions/db_connect.php';

    // connecting to db
    $db = new DB_CONNECT();

	$conff_id = $_POST['conff_id'];
	$user_id = $_POST['user_id'];
	
	$share = "share";
	$r = 1;
				mysql_query("UPDATE conff SET $share=$share+$r  WHERE conff_id='$conff_id'");
				
				$check = mysql_query("SELECT id FROM user_share WHERE conff_id = '$conff_id' AND user_id = '$user_id' ");

	if(mysql_num_rows($check)==0)
	{
		mysql_query("INSERT INTO user_share (conff_id,user_id) 
									VALUES ('$conff_id','$user_id')");
	}  
?>