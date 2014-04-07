<?
require_once 'functions/db_connect.php';

    // connecting to db
    $db = new DB_CONNECT();

	$comment_id = $_POST['comment_id'];
	
		mysql_query("DELETE FROM comment WHERE comment_id = '$comment_id' ");
	
?>