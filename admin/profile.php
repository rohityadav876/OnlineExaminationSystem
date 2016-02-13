<?php

require_once("./Keyboard.class.php");

$keyboard = new Keyboard();
$keyboard->setUseOnlyInCS(false);

$div_keyboard = $keyboard->draw();

?>
<?php


error_reporting(0);
/********************* Step 1 *****************************/
session_start();

if (!isset($_SESSION['admname'])) {
    $_GLOBALS['message'] = "Session Timeout.Click here to <a href=\"login.php\">Re-LogIn</a>";
} else if (isset($_REQUEST['logout'])) {
    /*     * ************************ Step 2 - Case 1 ************************ */
    //Log out and redirect login page
    unset($_SESSION['admname']);
    header('Location: logout.php');
} else if (isset($_REQUEST['dashboard'])) {
    /*     * ************************ Step 2 - Case 2 ************************ */
    //redirect to dashboard

    header('Location: index.php');
}  

?>



<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN"
    "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html>
  <head>
    <title>Administrator Login</title>
    <script src="./scriptaculous/prototype.js" type="text/javascript"></script>
    <script src="./scriptaculous/scriptaculous.js" type="text/javascript"></script>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8"/>
	  <script>
	  function isNumber(evt) {
    evt = (evt) ? evt : window.event;
    var charCode = (evt.which) ? evt.which : evt.keyCode;
    if (charCode > 31 && (charCode < 48 || charCode > 57)) {
	alert('Only number are allowed');
        return false;
    }
    return true;
}

      </script>
  </head>
  <body>
<!--
*********************** Step 1 ****************************

-->


<?php echo $div_keyboard; ?>    

      <div id="container">
                <div class="header">
                <img style="margin:10px 2px 2px 10px;float:left;" height="80" width="200" src="../images/logo.gif" alt="OES"/><h3 class="headtext"> &nbsp;Admin Profile Updatator</h3><br>
            </div>
       <div class="menubar">

                <form name="profile" action="profile.php" method="post">
                    <ul id="menu">
                        <?php if(isset($_SESSION['admname'])){ ?>
                        <li><input type="submit" value="LogOut" name="logout" class="subbtn" title="Log Out"/></li>
                        <li><input type="submit" value="Dashboard" name="dashboard" class="subbtn" title="Dashboard"/></li>
                        <?php } ?>
                    </ul>
                </form>
            </div>
      <?php echo $div_keyboard; ?>
      <div class="page">
            
              <table align="center">

<tr>
<form id="updateForm" name="updateForm" method="post" action="update-exec.php?id=<?php echo $_SESSION['admname'];?>">
<td>
  <table width="350" border="0" cellpadding="2" cellspacing="0">
  <CAPTION><h3 style="font-size:16px">CHANGE ADMIN PASSWORD</h3></CAPTION>
	<tr>
		<td colspan="2" style="text-align:center; font-size:12px"><font color="#FF0000"style="font-size:12px">* </font>Required fields</td>
	</tr>
    <tr>
      <th width="124" style="font-size:12px">Current Password</th>
      <td width="168"><font color="#FF0000" size="-4">* </font><input name="opassword" type="password" class="textfield" id="opassword" onclick="openKeyboard(this.id, 'none', null, 350);" required="required" /></td>
    </tr>
    <tr>
      <th style="font-size:12px">New Password</th>
      <td><font color="#FF0000" size="-4">* </font><input name="npassword" type="password" class="textfield" id="npassword"onclick="openKeyboard(this.id, 'none', null, 350);"  required="required"/></td>
    </tr>
    <tr>
      <th style="font-size:12px; text-align:justify; width:150px;">Confirm New Password </th>
      <td><font color="#FF0000" size="-4" >* </font><input name="cpassword" type="password" class="textfield" id="cpassword" onclick="openKeyboard(this.id, 'none', null, 350);" required="required"/></td>
    </tr>
    <tr>
      <td>&nbsp;</td>
      <td><input type="submit" name="Submit" class="subbtn" value="Change" /></td>
    </tr>
  </table>
</td>
</form>
<td>

<form id="staffForm" name="staffForm" method="post" action="staff-exec.php" onsubmit="return staffValidate(this)">
  <table width="300" border="0" align="center" cellpadding="2" cellspacing="0">
  <CAPTION><h3 style="font-size:16px">ADD NEW STAFF</h3></CAPTION>
	<tr>
		<td colspan="2" style="text-align:center;font-size:12px"><font color="#FF0000">* </font>Required fields</td>
	</tr>
    <tr>
      <th style="font-size:14px;">First Name </th>
      <td><font color="#FF0000" style="font-size:9px">* </font><input name="fName" type="text" class="textfield" id="fName" required="required" /></td>
    </tr>
	<tr>
      <th style="font-size:14px">Last Name </th>
      <td><font color="#FF0000" style="font-size:9px">* </font><input  required="required"name="lName" type="text" class="textfield" id="lName" /></td>
    </tr>
	 <tr>
      <th style="font-size:14px">Street Address </th>
      <td><font color="#FF0000" style="font-size:9px">* </font><input name="sAddress"  required="required" type="text" class="textfield" id="sAddress" /></td>
    </tr>
    <tr>
      <th style="font-size:14px">Mobile/Tel </th>
      <td><font color="#FF0000" style="font-size:9px">* </font><input required="required" name="mobile" type="text" class="textfield" id="mobile" onkeypress="return isNumber(event)" /></td>
    </tr>
    <tr>
      <td>&nbsp;</td>
      <td><input type="submit" name="Submit" class="subbtn" value="Add" /></td>
    </tr>
  </table>
</td>
</form>
</tr>
</table>


      </div>

      <?php require_once("ABottom.php");?>
      </div>
      
  </body>
</html>
