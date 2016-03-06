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
				echo '<a href="../logout.php">יציאה</a>';
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
			<!--<li><a href="/newstud/newstud.php" >הוספת סטודנט חדש</a></li> -->
			<li><a href="../newacc/newacc.php" >רישום משתמש חדש</a></li>
		</ul>
	</nav>
	<?php
	if (isset($_SESSION['curruser']))
	{
		?>
		<div class="main">
			<?php
			$sql = "SELECT * FROM students;";
			$result = mysql_query($sql);
			if(mysql_num_rows($result) > 0)
			{                  
				echo "<table style='margin-left: 150px;'>";
				echo "<br><th colspan='13' style='text-align:center; font-size: 20px; background-color: #4CAF50; color: white;'>רשימת כל הסטודנטים במערכת</th>";
				echo "<tr><td>ID</td><td>Date</td><td>Country</td><td>City</td><td>District</td><td>School</td><td>Grade AR</td><td>Age</td><td>University</td><td>Success</td><td>Applicant</td><td>Student</td><td>Graduate Student</td></tr>";
				while ($stud_array = mysql_fetch_array($result))
				{
					$stud_array[9] ? $stud_array[9]='Yes' : $stud_array[9]='No';
					$stud_array[10] ? $stud_array[10]='Yes' : $stud_array[10]='No';
					$stud_array[11] ? $stud_array[11]='Yes' : $stud_array[11]='No';
					$stud_array[12] ? $stud_array[12]='Yes' : $stud_array[12]='No';
					echo "<tr><td>".$stud_array[0]."</td><td>".$stud_array[1]."</td><td>".$stud_array[2]."</td><td>".$stud_array[3]."</td><td>".$stud_array[4]."</td><td>".$stud_array[5]."</td><td>".$stud_array[6]."</td><td>".$stud_array[7]."</td><td>".$stud_array[8]."</td><td>".$stud_array[9]."</td><td>".$stud_array[10]."</td><td>".$stud_array[11]."</td><td>".$stud_array[12]."</td></tr>";
				}
				echo "</table>";
			}
			?>
		</div>
		<?php 
	} else {
		?>
		<div class="loggedout">נא הירשם למערכת</div>
		<?php
	}
	?>
	<footer>
		כל הזכויות שמורות 
	</footer>
</body>
</html>