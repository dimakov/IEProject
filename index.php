<?php
session_start();
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
      <li><a class="active">כניסת משתמש</a></li>
      <li><a href="newstud/newstud.php" >הוספת סטודנט חדש</a></li>
      <li><a href="reports/reports.php" >הפקדת דוח"ות</a></li>
      <li><a href="/newstud/newstud.php" >הוספת סטודנט חדש</a></li>
      <li><a href="/newstud/newstud.php" >הוספת סטודנט חדש</a></li>
      <li><a href="newacc/newacc.php" >רישום משתמש חדש</a></li>
    </ul>
  </nav>
  <div class="login-page">
    <div class="form">
      <form class="login-form" action="login.php" method="POST">
        <input style="text-align:right;" type="text" name="username" autofocus="" placeholder="שם משתמש"/>
        <input style="text-align:right;" type="password" name="password" placeholder="סיסמא"/>
        <input id="submit_button" name="submit" value="כניסה" type="submit">
      </form>
    </div>
  </div>
  <footer>
    כל הזכויות שמורות 
  </footer>
</body>
</html>