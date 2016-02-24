<?php
session_start();
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
      <li><a href="../index.php">כניסת משתמש</a></li>
      <li><a href="../newstud/newstud.php" >הוספת סטודנט חדש</a></li>
      <li><a href="../reports/reports.php" >הפקדת דוח"ות</a></li>
      <!-- <li><a href="/newstud/newstud.php" >הוספת סטודנט חדש</a></li>
      <li><a href="/newstud/newstud.php" >הוספת סטודנט חדש</a></li> -->
      <li><a class="active" >רישום משתמש חדש</a></li>
    </ul>
  </nav>
  <div class="main">
    <h1>Here you can add new user</h1>
  </div>
  <footer>
    כל הזכויות שמורות 
  </footer>
</body>
</html>