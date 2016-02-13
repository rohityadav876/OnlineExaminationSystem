<?php
	require_once('auth.php');
?>
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
//selecting all records from the messages table. Return an error if there is a problem
$result=mysql_query("SELECT * FROM messages")
or die("There are no records to display ... \n" . mysql_error()); 
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>Messages</title>
<link href="main.css" rel="stylesheet" type="text/css" />
	<script language="JavaScript" src="validation/ckeditor.js">
	</script>
</head>
<body>
<div class="page">
<div class="header">
                <img style="margin:10px 2px 2px 10px;float:left;" height="80" width="200" src="../images/logo.gif" alt="OES"/><h3 class="headtext"> &nbsp;Message Managemeant </h3><br>
                
            <div class="menubar" style="font-size:18px">
<a href="index.php">Home</a> | <a href="profile.php">Profile</a>| <a href="logout.php">Logout</a></div>
            </div><br>
<div id="container">
<form id="messageForm" name="messageForm" method="post" action="message-exec.php" onsubmit="return messageValidate(this)">
  <table width="900" border="0" cellpadding="2" cellspacing="0" align="center">
  <CAPTION><h2 style="color:inherit">SEND A MESSAGE</h2></CAPTION>
    <tr>
      <th width="">Subject</th>
      <td height="75" align="left"><input type="text" name="subject" id="subject" class="textfield" style="width:98%; height:50px;"/></td>
    </tr><br><br>
    <tr>
      <th width="">Message Box</th>
      <td width=""><textarea class="ckeditor" name="txtmessage" class="textfield" rows="5" cols="60" > </textarea></td>
    </tr><br><br>
    <tr height="50">
      <td>&nbsp;</td>
      <td align="center"><input type="submit" name="Submit" class="subbtn" style="width:110px;" value="Send Message" />
	  <input type="reset" class="subbtn" name="Reset" value="Clear Field" /></td>
    </tr>
  </table>
</form>
<hr>
<table border="0" width="900" align="center" style="border-collapse: collapse;border: 1px solid black;">
<CAPTION><h3>SENT MESSAGES</h3><hr></CAPTION>
<tr  style="background:#f60; height:40px">
<th>M.ID</th>
<th width="100">Date Sent</th>
<th width="150">Time Sent</th>
<th width="150">Message Subject</th>
<th>Message Text</th>
<th>Action(s)</th>
</tr>

<?php
//loop through all table rows
while ($row=mysql_fetch_array($result)){
echo "<tr style='text-align:center; border: 1px solid black;'>";
echo "<td style='width:50px;'>" . $row['message_id']."</td>";
echo "<td style='width:75px;'>" . $row['message_date']."</td>";
echo "<td style='width:75px;'>" . $row['message_time']."</td>";
echo "<td style='width:100px;text-align:center'>" . $row['message_subject']."</td>";
echo "<td  align='left'>" . $row['message_text']."</td>";
echo '<td style="margin-right:5px;"><button><a href="delete-message.php?id=' . $row['message_id'] . '">Remove Message</a></button></td>';
echo "</tr>";
}
mysql_free_result($result);
mysql_close($link);
?>
</table>
<hr>
</div>
<?php include ("ABottom.php");?>
</div>
</body>
</html>