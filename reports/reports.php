<?php
session_start();

$con = @mysql_connect('localhost','root','');
if (!$con) die("Could not connect to the server!"); 
if (!@mysql_select_db('ieproj')) die('Couldn\'t locate the database!');
?>

<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<link rel="stylesheet" type="text/css" href="../style.css">
	<title>בית ספר בינלאומי</title>
</head>
<body>
	<header>
		<a href="http://int.technion.ac.il"><img src="../logo.png" alt="Technion logo"></a>
		<div id="index_description">
			מערכת לחיזוי הצלחת מועמדים
		</div>
		<div class="session">
			<?php
			if (isset($_SESSION['curruser']))
			{
				echo "".$_SESSION['curruser']." רשום כ ";
				echo '<br>';
				echo '<a class="btn" href="../logout.php">יציאה</a>';
			}
			else
			{
				echo "נא הירשם למערכת";
			}
			?>
		</div>
	</header>
	<nav>
		<ul>
			<li><a href="../index.php" >כניסת משתמש</a></li>
			<li><a href="../newstud/newstud.php" >הוספת מועמד</a></li>
			<li><a class="active">הפקדת דוח"ות</a></li>
			<li><a href="../update/update.php" >עדכון מסד נתונים</a></li>
			<li><a href="../newacc/newacc.php" >רישום משתמש חדש</a></li>
		</ul>
	</nav>
	<?php
  if (isset($_SESSION['curruser']))
  {
    ?>
	    <iframe src="http://localhost:3838/apps/classify/"></iframe> 
  <?php 
} else {
  ?>
  <div class="loggedout">נא הירשם למערכת</div>
  <?php
}
?>
		
</body>
</html>