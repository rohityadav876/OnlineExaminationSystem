<?php
	//checking connection and connecting to a database
	
	include ("../dbsettings.php");
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
 
 //Function to sanitize values received from the form. Prevents SQL injection
	function clean($str) {
		$str = @trim($str);
		if(get_magic_quotes_gpc()) {
			$str = stripslashes($str);
		}
		return mysql_real_escape_string($str);
	}
	
	//Sanitize the POST values
	 $OldPassword = md5 (clean($_POST['opassword']));
	 $NewPassword =md5( clean($_POST['npassword']));
	 $ConfirmNewPassword = md5 (clean($_POST['cpassword']));
	
     // check if the 'id' variable is set in URL
     if (isset($_GET['id']))
     {
         // get id value
     $id = $_GET['id'];

         // update the entry
         $result = mysql_query("UPDATE adminlogin SET admpassword='$NewPassword' WHERE admname='$id' AND admpassword='$OldPassword'")
         or die("The admin does not exist ... \n". mysql_error()); 
         echo " <h4 style='text-align:center;color:#fff;background-color:rgba(17,171,73,1.00);'>hey dude your password has been Successfully updated. <a href='profile.php' style='font-size:20px; color:#f60;'> Click here</a> to goto your profile page </h4>";
     }
     else
     // if id isn't set, give an error
     {
        die("Password changing failed ..." . mysql_error());
     }
 
?>