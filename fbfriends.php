<?
require_once 'functions/db_connect.php';

    // connecting to db
    $db = new DB_CONNECT();

$id = $_POST['id'];
$friends = $_POST['friends'];

$fbs = explode(",",$friends);

$check = mysql_query("SELECT * FROM users WHERE id = '$id' ");

if(mysql_num_rows($check)==0)
{
	for($i=0;$i<sizeof($fbs);$i++)
	{
		$fb = $fbs[$i];
		mysql_query("INSERT INTO user_friend(user_id,friend_id) 
								VALUES ('$id','$fb')");
	}
}
?>