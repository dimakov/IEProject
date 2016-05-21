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
  <link rel="stylesheet" type="text/css" href="newacc.css">
  <link rel="stylesheet" type="text/css" href="../style.css">
  
  <script src="newaccjs"></script>
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
      <li><a href="../index.php">כניסת משתמש</a></li>
      <li><a href="../newstud/newstud.php" >הוספת מועמד</a></li>
      <li><a href="../reports/reports.php" >הפקדת דוח"ות</a></li>
      <li><a href="../update/update.php" >עדכון מסד נתונים</a></li>
      <li><a class="active" >רישום משתמש חדש</a></li>
    </ul>
  </nav>
  <?php
  if (isset($_SESSION['curruser']))
  {
    ?>
    <div class="main">
      <div class="one">
        <div class="register">
          <h3>צור משתמש חדש</h3>
          <form action="<?php $_SERVER['PHP_SELF']?>" method="POST">
            <div>
              <input type="text" id="username" spellcheck="false" autofocus="" style="text-align:right;" placeholder="שם משתמש" name="username"/>
              <label for="name">שם משתמש</label>
            </div>
            <div>
              <input type="password" style="text-align:right;" id="סיסמא" name="password"/>
              <label for="password">סיסמא</label>
            </div>
            <div>
              <input type="submit" value="צור משתמש" id="create-account" class="button" name="submit"/>
            </div>
          </form>
        </div>
      </div>
    </div>
  </div>
  <?php 
} else {
  ?>
  <div class="loggedout">נא הירשם למערכת</div>
  <?php
}
?>

<?php
  if (isset($_POST['submit']))
  {
    $username='';
    $password='';
    if (!isset($_POST["username"]))
    {
        echo "<h3>No User Name entererd. Please enter ID of the student.</h3><br>";
    }
    else
    {
        $username=$_POST["username"];
    }
    if (!isset($_POST["password"]))
    {
        echo "<h3>No Password entererd. Please enter ID of the student.</h3><br>";
    }
    else
    {
        $password=$_POST["password"];
    }
    $sql="INSERT INTO users(username,password) VALUES('".$username."','".$password."');";
    $result=mysql_query($sql);
    if (!$result)
    {
        die("Couldn't add this Service Call to the data base".mysql_error());
    }
    else
    {
        echo "<div style='margin-left:29%; font-size:34px; color:green;'>המשתמש נרשם בהצלחה</div>";
    }
  }
?>
</body>
</html>