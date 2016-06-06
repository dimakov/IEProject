
<?php
session_start();

$host = "localhost";
$db_user = "root";
$db_pass = "";
$db = "ieproj";

$con = @mysql_connect($host, $db_user, $db_pass);
if (!$con) die("Could not connect to the server!"); 
if (!@mysql_select_db($db)) die('Couldn\'t locate the database!');

 // Retrieve data from Query String
$mode = $_GET['mode'];
$id = $_GET['id'];

// Escape User Input to help prevent SQL Injection
// $mode = mysql_real_escape_string($mode);
// $id = mysql_real_escape_string($id);

//build query

$set_app = 1;

if ($mode == 0)
{
	$set_app = 0;
}
else
{
	if ($mode == 1)
	{
		$set_app = 1;
	}
	else
	{
		die("Unable to recognize mode!"); 
	}
}

$query = "UPDATE students SET Pass_mechina=".$set_app." WHERE ID=".$id.";";

$result = mysql_query($query);

if(mysql_affected_rows($result) > 0)
{
	echo "Success";
}
else
{
	echo "Failure";
}

$response_array['status'] = 'success';    

echo json_encode($response_array);
exit;
?>