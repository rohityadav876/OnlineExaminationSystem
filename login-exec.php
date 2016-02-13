<?php
	//Start session
	session_start();
	
	include ("dbsettings.php");

	
	//Array to store validation errors
	$errmsg_arr = array();
	
	//Validation error flag
	$errflag = false;
	
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
	$login = clean($_POST['login']);
	$password = clean($_POST['password']);
	
	//Create query
	$qry="select *,DECODE(stdpassword,'oespass') as std from student where stdname='".htmlspecialchars($login,ENT_QUOTES)."' and stdpassword=ENCODE('".htmlspecialchars($password,ENT_QUOTES)."','oespass')";
	$result=mysql_query($qry);
	
	//Check whether the query was successful or not
	if($result) {
		if(mysql_num_rows($result) == 1) {
			//Login Successful
			session_regenerate_id();
			$member = mysql_fetch_assoc($result);
		 	$_SESSION['stdid'] = $member['stdid'];
		$_SESSION['stdname'] = $member['stdname'];
			$_SESSION['stdsname'] = $member['firstname'];
			
			session_write_close();
			header("location: stdwelcome.php");
			exit();
		}else {
			//Login failed
			header("location: login-failed.php");
			exit();
		}
	}else {
		die("Query failed");
	}
?>