<?php
//Start session
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
    if(isset($_POST['Submit'])){
        //Function to sanitize values received from the form. Prevents SQL injection
        function clean($str) {
            $str = @trim($str);
            if(get_magic_quotes_gpc()) {
                $str = stripslashes($str);
            }
            return mysql_real_escape_string($str);
        }
        //get email
        	 $email = clean($_POST['email']);
        
        //selecting a specific record from the members table. Return an error if there are no records in the table
        $result=mysql_query("SELECT * FROM student WHERE emailid='$email'")
        or die("A problem has occured ... \n" . "Our team is working on it at the moment ... \n" . "Please check back after few hours.".mysql_error()); 
    }
?>
<?php
    if(isset($_POST['Change'])){
        //Function to sanitize values received from the form. Prevents SQL injection
        function clean($str) {
            $str = @trim($str);
            if(get_magic_quotes_gpc()) {
                $str = stripslashes($str);
            }
            return mysql_real_escape_string($str);
        }
        if(trim($_SESSION['stdid']) != '')
		{
            $member_id=$_SESSION['stdid']; //gets member id from session
            //get answer and new password from form
            $answer = clean($_POST['answer']);
			 $pass = clean($_POST['new_password']);
             $pass1=htmlspecialchars($_REQUEST['new_password'],ENT_QUOTES);

			            			           

						$rohit1=  md5($_POST['answer']);
	// update the entry
         $result = mysql_query("UPDATE student SET stdpassword=ENCODE('".$pass1."','oespass') WHERE stdid='$member_id' AND sanswer='$rohit1' ")
         or die("A problem has occured ... \n" . "Our team is working on it at the moment ... \n" . "Please check back after few hours. \n".mysql_error());  
         
         if($result){

				unset($_SESSION['stdid']);
				echo "<script>  alert('Password Updated successfully!'); window.close('index.php'); </script>";
				
         }
         else{
                unset($_SESSION['stdid']);
                header("Location: reset-failed.php"); //redirect to reset failed page
         }
            }
            else{
                unset($_SESSION['stdid']);
                header("Location: reset-failed.php"); //redirect to reset failed page
            }
    }
         ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>Password Reset</title>

<link href="style/umain.css" rel="stylesheet" type="text/css" />
<script language="JavaScript" src="validation/user.js">
</script>
</head>
<body>
<div id="reset">
  <div style="border:#bd6f2f solid 1px;padding:4px 6px 2px 6px">
  <form name="passwordResetForm" id="passwordResetForm" method="post" action="password-reset.php" onsubmit="return passwordResetValidate(this)">
     <table width="360" style="text-align:center;">
     <tr>
        <th>Account Email</th>
        <td width="168"><input name="email" type="text" class="textfield" id="email" /></td>
        <td><input type="submit" name="Submit" value="Check" /></td>
     </tr>
     </table>
 </form>
  <?php
    if(isset($_POST['Submit'])){
        $row=mysql_fetch_assoc($result);
        $_SESSION['stdid']=$row['stdid']; //creates a member id session
        session_write_close(); //closes session
        $question_id=$row['sqid'];
        
        //get question text based on question_id
        $question=mysql_query("SELECT * FROM securityquestion WHERE sqid='$question_id'")
        or die("A problem has occured ... \n" . "Our team is working on it at the moment ... \n" . "Please check back after few hours.");
        
        $question_row=mysql_fetch_assoc($question);
        $question=$question_row['squestion'];
        if($question!=""){
            echo "<b>Your Member ID:</b> ".$_SESSION['stdid']."<br>";
            echo "<b>Your Security Question:</b> ".$question;
        }
        else{
            echo "<b>Your Security Question:</b> THIS ACCOUNT DOES NOT EXIST! PLEASE CHECK YOUR EMAIL AND TRY AGAIN.";
        }
    }
  ?>
  <hr>
  <form name="passwordResetForm" id="passwordResetForm" method="post" action="password-reset.php" onsubmit="return passwordResetValidate_2(this)">
     <table width="360" style="text-align:center;">
     <tr>
        <td colspan="2" style="text-align:center;"><font color="#FF0000">* </font>Required fields</td>
     </tr>
     <tr>
        <th>Your Security Answer</th>
        <td width="168"><font color="#FF0000">* </font><input name="answer" type="text" class="textfield" id="answer" /></td>
     </tr>
     <tr>
        <th>New Password</th>
        <td width="168"><font color="#FF0000">* </font><input name="new_password" type="password" class="textfield" id="new_password" /></td>
     </tr>
     <tr>
        <th>Confirm New Password</th>
        <td width="168"><font color="#FF0000">* </font><input name="confirm_new_password" type="password" class="textfield" id="confirm_new_password" /></td>
     </tr>
     <tr>
        <td colspan="2"><input type="reset" name="Reset" value="Clear Fields" /><input type="submit" name="Change" value="Change Password" /></td>
     </tr>
     </table>
 </form>
  </div>
  </div>
</body>
</html>