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
      <li><a href="../reports/reports.php" >הפקדת דוח"ות</a></li>
      <li><a class="active" >עדכון מסד נתונים</a></li>
      <!--<li><a href="/newstud/newstud.php" >הוספת סטודנט חדש</a></li> -->
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
          <h1 style="color: black;">עדכן סטודנט לפי מספר זהות</h1>
          <input type="number" id="update_ID_search" name="update_ID_search" min="1" placeholder="הכנס מספר זהות" style="text-align: right;">
          <input type="submit" id="update_ID_search_button" value="חפש סטודנט" id="search_stud" class="button" name="stud_search"/>
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
                  //echo "<tr><td>$row1[0]</td><td>$row1[1]</td><td>$row1[2]</td><td>$row1[3]</td><td>$row1[4]</td><td>$row1[5]</td></tr>";
              $stud_array = mysql_fetch_array($result);
              echo "<table>";
              echo "<br><th colspan='13' style='text-align:center; font-size: 20px; background-color: #4CAF50; color: white;'>נתוני הסטודנט</th>";
              echo "<tr><td>ID</td><td>Date</td><td>Country</td><td>City</td><td>District</td><td>School</td><td>Grade AR</td><td>Age</td><td>University</td><td>Success</td><td>Applicant</td><td>Student</td><td>Graduate Student</td></tr>";
              $stud_array[9] ? $stud_array[9]='Yes' : $stud_array[9]='No';
              $stud_array[10] ? $stud_array[10]='Yes' : $stud_array[10]='No';
              $stud_array[11] ? $stud_array[11]='Yes' : $stud_array[11]='No';
              $stud_array[12] ? $stud_array[12]='Yes' : $stud_array[12]='No';
              echo "<tr><td>".$stud_array[0]."</td><td>".$stud_array[1]."</td><td>".$stud_array[2]."</td><td>".$stud_array[3]."</td><td>".$stud_array[4]."</td><td>".$stud_array[5]."</td><td>".$stud_array[6]."</td><td>".$stud_array[7]."</td><td>".$stud_array[8]."</td><td>".$stud_array[9]."</td><td>".$stud_array[10]."</td><td>".$stud_array[11]."</td><td>".$stud_array[12]."</td></tr>";
                  //echo "<tr><td>$row1[0]</td><td>$row1[1]</td><td>$row1[2]</td><td>$row1[3]</td><td>$row1[4]</td><td>$row1[5]</td></tr>";

              echo "</table>";

              ?>
              <h3 style="padding-left:150px; ">הכנס את הנתונים שברצונך לשנות</h3>
              <form id="update_form" action="<?php $_SERVER['PHP_SELF']?>" method="POST">
                <div id="update_first_half">
                  <div class="update_applic_opts">Applicant ID:</div>
                  <input type="number" name="ID" autofocus="" min="1" >
                  <div class="update_applic_opts">Application date:</div>
                  <input name="date" type="text" pattern="\d{1,2}/\d{1,2}/\d{4}" ="" placeholder="dd/mm/yyyy">

                  <div class="update_applic_opts">Country:</div>
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

                  <div class="update_applic_opts">District:</div>
                  <input type="text" name="district" >

                  <div class="update_applic_opts">School:</div>
                  <input type="text" name="school" >
                  <div class="update_applic_opts">Grade AR:</div>
                  <input type="number" name="grade_ar" placeholder="0-100" min="0" max="100" >
                </div>
                <div id="update_second_half">
                  <div class="update_applic_opts">Age:</div>
                  <input type="number" name="age" placeholder="10-99" min="10" max="99" > 
                  <div class="update_applic_opts">University Grade:</div>
                  <input type="number" name="uni_grade" placeholder="0-100" min="0" max="100" >
                  <div class="update_applic_opts">Success:</div>
                  <input type="radio" name="success" value="TRUE"> Yes
                  <input type="radio" name="success" value="FALSE"> No

                  <div class="update_applic_opts">Applicant:</div>
                  <input type="radio" name="applicant" value="TRUE"> Yes
                  <input type="radio" name="applicant" value="FALSE"> No<br>

                  <div class="update_applic_opts">Student:</div>
                  <input type="radio" name="student" value="TRUE"> Yes
                  <input type="radio" name="student" value="FALSE"> No<br>

                  <div class="update_applic_opts">Graduate Student:</div>
                  <input type="radio" name="grad_stud" value="TRUE"> Yes
                  <input type="radio" name="grad_stud" value="FALSE"> No<br>
                </div>
                <input type="submit" id="update_make_update" value="הכנס שינויים" class="button" name="update_make_update"/>
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
                $ID='';
                $date='';
                $country='';
                $city='';
                $district='';
                $school='';
                $grade_ar='';
                $age='';
                $uni_grade='';
                $success='';
                $applicant='';
                $student='';
                $grad_stud='';
                if (!empty($_POST["ID"]))
                {
                  $sql="UPDATE students SET ID=".$_POST["ID"]." WHERE ID=".$_SESSION["stud_ID_glob"].";";
                  $result=mysql_query($sql);
                  if (!$result)
                  {
                    die("Couldn't add ID to the data base.<br>".mysql_error());
                  }
                  else
                  {
                    echo "<br>Updated ID";
                  }
                }
                if (!empty($_POST["date"]))
                {
                  $date1 = str_replace("/", "-", $_POST["date"]);
                  $date = date('Y-m-d', strtotime($date1));
                  $sql="UPDATE students SET ApplicDate='$date' WHERE ID=".$_SESSION['stud_ID_glob'].";";
                  $result=mysql_query($sql);
                  if (!$result)
                  {
                    die("Couldn't add Date to the data base.<br>".mysql_error());
                  }
                  else
                  {
                    echo "<br>Updated date";
                  }
                }
                if (!empty($_POST["country"]))
                {
                  $temp = $_POST["country"];
                  $sql="UPDATE students SET Country='$temp' WHERE ID=".$_SESSION['stud_ID_glob'].";";
                  $result=mysql_query($sql);
                  if (!$result)
                  {
                    die("Couldn't add Country to the data base.<br>".mysql_error());
                  }
                  else
                  {
                    echo "<br>Updated country";
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
                    echo "<br>Updated city";
                  }
                }
                if (!empty($_POST["district"]))
                {
                  $temp=$_POST['district'];
                  $sql="UPDATE students SET District='$temp' WHERE ID=".$_SESSION['stud_ID_glob'].";";
                  $result=mysql_query($sql);
                  if (!$result)
                  {
                    die("Couldn't add district to the data base.<br>".mysql_error());
                  }
                  else
                  {
                    echo "<br>Updated district";
                  }
                }
                if (!empty($_POST["school"]))
                {
                  $temp = $_POST['school'];
                  $sql="UPDATE students SET School='$temp' WHERE ID=".$_SESSION['stud_ID_glob'].";";
                  $result=mysql_query($sql);
                  if (!$result)
                  {
                    die("Couldn't add school to the data base.<br>".mysql_error());
                  }
                  else
                  {
                    echo "<br>Updated school";
                  }
                }
                if (!empty($_POST["grade_ar"]))
                {
                  $sql="UPDATE students SET GradeAR=".$_POST["grade_ar"]." WHERE ID=".$_SESSION['stud_ID_glob'].";";
                  $result=mysql_query($sql);
                  if (!$result)
                  {
                    die("Couldn't add grade AR to the data base.<br>".mysql_error());
                  }
                  else
                  {
                    echo "<br>Updated grade AR";
                  }
                }
                if (!empty($_POST["age"]))
                {
                  $sql="UPDATE students SET Age=".$_POST['age']." WHERE ID=".$_SESSION['stud_ID_glob'].";";
                  $result=mysql_query($sql);
                  if (!$result)
                  {
                    die("Couldn't add age to the data base.<br>".mysql_error());
                  }
                  else
                  {
                    echo "<br>Updated age";
                  }
                }
                if (!empty($_POST["uni_grade"]))
                {
                  $sql="UPDATE students SET UniGrade=".$_POST['uni_grade']." WHERE ID=".$_SESSION['stud_ID_glob'].";";
                  $result=mysql_query($sql);
                  if (!$result)
                  {
                    die("Couldn't add uni grade to the data base.<br>".mysql_error());
                  }
                  else
                  {
                    echo "<br>Updated university grade";
                  }
                }
                if (!empty($_POST["success"]))
                {
                  $sql="UPDATE students SET Success=".$_POST['success']." WHERE ID=".$_SESSION['stud_ID_glob'].";";
                  $result=mysql_query($sql);
                  if (!$result)
                  {
                    die("Couldn't add success to the data base.<br>".mysql_error());
                  }
                  else
                  {
                    echo "<br>Updated success";
                  }
                }
                if (!empty($_POST["applicant"]))
                {
                  $sql="UPDATE students SET Applicant=".$_POST['applicant']." WHERE ID=".$_SESSION['stud_ID_glob'].";";
                  $result=mysql_query($sql);
                  if (!$result)
                  {
                    die("Couldn't add applicant to the data base.<br>".mysql_error());
                  }
                  else
                  {
                    echo "<br>Updated applicant";
                  }
                }
                if (!empty($_POST["student"]))
                {
                  $sql="UPDATE students SET Student=".$_POST['student']." WHERE ID=".$_SESSION['stud_ID_glob'].";";
                  $result=mysql_query($sql);
                  if (!$result)
                  {
                    die("Couldn't add student to the data base.<br>".mysql_error());
                  }
                  else
                  {
                    echo "<br>Updated student";
                  }
                }
                if (!empty($_POST["grad_stud"]))
                {
                  $sql="UPDATE students SET GradStud=".$_POST['grad_stud']." WHERE ID=".$_SESSION['stud_ID_glob'].";";
                  $result=mysql_query($sql);
                  if (!$result)
                  {
                    die("Couldn't add grad student to the data base.<br>".mysql_error());
                  }
                  else
                  {
                    echo "<br>Updated graduate student";
                  }
                }
              }
              ?>
              
      </div>

      <div id="update_pretendents">
        <h1>עדכן את כל המועמדים</h1>
        <input type="submit" id="update_preten_button" value="עדכן מועמדים" id="update_pret_sub" class="button"/>
      </div>
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