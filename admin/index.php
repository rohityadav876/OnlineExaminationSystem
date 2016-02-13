 <?php require_once("auth.php");?>

<?php


error_reporting(0);

session_start();

if (!isset($_SESSION['admname'])) {
    $_GLOBALS['message'] = "Session Timeout.Click here to <a href=\"login.php\">Re-LogIn</a>";
} else if (isset($_REQUEST['logout'])) {
    unset($_SESSION['admname']);
    header('Location: logout.php');
} else if (isset($_REQUEST['profile'])) {

    header('Location: profile.php');
} 
else if (isset($_REQUEST['staff'])) {


    header('Location: allocation.php');
}  

else if (isset($_REQUEST['message'])) {


    header('Location: messages.php');
}  

?>

<html>
    <head>
        <title>Admin Dashboard</title>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8"/>
    </head>
    <body>
        <?php
       /********************* Step 2 *****************************/
        if(isset($_GLOBALS['message'])) {
            echo "<div class=\"message\">".$_GLOBALS['message']."</div>";
        }
        ?>
        <div id="container">
            <div class="header">
                <img style="margin:10px 2px 2px 10px;float:left;" height="80" width="200" src="../images/logo.gif" alt="OES"/><h3 class="headtext"> &nbsp;Admin Dashboard </h3><br>
            </div>
            <div class="menubar">

                <form name="admwelcome" action="index.php" method="post">
                    <ul id="menu">
                        <?php if(isset($_SESSION['admname'])){ ?>
                        <li><input type="submit" value="LogOut" name="logout" class="subbtn" title="Log Out"/></li>
                        <li><input type="submit" value="Profile" name="profile" class="subbtn" title="Profile"/></li>
                        <li><input type="submit" value="Staff" name="staff" class="subbtn" title="Staff"/></li>
                        <li><input type="submit" value="Message" name="message" class="subbtn" title="Message"/></li>
                        <?php } ?>
                    </ul>
                </form>
            </div>
            <div class="admpage">
                <?php if(isset($_SESSION['admname'])){ ?>

        
                <img height="600" width="100%" alt="back" class="btmimg" src="../images/trans.png"/>
                <div class="topimg" >
                    <p><img height="500" width="600" style="border:none;"  src="../images/admwelcome.jpg" alt="image"  usemap="#oesnav" id="imagemap" /></p>

                    <map name="oesnav" id="oesnav">
                        <area shape="circle" coords="150,120,70" href="usermng.php" alt="Manage Users" title="This takes you to User Management Section" />
                        <area shape="circle" coords="450,120,70" href="submng.php" alt="Manage Subjects" title="This takes you to Subjects Management Section" />
                        <area shape="circle" coords="300,250,60" href="rsltmng.php" alt="Manage Test Results" title="Click this to view Test Results." />
                        <area shape="circle" coords="150,375,70" href="testmng.php?forpq=true" alt="Prepare Questions" title="Click this to prepare Questions for the Test" />
                        <area shape="circle" coords="450,375,70" href="testmng.php" alt="Manage Tests" title="This takes you to Tests Management Section" />
                    </map>
                </div>
                <?php }?>

            </div>

          <?php require_once("ABottom.php");?>
      </div>
     
  </body>
</html>
