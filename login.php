<?php

session_start();

$host = "localhost";
$db_user = "root";
$db_pass = "";
$db = "ieproj";

$con = @mysql_connect($host, $db_user, $db_pass);
if (!$con) die("Could not connect to the server!"); 
if (!@mysql_select_db($db)) die('Couldn\'t locate the database!');

if(isset($_POST['submit']))
{
	$username = $_POST['username'];
	$password = $_POST['password'];
	$sql = "SELECT * FROM users WHERE username='".$username."' AND password='".$password."' LIMIT 1";
	$res = mysql_query($sql);
	if (mysql_num_rows($res) == 1)
	{
		$_SESSION['curruser']=$username;
		header("Location: index.php"); 
    	exit();
	}
	else
	{
		echo "Invalid password";
		exit();
	}
}
?>