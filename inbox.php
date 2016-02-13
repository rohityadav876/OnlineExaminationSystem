<?php
    require_once('auth.php');
		session_start();
?>
<?php
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
//get member id from session

?>


<?php
    //retrieving all rows from the messages table
    $messages=mysql_query("SELECT * FROM messages")
    or die("Something is wrong ... \n" . mysql_error()); 
    //get the number of rows
    $num_messages = mysql_num_rows($messages);
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">

    <head>
        <title> <?php echo $_SESSION['stdname'];?>'s DashBoard</title>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8"/>
        <link rel="stylesheet" type="text/css" href="oes.css"/>
    </head>

<body>
<div id="container">
<div id="page">
  <div>
  <?php
  require_once("headermenu.php");
  ?>
  </div>
  <div class="header">
                <img style="margin:10px 2px 2px 10px;float:left;" height="80" width="200" src="images/logo.gif" alt="OES"/><h3 class="headtext"> &nbsp;Student Portal </h3><br>
            </div>
            <div class="menubar">

                <form name="stdwelcome" action="stdwelcome.php" method="post">
                    <ul id="menu">
                        <?php if(isset($_SESSION['stdname'])){ ?>
                        <li><input type="submit" value="LogOut" name="logout" class="subbtn" title="Log Out"/></li>
                        <li><input type="submit" value="DashBoard" name="dashboard" class="subbtn" title="bashboard"/></li>
                        <?php } ?>
                    </ul>
                </form>
            </div>


<div id="center">
<h1>MESSAGES</h1>
  <div style="border:#bd6f2f solid 1px;padding:4px 6px 2px 6px">
<p>&nbsp;</p>
<p>These are the messages from Gatevision for being familer with this new portal. For more information you may contact to us by  <a href="http://www.gatevision.org/contactus.html" style="font-size:18px">Clicking Here</a> </br><br>
<hr>
<table width="850" style="text-align:center;">
<CAPTION><h2>INBOX</h2></CAPTION>
<tr>
<th>From</th>
<th>Date Received</th>
<th>Time Received</th>
<th>Subject</th>
<th>Text</th>
</tr>

<?php
//loop through all table rows
while ($row=mysql_fetch_array($messages)){
echo "<tr>";
echo "<td>" . $row['message_from']."</td>";
echo "<td>" . $row['message_date']."</td>";
echo "<td>" . $row['message_time']."</td>";
echo "<td>" . $row['message_subject']."</td>";
echo "<td width='350' align='center' style='text-align:justify;'>" . $row['message_text']."</td>";
echo "</tr>";
}
mysql_free_result($messages);
mysql_close($link);
?>
</table>
</div>
</div>

 <div>
  <?php
  require_once("bottommenu.php");
  ?>
  </div></div>
</body>
</html>