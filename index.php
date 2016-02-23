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
      <li><a href="newstud/newstud.html" title="">הוספת סטודנט חדש</a></li>
      <li><a href="reports/reports.php" title="">הפקדת דוח"ות</a></li>
      <li><a href="/newstud/newstud.html" title="">הוספת סטודנט חדש</a></li>
      <li><a href="/newstud/newstud.html" title="">הוספת סטודנט חדש</a></li>
      <li><a href="newacc/newacc.html" title="">רישום משתמש חדש</a></li>
    </ul>
  </nav>
  <div class="login-page">
    <div class="form">
      <form class="login-form" action="login.php" method="POST">
        <input type="text" name="username" autofocus="" placeholder="Username"/>
        <input type="password" name="password" placeholder="Password"/>
        <input id="submit_button" name="submit" value="Login" type="submit">
        <p class="message" style="font-size: 16px;">Not registered? <a href="newacc/newacc.html">Create an account</a></p>
      </form>
    </div>
  </div>
  <footer>
    כל הזכויות שמורות 
  </footer>
</body>
</html>