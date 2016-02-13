<?php
    //Start session
    session_start();
    
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
 
     // check if the 'id' variable is set in URL
     if (isset($_GET['id']))
     {
     // get id value
     $id = $_GET['id'];
     
     // delete the entry
     $result = mysql_query("DELETE FROM staff WHERE StaffID='$id'")
     or die("The staff does not exist ... \n"); 
     
     // redirect back to the allocation page
     header("Location: allocation.php");
     }
     else
     // if id isn't set, redirect back to allocation page
     {
     header("Location: allocation.php");
     }
 
?>