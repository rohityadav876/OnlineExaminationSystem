<?php
    //Start session
    session_start();
    
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
 
     // check if the 'id' variable is set in URL
     if (isset($_GET['id']))
     {
         // get id value
         $id = $_GET['id'];
         
         // delete the entry
         $result = mysql_query("DELETE FROM messages WHERE message_id='$id'")
         or die("There was a problem while removing the message ... \n" . mysql_error()); 
         
         // redirect back to the messages page
         header("Location: messages.php");
         }
     else
     // if id isn't set, redirect back to the messages page
     {
        header("Location: messages.php");
     }
 
?>