<?php
session_start();

$_SESSION['stud_ID_glob'] = 0;

$host = "localhost";
$db_user = "root";
$db_pass = "";
$db = "ieproj";

$con = @mysql_connect($host, $db_user, $db_pass);
if (!$con) die("Could not connect to the server!"); 
if (!@mysql_select_db($db)) die('Couldn\'t locate the database!');
?>

<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <link rel="stylesheet" type="text/css" href="style.css">
  <title>בית ספר בינלאומי</title>
</head>
<body>
  <header>
    <a href="http://int.technion.ac.il"><img src="logo.png" alt="Technion logo"></a>
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
      <?php
      if(isset($_POST['submit']))
      {
        $username = $_POST['username'];
        $password = $_POST['password'];
        $sql = "SELECT * FROM users WHERE username='".$username."' AND password='".$password."' LIMIT 1";
        $res = mysql_query($sql);
        if (mysql_num_rows($res) == 1)
        {
          $_SESSION['curruser']=$username;
        }
        else
        {
          echo "Invalid password";
        }
      }
      ?>
    </div>
  </header>
  <nav>
    <ul>
      <li><a class="active">כניסת משתמש</a></li>
      <li><a href="newstud/newstud.php" >הוספת מועמד</a></li>
      <li><a href="reports/reports.php" >הפקדת דוח"ות</a></li>
      <li><a href="update/update.php" >עדכון מסד נתונים</a></li>
      <li><a href="newacc/newacc.php" >רישום משתמש חדש</a></li>
    </ul>
  </nav>
  <?php
  if (!isset($_SESSION['curruser']))
  {
    ?>
    <div class="login-page">
      <div class="form">
        <form class="login-form" action="<?php $_SERVER['PHP_SELF']?>" method="POST">
          <input style="text-align:right;" type="text" name="username" autofocus="" placeholder="שם משתמש"/>
          <input style="text-align:right;" type="password" name="password" placeholder="סיסמא"/>
          <input id="submit_button" name="submit" value="כניסה" type="submit">
        </form>
      </div>
    </div>
    <?php 
  } 
  else 
  {
    echo '<div class="loggedout">'.$_SESSION['curruser'].' רשום כ </div>';
    echo '<a class="btn_exit" href="../logout.php">יציאה</a>';
  }
  ?>
</body>
</html>