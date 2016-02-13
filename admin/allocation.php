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
    
    //selecting all records from the staff table. Return an error if there are no records in the tables
    $staff=mysql_query("SELECT * FROM staff")
    or die("There are no records to display ... \n" . mysql_error()); 
?>
<?php
    //selecting all records from the staff table. Return an error if there are no records in the tables
    $staff_1=mysql_query("SELECT * FROM staff")
    or die("There are no records to display ... \n" . mysql_error());
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>Staff</title>
<link href="main.css" rel="stylesheet" type="text/css" />

</head>
<body>
<div class="page">
<div class="header">
                <img style="margin:10px 2px 2px 10px;float:left;" height="80" width="200" src="../images/logo.gif" alt="OES"/><h3 class="headtext"> &nbsp;Admin Dashboard </h3><br>
                <div class="menubar" style="font-size:18px;">
<a href="index.php">Home</a> | <a href="profile.php">Profile</a>|<a href="rsltmng.php">Results</a> |<a href="allocation.php">Staff</a> | <a href="messages.php">Messages</a> | <a href="logout.php">Logout</a></div>

            </div>
            
<br>
<div id="container">
<table border="0" width="900" align="center" style="border-collapse: collapse;border: 1px solid black;">
<CAPTION><h3 style="color:inherit">STAFF LIST</h3><hr></CAPTION>

<tr style="color:#fff; background:#f60; height:40px">
<th style="width:100px;">Staff ID</th>
<th style="width:100px;">First Name</th>
<th style="width:100px;">Last Name</th>
<th style="width:300px; ">Street Address</th>
<th style="width:200px;"> Remove Action </th>
<th style="width:100px;"> Add Action </th>
</tr>

<?php
//loop through all table rows
while ($row=mysql_fetch_array($staff)){
echo "<tr style='text-align:center; border: 1px solid black;'>";
echo "<td>" . $row['StaffID']."</td>";
echo "<td>" . $row['firstname']."</td>";
echo "<td>" . $row['lastname']."</td>";
echo "<td>" . $row['Street_Address']."</td>";
echo '<td><button><a href="delete-staff.php?id=' . $row['StaffID'] . '">Remove Staff</a></button></td>';
echo '<td><button><a href="profile.php">Add Staff</a></button></td>';
echo "</tr>";
}
mysql_free_result($staff);
mysql_close($link);
?>
</table>

</div>
<div>
<?php require_once("ABottom.php")?>
</div>
</body>
</html>