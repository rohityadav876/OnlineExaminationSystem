<?php
	//Start session
	session_start();
	
	//Check whether the session variable SESS_MEMBER_ID is present or not
	if(!isset($_SESSION['admname']) || (trim($_SESSION['admname']) == '')) {
		header("location: access-denied.php");
		exit();
	}
?>