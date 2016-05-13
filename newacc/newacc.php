<?php
session_start();
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
          <form id="reg-form">
            <div>
              <input type="text" id="username" spellcheck="false" autofocus="" style="text-align:right;" placeholder="שם משתמש"/>
              <label for="name">שם משתמש</label>
            </div>
            <div>
              <input type="text" id="email" spellcheck="false" style="text-align:right;" placeholder="אי-מייל"/>
              <label for="email">דוא"ל</label>
            </div>
            <div>
              <input type="password" style="text-align:right;" id="סיסמא" />
              <label for="password">סיסמא</label>
            </div>
            <div>
              <input type="password" style="text-align:right;" id="הכנס סיסמא שנית" />
              <label for="password-again">סיסמא שנית</label>
            </div>
            <div>
              <input type="submit" value="צור משתמש" id="create-account" class="button"/>
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
</body>
</html>