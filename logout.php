<?php
	//Start session
	session_start();
	
	//Unset the variables stored in session
		unset($_SESSION['SESS_MEMBER_ID']);
	unset($_SESSION['SESS_FIRST_NAME']);
	unset($_SESSION['SESS_LAST_NAME']);
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>Student Dashboard:Logged Out</title>
<link href="style/umain.css" rel="stylesheet" type="text/css" />
</head>
<body>
<div id="page">
  
  <div>
  <?php
  require_once("headermenu.php");
  ?>
  </div>
  
<div id="header">
  
</div>
<div id="center">
<h1>Logged Out </h1>
  <div style="border:#bd6f2f solid 1px;padding:4px 6px 2px 6px">
<p>&nbsp;</p>
<div class="error">You have been logged out.</div>
<p><a href="index.php">Click Here</a> to Login again</p>
</div>
</div>
<div id="footer">
    <div class="bottom_menu"><a href="http://www.rohityadav876.hostei.com/">Home Page</a>  |  <a href="http://www.rohityadav876.hostei.com/aboutus.html">About Us</a>
	</div>
  
  <div class="bottom_addr">&copy; 2014-15. All Rights Reserved</div>
</div>
</div>
</body>
</html>
