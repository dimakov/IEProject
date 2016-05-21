    <?php
    session_start();

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
      <link rel="stylesheet" type="text/css" href="../style.css">
      <script src="http://ajax.aspnetcdn.com/ajax/jQuery/jquery-1.12.0.min.js"></script>
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
      <li><a href="../reports/reports.php" >הפקדת דוח"ות</a></li>
      <li><a class="active" >עדכון מסד נתונים</a></li>
      <li><a href="../newacc/newacc.php" >רישום משתמש חדש</a></li>
  </ul>
</nav>
<?php
if (isset($_SESSION['curruser']))
{
    ?>
    <div id="update_main">
      <div id="update_student">
        <form action="<?php $_SERVER['PHP_SELF']?>" method="POST">
          <input type="number" id="update_ID_search" name="update_ID_search" min="1" placeholder="הכנס מספר זהות" style="text-align: right; padding: 10px; font-size: 24px;">
          <input type="submit" id="update_ID_search_button" value="עדכון מסד כללי" id="search_stud" class="button" name="stud_search"/>
      </form>
      <?php
      if (isset($_POST["stud_search"]))
      {          
          if (!empty($_POST['update_ID_search'])){
            $_SESSION['stud_ID_glob'] = $_POST["update_ID_search"];
            $sql = "SELECT * FROM students s WHERE s.ID = ".$_POST["update_ID_search"].";";
            $result = mysql_query($sql);
            if(mysql_num_rows($result) > 0)
            {                  
              $stud_array = mysql_fetch_array($result);
              echo "<table>";
              echo "<br><th colspan='31' style='text-align:center; font-size: 20px; background-color: #4CAF50; color: white;'>נתוני הסטודנט</th>";
              echo "<tr style='font-weight:bold'><td>ID</td><td>Acceptance Date</td><td>Homeland</td><td>Current Country</td><td>City</td><td>Faculty</td><td>County</td><td>Highschool</td><td>Year of Birth</td><td>Internal bagrut</td></tr>";

              echo "<tr><td>".$stud_array[0]."</td><td>".$stud_array[1]."</td><td>".$stud_array[3]."</td><td>".$stud_array[4]."</td><td>".$stud_array[5]."</td><td>".$stud_array[2]."</td><td>".$stud_array[6]."</td><td>".$stud_array[7]."</td><td>".$stud_array[8]."</td><td>".$stud_array[9]."</td></tr><tr></tr><tr></tr>";
              echo "<tr style='font-weight:bold'><td>Math 11</td><td>Math 12</td><td>Physics 11</td><td>Physics 12</td><td>Learning Disabilities</td><td>English Test</td><td>English Grade</td><td>English Test Type</td><td>Sorting Test</td><td>ST Math Grade</td></tr>";
              $stud_array[14] ? $stud_array[14]='Yes' : $stud_array[14]='No';
              $stud_array[15] ? $stud_array[15]='Yes' : $stud_array[15]='No';
              echo "<tr><td>".$stud_array[10]."</td><td>".$stud_array[11]."</td><td>".$stud_array[12]."</td><td>".$stud_array[13]."</td><td>".$stud_array[14]."</td><td>".$stud_array[15]."</td><td>".$stud_array[16]."</td><td>".$stud_array[17]."</td><td>".$stud_array[18]."</td><td>".$stud_array[19]."</td></tr><tr></tr><tr></tr>";
              
              echo "<tr style='font-weight:bold'><td>ST Physics Grade</td><td>ST Final</td><td>ST Type</td><td>University</td><td>Interview Grade</td><td>Scholarship</td><td>Accepted</td><td>Passed Mechina</td><td>Comments</td></tr>";
              $stud_array[23] ? $stud_array[23]='Yes' : $stud_array[23]='No';
              $stud_array[25] ? $stud_array[25]='Yes' : $stud_array[25]='No';
              $stud_array[26] ? $stud_array[26]='Yes' : $stud_array[26]='No';
              $stud_array[27] ? $stud_array[27]='Yes' : $stud_array[27]='No';
              echo "<tr><td>".$stud_array[20]."</td><td>".$stud_array[21]."</td><td>".$stud_array[22]."</td><td>".$stud_array[23]."</td><td>".$stud_array[24]."</td><td>".$stud_array[25]."</td><td>".$stud_array[26]."</td><td>".$stud_array[27]."</td><td>".$stud_array[28]."</td></tr>";
              echo "</table>";

              ?>
              <h3 style="padding-left:40%; font-size: 28px; font-family: Arial; ">הכנס את הנתונים שברצונך לשנות</h3>
              <form id="update_form" action="<?php $_SERVER['PHP_SELF']?>" method="POST">
                <div id="update_first">
                    <div class="update_applic_opts">Acceptance date:</div>
                    <input name="acc_date" type="text" pattern="\d{1,2}/\d{1,2}/\d{4}" placeholder="dd/mm/yyyy">

                    <div class="update_applic_opts">Faculty:</div>
                    <input name="faculty" type="text">

                    <div class="update_applic_opts">Homeland:</div>
                    <input name="homeland" type="text">

                    <div class="update_applic_opts">Current country:</div>
                    <select name="country" >
                        <option value="">Country...</option>
                        <option value="Afganistan">Afghanistan</option>
                        <option value="Albania">Albania</option>
                        <option value="Algeria">Algeria</option>
                        <option value="American Samoa">American Samoa</option>
                        <option value="Andorra">Andorra</option>
                        <option value="Angola">Angola</option>
                        <option value="Anguilla">Anguilla</option>
                        <option value="Antigua &amp; Barbuda">Antigua &amp; Barbuda</option>
                        <option value="Argentina">Argentina</option>
                        <option value="Armenia">Armenia</option>
                        <option value="Aruba">Aruba</option>
                        <option value="Australia">Australia</option>
                        <option value="Austria">Austria</option>
                        <option value="Azerbaijan">Azerbaijan</option>
                        <option value="Bahamas">Bahamas</option>
                        <option value="Bahrain">Bahrain</option>
                        <option value="Bangladesh">Bangladesh</option>
                        <option value="Barbados">Barbados</option>
                        <option value="Belarus">Belarus</option>
                        <option value="Belgium">Belgium</option>
                        <option value="Belize">Belize</option>
                        <option value="Benin">Benin</option>
                        <option value="Bermuda">Bermuda</option>
                        <option value="Bhutan">Bhutan</option>
                        <option value="Bolivia">Bolivia</option>
                        <option value="Bonaire">Bonaire</option>
                        <option value="Bosnia &amp; Herzegovina">Bosnia &amp; Herzegovina</option>
                        <option value="Botswana">Botswana</option>
                        <option value="Brazil">Brazil</option>
                        <option value="British Indian Ocean Ter">British Indian Ocean Ter</option>
                        <option value="Brunei">Brunei</option>
                        <option value="Bulgaria">Bulgaria</option>
                        <option value="Burkina Faso">Burkina Faso</option>
                        <option value="Burundi">Burundi</option>
                        <option value="Cambodia">Cambodia</option>
                        <option value="Cameroon">Cameroon</option>
                        <option value="Canada">Canada</option>
                        <option value="Canary Islands">Canary Islands</option>
                        <option value="Cape Verde">Cape Verde</option>
                        <option value="Cayman Islands">Cayman Islands</option>
                        <option value="Central African Republic">Central African Republic</option>
                        <option value="Chad">Chad</option>
                        <option value="Channel Islands">Channel Islands</option>
                        <option value="Chile">Chile</option>
                        <option value="China">China</option>
                        <option value="Christmas Island">Christmas Island</option>
                        <option value="Cocos Island">Cocos Island</option>
                        <option value="Colombia">Colombia</option>
                        <option value="Comoros">Comoros</option>
                        <option value="Congo">Congo</option>
                        <option value="Cook Islands">Cook Islands</option>
                        <option value="Costa Rica">Costa Rica</option>
                        <option value="Cote DIvoire">Cote D'Ivoire</option>
                        <option value="Croatia">Croatia</option>
                        <option value="Cuba">Cuba</option>
                        <option value="Curaco">Curacao</option>
                        <option value="Cyprus">Cyprus</option>
                        <option value="Czech Republic">Czech Republic</option>
                        <option value="Denmark">Denmark</option>
                        <option value="Djibouti">Djibouti</option>
                        <option value="Dominica">Dominica</option>
                        <option value="Dominican Republic">Dominican Republic</option>
                        <option value="East Timor">East Timor</option>
                        <option value="Ecuador">Ecuador</option>
                        <option value="Egypt">Egypt</option>
                        <option value="El Salvador">El Salvador</option>
                        <option value="Equatorial Guinea">Equatorial Guinea</option>
                        <option value="Eritrea">Eritrea</option>
                        <option value="Estonia">Estonia</option>
                        <option value="Ethiopia">Ethiopia</option>
                        <option value="Falkland Islands">Falkland Islands</option>
                        <option value="Faroe Islands">Faroe Islands</option>
                        <option value="Fiji">Fiji</option>
                        <option value="Finland">Finland</option>
                        <option value="France">France</option>
                        <option value="French Guiana">French Guiana</option>
                        <option value="French Polynesia">French Polynesia</option>
                        <option value="French Southern Ter">French Southern Ter</option>
                        <option value="Gabon">Gabon</option>
                        <option value="Gambia">Gambia</option>
                        <option value="Georgia">Georgia</option>
                        <option value="Germany">Germany</option>
                        <option value="Ghana">Ghana</option>
                        <option value="Gibraltar">Gibraltar</option>
                        <option value="Great Britain">Great Britain</option>
                        <option value="Greece">Greece</option>
                        <option value="Greenland">Greenland</option>
                        <option value="Grenada">Grenada</option>
                        <option value="Guadeloupe">Guadeloupe</option>
                        <option value="Guam">Guam</option>
                        <option value="Guatemala">Guatemala</option>
                        <option value="Guinea">Guinea</option>
                        <option value="Guyana">Guyana</option>
                        <option value="Haiti">Haiti</option>
                        <option value="Hawaii">Hawaii</option>
                        <option value="Honduras">Honduras</option>
                        <option value="Hong Kong">Hong Kong</option>
                        <option value="Hungary">Hungary</option>
                        <option value="Iceland">Iceland</option>
                        <option value="India">India</option>
                        <option value="Indonesia">Indonesia</option>
                        <option value="Iran">Iran</option>
                        <option value="Iraq">Iraq</option>
                        <option value="Ireland">Ireland</option>
                        <option value="Isle of Man">Isle of Man</option>
                        <option value="Israel">Israel</option>
                        <option value="Italy">Italy</option>
                        <option value="Jamaica">Jamaica</option>
                        <option value="Japan">Japan</option>
                        <option value="Jordan">Jordan</option>
                        <option value="Kazakhstan">Kazakhstan</option>
                        <option value="Kenya">Kenya</option>
                        <option value="Kiribati">Kiribati</option>
                        <option value="Korea North">Korea North</option>
                        <option value="Korea Sout">Korea South</option>
                        <option value="Kuwait">Kuwait</option>
                        <option value="Kyrgyzstan">Kyrgyzstan</option>
                        <option value="Laos">Laos</option>
                        <option value="Latvia">Latvia</option>
                        <option value="Lebanon">Lebanon</option>
                        <option value="Lesotho">Lesotho</option>
                        <option value="Liberia">Liberia</option>
                        <option value="Libya">Libya</option>
                        <option value="Liechtenstein">Liechtenstein</option>
                        <option value="Lithuania">Lithuania</option>
                        <option value="Luxembourg">Luxembourg</option>
                        <option value="Macau">Macau</option>
                        <option value="Macedonia">Macedonia</option>
                        <option value="Madagascar">Madagascar</option>
                        <option value="Malaysia">Malaysia</option>
                        <option value="Malawi">Malawi</option>
                        <option value="Maldives">Maldives</option>
                        <option value="Mali">Mali</option>
                        <option value="Malta">Malta</option>
                        <option value="Marshall Islands">Marshall Islands</option>
                        <option value="Martinique">Martinique</option>
                        <option value="Mauritania">Mauritania</option>
                        <option value="Mauritius">Mauritius</option>
                        <option value="Mayotte">Mayotte</option>
                        <option value="Mexico">Mexico</option>
                        <option value="Midway Islands">Midway Islands</option>
                        <option value="Moldova">Moldova</option>
                        <option value="Monaco">Monaco</option>
                        <option value="Mongolia">Mongolia</option>
                        <option value="Montserrat">Montserrat</option>
                        <option value="Morocco">Morocco</option>
                        <option value="Mozambique">Mozambique</option>
                        <option value="Myanmar">Myanmar</option>
                        <option value="Nambia">Nambia</option>
                        <option value="Nauru">Nauru</option>
                        <option value="Nepal">Nepal</option>
                        <option value="Netherland Antilles">Netherland Antilles</option>
                        <option value="Netherlands">Netherlands (Holland, Europe)</option>
                        <option value="Nevis">Nevis</option>
                        <option value="New Caledonia">New Caledonia</option>
                        <option value="New Zealand">New Zealand</option>
                        <option value="Nicaragua">Nicaragua</option>
                        <option value="Niger">Niger</option>
                        <option value="Nigeria">Nigeria</option>
                        <option value="Niue">Niue</option>
                        <option value="Norfolk Island">Norfolk Island</option>
                        <option value="Norway">Norway</option>
                        <option value="Oman">Oman</option>
                        <option value="Pakistan">Pakistan</option>
                        <option value="Palau Island">Palau Island</option>
                        <option value="Palestine">Palestine</option>
                        <option value="Panama">Panama</option>
                        <option value="Papua New Guinea">Papua New Guinea</option>
                        <option value="Paraguay">Paraguay</option>
                        <option value="Peru">Peru</option>
                        <option value="Phillipines">Philippines</option>
                        <option value="Pitcairn Island">Pitcairn Island</option>
                        <option value="Poland">Poland</option>
                        <option value="Portugal">Portugal</option>
                        <option value="Puerto Rico">Puerto Rico</option>
                        <option value="Qatar">Qatar</option>
                        <option value="Republic of Montenegro">Republic of Montenegro</option>
                        <option value="Republic of Serbia">Republic of Serbia</option>
                        <option value="Reunion">Reunion</option>
                        <option value="Romania">Romania</option>
                        <option value="Russia">Russia</option>
                        <option value="Rwanda">Rwanda</option>
                        <option value="St Barthelemy">St Barthelemy</option>
                        <option value="St Eustatius">St Eustatius</option>
                        <option value="St Helena">St Helena</option>
                        <option value="St Kitts-Nevis">St Kitts-Nevis</option>
                        <option value="St Lucia">St Lucia</option>
                        <option value="St Maarten">St Maarten</option>
                        <option value="St Pierre &amp; Miquelon">St Pierre &amp; Miquelon</option>
                        <option value="St Vincent &amp; Grenadines">St Vincent &amp; Grenadines</option>
                        <option value="Saipan">Saipan</option>
                        <option value="Samoa">Samoa</option>
                        <option value="Samoa American">Samoa American</option>
                        <option value="San Marino">San Marino</option>
                        <option value="Sao Tome &amp; Principe">Sao Tome &amp; Principe</option>
                        <option value="Saudi Arabia">Saudi Arabia</option>
                        <option value="Senegal">Senegal</option>
                        <option value="Serbia">Serbia</option>
                        <option value="Seychelles">Seychelles</option>
                        <option value="Sierra Leone">Sierra Leone</option>
                        <option value="Singapore">Singapore</option>
                        <option value="Slovakia">Slovakia</option>
                        <option value="Slovenia">Slovenia</option>
                        <option value="Solomon Islands">Solomon Islands</option>
                        <option value="Somalia">Somalia</option>
                        <option value="South Africa">South Africa</option>
                        <option value="Spain">Spain</option>
                        <option value="Sri Lanka">Sri Lanka</option>
                        <option value="Sudan">Sudan</option>
                        <option value="Suriname">Suriname</option>
                        <option value="Swaziland">Swaziland</option>
                        <option value="Sweden">Sweden</option>
                        <option value="Switzerland">Switzerland</option>
                        <option value="Syria">Syria</option>
                        <option value="Tahiti">Tahiti</option>
                        <option value="Taiwan">Taiwan</option>
                        <option value="Tajikistan">Tajikistan</option>
                        <option value="Tanzania">Tanzania</option>
                        <option value="Thailand">Thailand</option>
                        <option value="Togo">Togo</option>
                        <option value="Tokelau">Tokelau</option>
                        <option value="Tonga">Tonga</option>
                        <option value="Trinidad &amp; Tobago">Trinidad &amp; Tobago</option>
                        <option value="Tunisia">Tunisia</option>
                        <option value="Turkey">Turkey</option>
                        <option value="Turkmenistan">Turkmenistan</option>
                        <option value="Turks &amp; Caicos Is">Turks &amp; Caicos Is</option>
                        <option value="Tuvalu">Tuvalu</option>
                        <option value="Uganda">Uganda</option>
                        <option value="Ukraine">Ukraine</option>
                        <option value="United Arab Erimates">United Arab Emirates</option>
                        <option value="United Kingdom">United Kingdom</option>
                        <option value="United States of America">United States of America</option>
                        <option value="Uraguay">Uruguay</option>
                        <option value="Uzbekistan">Uzbekistan</option>
                        <option value="Vanuatu">Vanuatu</option>
                        <option value="Vatican City State">Vatican City State</option>
                        <option value="Venezuela">Venezuela</option>
                        <option value="Vietnam">Vietnam</option>
                        <option value="Virgin Islands (Brit)">Virgin Islands (Brit)</option>
                        <option value="Virgin Islands (USA)">Virgin Islands (USA)</option>
                        <option value="Wake Island">Wake Island</option>
                        <option value="Wallis &amp; Futana Is">Wallis &amp; Futana Is</option>
                        <option value="Yemen">Yemen</option>
                        <option value="Zaire">Zaire</option>
                        <option value="Zambia">Zambia</option>
                        <option value="Zimbabwe">Zimbabwe</option>
                    </select><br>

                    <div class="update_applic_opts">City:</div>
                    <input type="text" name="city" placeholder="Enter the city..." >

                    <div class="update_applic_opts">County:</div>
                    <input type="text" name="county" >
                    <div class="update_applic_opts">Highschool:</div>
                    <input type="text" name="highschool" >

                </div>
                <div id="update_second">
                  <div class="update_applic_opts">Year of birth:</div>
                  <input type="number" name="yob" >

                  <div class="update_applic_opts">Internal bagrut:</div>
                  <input type="number" name="int_bagrut">

                  <div class="update_applic_opts">Math score 11th grade:</div>
                  <input type="number" name="math_11">

                  <div class="update_applic_opts">Math score 12th grade:</div>
                  <input type="number" name="math_12">
                  <div class="update_applic_opts">Physics score 11th grade:</div>
                  <input type="number" name="phys_11">

                  <div class="update_applic_opts">Physics score 12th grade:</div>
                  <input type="number" name="phys_12">
                  <div class="update_applic_opts">Learning disabilities:</div>
                  <input type="radio" name="learn_dis" value="TRUE"> Yes
                  <input type="radio" name="learn_dis" value="FALSE"> No
                  <br><br>
                  <input type="submit" id="update_make_update" value="הכנס שינויים" class="button" name="update_make_update"/>
              </div>
              <div id="update_third">
                <div class="update_applic_opts">English test:</div>
                <input type="radio" name="eng_test" value="TRUE"> Yes
                <input type="radio" name="eng_test" value="FALSE"> No

                <div class="update_applic_opts">English grade:</div>
                <input type="number" name="eng_grade">

                <div class="update_applic_opts">English test type:</div>
                <input type="text" name="eng_test_type">

                <div class="update_applic_opts">Sorting test:</div>
                <input type="radio" name="sort_test" value="TRUE"> Yes
                <input type="radio" name="sort_test" value="FALSE"> No
                <div class="update_applic_opts">Sorting test type:</div>
                <input type="text" name="st_type">
                <div class="update_applic_opts">Sorting test math grade:</div>
                <input type="number" name="st_math">
                <div class="update_applic_opts">Sorting test physics grade:</div>
                <input type="number" name="st_phys">
                <br><br>
                <input type="submit" id="update_delete" value="מחק סטודנט" class="button" name="update_delete"/>
            </div>
            <div id="update_fourth">
                <div class="update_applic_opts">Sorting test final grade:</div>
                <input type="number" name="st_final">

                <div class="update_applic_opts">University:</div>
                <input type="radio" name="uni" value="TRUE"> Yes
                <input type="radio" name="uni" value="FALSE"> No

                <div class="update_applic_opts">Interview grade:</div>
                <input type="number" name="int_grade">
                <div class="update_applic_opts">Scholarship:</div>
                <input type="radio" name="scholarship" value="TRUE"> Yes
                <input type="radio" name="scholarship" value="FALSE"> No

                <div class="update_applic_opts">Accepted:</div>
                <input type="radio" name="accepted" value="TRUE"> Yes
                <input type="radio" name="accepted" value="FALSE"> No<br>

                <div class="update_applic_opts">Passed mechina:</div>
                <input type="radio" name="mechina" value="TRUE"> Yes
                <input type="radio" name="mechina" value="FALSE"> No<br>

                <div class="update_applic_opts">Comments:</div>
                <input type="text" name="comments">
            </div>
        </form>
        <?php
    }
    else
    {
      echo "<h1 style='padding-left: 90px;'>לא נמצא</h1>";
  }
}
else
{
    echo "<h2 style='color: red; margin-left: 20px;'>נא הכנס מספר זהות של סטונט</h2>";
}
}
?>
<?php
if (isset($_POST["update_make_update"])) 
{
    $id='';
    $acc_date='';
    $faculty='';
    $homeland='';
    $country='';
    $city='';
    $county='';
    $highschool='';
    $yob='';
    $int_bagrut='';
    $math_11='';
    $math_12='';
    $phys_11='';
    $phys_12='';
    $learn_dis='';
    $eng_test='';
    $eng_grade='';
    $eng_test_type='';
    $sort_test='';
    $st_type='';
    $st_math='';
    $st_phys='';
    $st_final='';
    $uni='';
    $int_grade='';
    $scholarship='';
    $accepted='';
    $mechina='';
    $comments='';

if (!empty($_POST["acc_date"]))
{
    $date1 = str_replace("/", "-", $_POST["acc_date"]);
    $date = date('Y-m-d', strtotime($date1));
    $sql="UPDATE students SET Acceptance_Date='$date' WHERE ID=".$_SESSION['stud_ID_glob'].";";
    $result=mysql_query($sql);
    if (!$result)
    {
      die("Couldn't add Date to the data base.<br>".mysql_error());
  }
  else
  {
      echo "<br></br><div style='color:green; font-size: 24px;'>Updated Date</div>";
  }
}
if (!empty($_POST["faculty"]))
{
    $temp = $_POST["faculty"];
    $sql="UPDATE students SET Faculty='$temp' WHERE ID=".$_SESSION['stud_ID_glob'].";";
    $result=mysql_query($sql);
    if (!$result)
    {
      die("Couldn't add faculty to the data base.<br>".mysql_error());
  }
  else
  {
      echo "<br></br><div style='color:green; font-size: 24px;'>Updated Faculty</div>";
  }
}
if (!empty($_POST["homeland"]))
{
    $temp = $_POST["homeland"];
    $sql="UPDATE students SET Homeland='$temp' WHERE ID=".$_SESSION['stud_ID_glob'].";";
    $result=mysql_query($sql);
    if (!$result)
    {
      die("Couldn't add homeland to the data base.<br>".mysql_error());
  }
  else
  {
      echo "<br></br><div style='color:green; font-size: 24px;'>Updated Homeland</div>";
  }
}
if (!empty($_POST["country"]))
{
    $temp = $_POST["country"];
    $sql="UPDATE students SET Current_Country='$temp' WHERE ID=".$_SESSION['stud_ID_glob'].";";
    $result=mysql_query($sql);
    if (!$result)
    {
      die("Couldn't add Country to the data base.<br>".mysql_error());
  }
  else
  {
      echo "<br></br><div style='color:green; font-size: 24px;'>Updated Country</div>";
  }
}
if (!empty($_POST["city"]))
{
    $temp=$_POST['city'];
    $sql="UPDATE students SET City='$temp' WHERE ID=".$_SESSION['stud_ID_glob'].";";
    $result=mysql_query($sql);
    if (!$result)
    {
      die("Couldn't add City to the data base.<br>".mysql_error());
  }
  else
  {
      echo "<br></br><div style='color:green; font-size: 24px;'>Updated City</div>";
  }
}
if (!empty($_POST["county"]))
{
    $temp = $_POST['county'];
    $sql="UPDATE students SET County='$temp' WHERE ID=".$_SESSION['stud_ID_glob'].";";
    $result=mysql_query($sql);
    if (!$result)
    {
      die("Couldn't add County to the data base.<br>".mysql_error());
  }
  else
  {
      echo "<br></br><div style='color:green; font-size: 24px;'>Updated County</div>";
  }
}
if (!empty($_POST["highschool"]))
{
    $sql="UPDATE students SET Highschool=".$_POST["highschool"]." WHERE ID=".$_SESSION['stud_ID_glob'].";";
    $result=mysql_query($sql);
    if (!$result)
    {
      die("Couldn't add Highschool to the data base.<br>".mysql_error());
  }
  else
  {
      echo "<br></br><div style='color:green; font-size: 24px;'>Updated Highschool</div>";
  }
}
if (!empty($_POST["yob"]))
{
    $sql="UPDATE students SET Year_Of_Birth=".$_POST['yob']." WHERE ID=".$_SESSION['stud_ID_glob'].";";
    $result=mysql_query($sql);
    if (!$result)
    {
      die("Couldn't add Year of Birth to the data base.<br>".mysql_error());
  }
  else
  {
      echo "<br></br><div style='color:green; font-size: 24px;'>Updated Year of Birth</div>";
  }
}
if (!empty($_POST["int_bagrut"]))
{
    $sql="UPDATE students SET Internal_Bagrut=".$_POST['int_bagrut']." WHERE ID=".$_SESSION['stud_ID_glob'].";";
    $result=mysql_query($sql);
    if (!$result)
    {
      die("Couldn't add Internal Bagrut to the data base.<br>".mysql_error());
  }
  else
  {
      echo "<br></br><div style='color:green; font-size: 24px;'>Updated Internal Bagrut</div>";
  }
}
if (!empty($_POST["math_11"]))
{
    $sql="UPDATE students SET math_score_11=".$_POST['math_11']." WHERE ID=".$_SESSION['stud_ID_glob'].";";
    $result=mysql_query($sql);
    if (!$result)
    {
      die("Couldn't add Math Score 11 to the data base.<br>".mysql_error());
  }
  else
  {
      echo "<br></br><div style='color:green; font-size: 24px;'>Updated Math Score 11</div>";
  }
}
if (!empty($_POST["math_12"]))
{
    $sql="UPDATE students SET math_score_12=".$_POST['math_12']." WHERE ID=".$_SESSION['stud_ID_glob'].";";
    $result=mysql_query($sql);
    if (!$result)
    {
      die("Couldn't add Math Score 12 to the data base.<br>".mysql_error());
  }
  else
  {
      echo "<br></br><div style='color:green; font-size: 24px;'>Updated Math Score 12</div>";
  }
}
if (!empty($_POST["phys_11"]))
{
    $sql="UPDATE students SET physics_score_11=".$_POST['phys_11']." WHERE ID=".$_SESSION['stud_ID_glob'].";";
    $result=mysql_query($sql);
    if (!$result)
    {
      die("Couldn't add Physics Score 11 to the data base.<br>".mysql_error());
  }
  else
  {
      echo "<br></br><div style='color:green; font-size: 24px;'>Updated Physics Score 11</div>";
  }
}
if (!empty($_POST["phys_12"]))
{
    $sql="UPDATE students SET physics_score_11=".$_POST['phys_12']." WHERE ID=".$_SESSION['stud_ID_glob'].";";
    $result=mysql_query($sql);
    if (!$result)
    {
      die("Couldn't add Physics Score 12 to the data base.<br>".mysql_error());
  }
  else
  {
      echo "<br></br><div style='color:green; font-size: 24px;'>Updated Physics Score 12</div>";
  }
}
if (!empty($_POST["learn_dis"]))
{
    $sql="UPDATE students SET learning_dis=".$_POST['learn_dis']." WHERE ID=".$_SESSION['stud_ID_glob'].";";
    $result=mysql_query($sql);
    if (!$result)
    {
      die("Couldn't add Learning Disabilities to the data base.<br>".mysql_error());
  }
  else
  {
      echo "<br></br><div style='color:green; font-size: 24px;'>Updated Learning Disabilities</div>";
  }
}
if (!empty($_POST["eng_test"]))
{
    $sql="UPDATE students SET english_test=".$_POST['eng_test']." WHERE ID=".$_SESSION['stud_ID_glob'].";";
    $result=mysql_query($sql);
    if (!$result)
    {
      die("Couldn't add English Test to the data base.<br>".mysql_error());
  }
  else
  {
      echo "<br></br><div style='color:green; font-size: 24px;'>Updated English Test</div>";
  }
}
if (!empty($_POST["eng_grade"]))
{
    $sql="UPDATE students SET english_grade=".$_POST['eng_grade']." WHERE ID=".$_SESSION['stud_ID_glob'].";";
    $result=mysql_query($sql);
    if (!$result)
    {
      die("Couldn't add English Grade to the data base.<br>".mysql_error());
  }
  else
  {
      echo "<br></br><div style='color:green; font-size: 24px;'>Updated English Grade</div>";
  }
}
if (!empty($_POST["eng_test_type"]))
{
    $sql="UPDATE students SET english_test_type=".$_POST['eng_test_type']." WHERE ID=".$_SESSION['stud_ID_glob'].";";
    $result=mysql_query($sql);
    if (!$result)
    {
      die("Couldn't add English Test Type to the data base.<br>".mysql_error());
  }
  else
  {
      echo "<br></br><div style='color:green; font-size: 24px;'>Updated English Test Type</div>";
  }
}
if (!empty($_POST["sort_test"]))
{
    $sql="UPDATE students SET sorting_test=".$_POST['sort_test']." WHERE ID=".$_SESSION['stud_ID_glob'].";";
    $result=mysql_query($sql);
    if (!$result)
    {
      die("Couldn't add Sort Test to the data base.<br>".mysql_error());
  }
  else
  {
      echo "<br></br><div style='color:green; font-size: 24px;'>Updated Sort Test</div>";
  }
}
if (!empty($_POST["st_type"]))
{
    $sql="UPDATE students SET s_t_type=".$_POST['st_type']." WHERE ID=".$_SESSION['stud_ID_glob'].";";
    $result=mysql_query($sql);
    if (!$result)
    {
      die("Couldn't add Sort Test Type to the data base.<br>".mysql_error());
  }
  else
  {
      echo "<br></br><div style='color:green; font-size: 24px;'>Updated Sort Test Type</div>";
  }
}
if (!empty($_POST["st_math"]))
{
    $sql="UPDATE students SET s_t_math_grade=".$_POST['st_math']." WHERE ID=".$_SESSION['stud_ID_glob'].";";
    $result=mysql_query($sql);
    if (!$result)
    {
      die("Couldn't add ST Physics Grade to the data base.<br>".mysql_error());
  }
  else
  {
      echo "<br></br><div style='color:green; font-size: 24px;'>Updated ST Physics Grade</div>";
  }
}
if (!empty($_POST["st_phys"]))
{
    $sql="UPDATE students SET s_t_physics_grade=".$_POST['st_phys']." WHERE ID=".$_SESSION['stud_ID_glob'].";";
    $result=mysql_query($sql);
    if (!$result)
    {
      die("Couldn't add Sort Test Final to the data base.<br>".mysql_error());
  }
  else
  {
      echo "<br></br><div style='color:green; font-size: 24px;'>Updated Sort Test Final</div>";
  }
}
if (!empty($_POST["st_final"]))
{
    $sql="UPDATE students SET s_t_final=".$_POST['st_final']." WHERE ID=".$_SESSION['stud_ID_glob'].";";
    $result=mysql_query($sql);
    if (!$result)
    {
      die("Couldn't add Sort Test Final to the data base.<br>".mysql_error());
  }
  else
  {
      echo "<br></br><div style='color:green; font-size: 24px;'>Updated Sort Test Final</div>";
  }
}
if (!empty($_POST["uni"]))
{
    $sql="UPDATE students SET university=".$_POST['uni']." WHERE ID=".$_SESSION['stud_ID_glob'].";";
    $result=mysql_query($sql);
    if (!$result)
    {
      die("Couldn't add University to the data base.<br>".mysql_error());
  }
  else
  {
      echo "<br></br><div style='color:green; font-size: 24px;'>Updated University</div>";
  }
}
if (!empty($_POST["int_grade"]))
{
    $sql="UPDATE students SET interview_grade=".$_POST['int_grade']." WHERE ID=".$_SESSION['stud_ID_glob'].";";
    $result=mysql_query($sql);
    if (!$result)
    {
      die("Couldn't add Interview Grade to the data base.<br>".mysql_error());
  }
  else
  {
      echo "<br></br><div style='color:green; font-size: 24px;'>Updated Interview Grade</div>";
  }
}
if (!empty($_POST["scholarship"]))
{
    $sql="UPDATE students SET scholarship=".$_POST['scholarship']." WHERE ID=".$_SESSION['stud_ID_glob'].";";
    $result=mysql_query($sql);
    if (!$result)
    {
      die("Couldn't add Scholarship to the data base.<br>".mysql_error());
  }
  else
  {
      echo "<br></br><div style='color:green; font-size: 24px;'>Updated Scholarship</div>";
  }
}
if (!empty($_POST["accepted"]))
{
    $sql="UPDATE students SET accepted=".$_POST['accepted']." WHERE ID=".$_SESSION['stud_ID_glob'].";";
    $result=mysql_query($sql);
    if (!$result)
    {
      die("Couldn't add Accepted to the data base.<br>".mysql_error());
  }
  else
  {
      echo "<br></br><div style='color:green; font-size: 24px;'>Updated Accepted</div>";
  }
}
if (!empty($_POST["mechina"]))
{
    $sql="UPDATE students SET Pass_mechina=".$_POST['mechina']." WHERE ID=".$_SESSION['stud_ID_glob'].";";
    $result=mysql_query($sql);
    if (!$result)
    {
      die("Couldn't add Mechina to the data base.<br>".mysql_error());
  }
  else
  {
      echo "<br></br><div style='color:green; font-size: 24px;'>Updated Mechina</div>";
  }
}
if (!empty($_POST["comments"]))
{
    $sql="UPDATE students SET comments=".$_POST['comments']." WHERE ID=".$_SESSION['stud_ID_glob'].";";
    $result=mysql_query($sql);
    if (!$result)
    {
      die("Couldn't add Comments to the data base.<br>".mysql_error());
  }
  else
  {
      echo "<br></br><div style='color:green; font-size: 24px;'>Updated Comments</div>";
  }
}
}
if (isset($_POST["update_delete"]))
{
    echo "<h1>? האם הנך בטוח שברצונך למחוק את הסטודנט ".$_SESSION['stud_ID_glob']."</h1>";
    echo "<form id='update_form' action=".$_SERVER['PHP_SELF']." method='POST'>";
    echo "<input type='submit' id='update_confirm' value='!מחק' class='button' name='update_confirm' style='padding: 20px; color:red; font-size:24px; margin-left:15%;'/>";
    echo "</form>";
}
if (isset($_POST["update_confirm"]))
{
    $sql="DELETE FROM students WHERE ID=".$_SESSION['stud_ID_glob'].";";
    $result=mysql_query($sql);
    if (!$result)
    {
        die("Couldn't delete student.<br>".mysql_error());
    }
    else
    {

        echo "<br></br><div style='color:green; font-size: 24px;'>Student ".$_SESSION['stud_ID_glob']." deleted</div>";
    }
}
?>

</div>

<div id="update_pretendents">
    <form id="update_form" action="<?php $_SERVER['PHP_SELF']?>" method="POST">
      <input type="submit" id="update_preten_button" value="עדכון הצלחת מועמדים" name="update_preten_button" class="button"/>
  </form>
  <?php
  if (isset($_POST["update_preten_button"])) 
  {
      $sql = "SELECT * FROM students WHERE accepted = 0;";
      $result = mysql_query($sql);
      if(mysql_num_rows($result) > 0)
      {                  
        echo "<table>";
        echo "<br><th colspan='13' style='text-align:center; font-size: 20px; background-color: #4CAF50; color: white;'>נתוני הסטודנט</th>";
        echo "<tr><td>ID</td><td>Date</td><td>Country</td><td>City</td><td>District</td><td>School</td><td>Grade AR</td><td>Age</td><td>University</td><td>Success</td><td>Applicant</td><td>Student</td></tr>";
        while ($stud_array = mysql_fetch_array($result))
        {
          $stud_array[9] ? $stud_array[9]='Yes' : $stud_array[9]='No';
          $stud_array[10] ? $stud_array[10]='Add' : $stud_array[10]='Remove';
          $stud_array[11] ? $stud_array[11]='Yes' : $stud_array[11]='No';
          $stud_array[12] ? $stud_array[12]='Yes' : $stud_array[12]='No';
          echo "<tr><td>".$stud_array[0]."</td><td>".$stud_array[1]."</td><td>".$stud_array[2]."</td><td>".$stud_array[3]."</td><td>".$stud_array[4]."</td><td>".$stud_array[5]."</td><td>".$stud_array[6]."</td><td>".$stud_array[7]."</td><td>".$stud_array[8]."</td><td>".$stud_array[9]."</td><td><input type='button' id='change-".$stud_array[0]."' value='".$stud_array[10]."' class='onButton' onclick=FnBookmark(".$stud_array[0].",'Add')></input></td><td>".$stud_array[11]."</td></tr>";
      }
      echo "</table>";
  }
}
?>
</div>
</div>
<?php 
} else {
    ?>
    <div class="loggedout">נא הירשם למערכת</div>
    <?php
}
?>
<script>
    function FnBookmark(id,mode){
          // var temp = '"#' + id + '"';
          var temp = "#change-" + id + "";
          var temp2 = "FnBookmark("+id+",'Remove')";
          var temp3 = "FnBookmark("+id+",'Add')";
          var temp4 = 0;
          if (mode == 'Add')
          {
            temp4 = 1;
        } 
        $.ajax({
            url:'../ajax.php',
            data:{mode:temp4,id:id},
            dataType:'json',
            error: function(data){
              if(mode == 'Add')
              {
                $(temp).prop("value","Remove");
                $(temp).attr("onclick",temp2);
            }
            else
            {
                $(temp).prop("value","Add");
                $(temp).attr("onclick",temp3);
            }
        }
            // error: function(ts) { alert(ts.responseText) }
        });
    }
</script>
</body>
</html>