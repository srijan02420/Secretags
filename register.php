<?
require_once 'functions/db_connect.php';

    // connecting to db
    $db = new DB_CONNECT();

$name = $_POST['name'];
$email = $_POST['email'];
$id = $_POST['id'];
$gender = $_POST['gender'];
$location = $_POST['location'];
$pic = $_POST['pic'];
$friends = $_POST['friends'];

$fbs = explode(",",$friends);

if($gender=="male")
	$gender = 1;
else
	$gender = 2;

$check = mysql_query("SELECT * FROM users WHERE email = '$email' ");

if(mysql_num_rows($check)==0)
{
mysql_query("INSERT INTO users(user_id,email,name,gender,country,s_pic) 
						VALUES ('$id','$email','$name','$gender','$location','$pic')");
						
	for($i=0;$i<sizeof($fbs);$i++)
	{
		$fb = $fbs[$i];
		
		$check1 = mysql_query("SELECT * FROM users WHERE user_id = '$fb' ");
		if(mysql_num_rows($check1)>0)
		{
			$check2 = mysql_query("SELECT * FROM user_friend WHERE user_id = '$id' AND friend_id = '$fb'");
			if(mysql_num_rows($check2)==0)
			{
				mysql_query("INSERT INTO user_friend(user_id,friend_id) 
									VALUES ('$id','$fb')");
			}
			$check3 = mysql_query("SELECT * FROM user_friend WHERE user_id = '$fb' AND friend_id = '$id'");
			if(mysql_num_rows($check3)==0)
			{
			mysql_query("INSERT INTO user_friend(user_id,friend_id) 
								VALUES ('$fb','$id')");
			}
		}
	}
						
}
?>