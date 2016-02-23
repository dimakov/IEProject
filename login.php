<?php

$host = "localhost";
$db_user = "root";
$db_pass = "";
$db = "ieproj";

mysql_connect($host, $db_user, $db_pass);
mysql_select_db($db);

if(isset($_POST['submit']))
{
	$username = $_POST['username'];
	$password = $_POST['password'];
	$sql = "SELECT * FROM users WHERE username='".$username."' AND password='".$password."' LIMIT 1";
	$res = mysql_query($sql);
	if (mysql_num_rows($res) == 1)
	{
		echo "OK";
		exit();
	}
	else
	{
		echo "Invalid password";
		exit();
	}
}
?>