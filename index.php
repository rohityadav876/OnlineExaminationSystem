
<?php
	session_start();
//checking connection and connecting to a database
include ("dbsettings.php");
//Connect to mysql server
   	$link = mysql_connect($dbserver, $dbusername, $dbpassword);
    if(!$link) {
        die('Failed to connect to server: ' . mysql_error());
    }
    
    //Select database
    $db = mysql_select_db($dbname);
    if(!$db) {
        die("Unable to select database");
    }
	
?>
<?php
//setting-up a remember me cookie
    if (isset($_POST['Submit'])){
        //setting up a remember me cookie
        if($_POST['remember']) {
            $year = time() + 31536000;
            setcookie('remember_me', $_POST['login'], $year);
        }
        else if(!$_POST['remember']) {
            if(isset($_COOKIE['remember_me'])) {
                $past = time() - 100;
                setcookie(remember_me, gone, $past);
            }
        }
    }
?>

<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<title>Student Dashboard:Home</title>
<link href="style/umain.css" rel="stylesheet" type="text/css">
<script language="JavaScript" src="validation/user.js">
</script>

</head>
<body>
<div id="page">
   <div>
  <?php
  require_once("headermenu.php");
  ?>
  </div>
  
  <div id="header" class="stretchX">

</div>
<div id="center">
  <h1><center>Welcome To GateVision Online Portal for Student's !</center></h1>
      <div class="body_text">
  Here Student can enjoy a virtual world of GATE vision. Student can Login, Logout, Redister and event when they are in troubble then they can click on link as required. Student can Customize their profile and have a look of arrived message from Admin.
  </div>
<table align="center" width="100%">
    <tr align="center">
        <td style="text-align:center;">
            <div class="t1">
            <form id="loginForm" name="loginForm" method="post" action="login-exec.php" onsubmit="return loginValidate(this)">
              <table width="290" border="0" align="center" cellpadding="2" cellspacing="0">
                <tr>
                    <td colspan="2" style="text-align:center;"><font color="#FF0000">* </font>Required fields</td>
                </tr>
                <tr>
                  <td width="112"><b>Username</b></td>
                  <td width="188"><font color="#FF0000">* </font><input name="login" placeholder="enter your username" type="text" class="textfield" id="login" /></td>
                </tr>
                <tr>
                  <td><b>Password</b></td>
                  <td><font color="#FF0000">* </font><input name="password" placeholder="enter password" type="password" class="textfield" id="password" /></td>
                </tr>
                <tr>
                      <td><input name="remember" type="checkbox" class="" id="remember" value="1" onselect="cookie()" <?php if(isset($_COOKIE['remember_me'])) {
                        echo 'checked="checked"';
                    }
                    else {
                        echo '';
                    }
                    ?>/>Remember me</td>
                      <td><a href="JavaScript: resetPassword()">Forgot password?</a></td>
                </tr>
                <tr>
                    <td colspan="2"><input type="reset" value="Clear Fields"/>
                  <input type="submit" name="Submit" value="Login" /></td>
                </tr>
                <tr><td>&nbsp;</td></tr>
              </table>
            </form>
            </div>
        </td>
        <hr>
        <td style="text-align:center;">
            <div style="border:#bd6f2f solid 1px; text-align:justify;padding:4px 6px 2px 6px;">
 <strong>Gate Vision</strong>  provides a dedicated Test panel for the students preparing for <strong> GATE-(Graduate Aptitude Test) </strong>in Engineering & IES-Engineering Services examinations. The progress of the students with the help of their performance over various tests in various parameters is available for each student.<br /><br />
Most comprehensive Test Series prepared by team of experts from IITR.<br /><br />

<strong> Registration Instruction : </strong><br /><br />

 1. Self registration with valid Email-Id,Mobile numbers.<br /><br />

 2. Do NOT share your User ID & Password.<br /><br />
 3. Results after test submission.<br /><br />  <a href="register.php" style="width:100px; height:20px; border:1px solid #168; background:rgba(17,171,73,0.10); padding:10px; margin-left:500px; margin-top:-10px;  padding-bottom:0px;"> Register </a>            </div>
            
        </td>
        
    </tr>
</table>
<hr>
</div>
 <div>
  <?php
  require_once("bottommenu.php");
  ?>
  </div>
  
</div>
</body>
</html>
