<?php include ("auth.php");?>
<?php
error_reporting(0);
session_start();
include_once 'oesdb.php';
/************************** Step 1 *************************/
if(!isset($_SESSION['stdname'])) {
    $_GLOBALS['message']="Session Timeout.Click here to <a href=\"index.php\">Re-LogIn</a>";
}
else if(isset($_REQUEST['logout']))
{
    /************************** Step 2 - Case 1 *************************/
    //Log out and redirect login page
    unset($_SESSION['stdname']);
    header('Location: logout.php');

}
else if(isset($_REQUEST['dashboard'])){
     /************************** Step 2 - Case 2 *************************/
        //redirect to dashboard
     header('Location: stdwelcome.php');

    }else if(isset($_REQUEST['savem']))
{
      /************************** Step 2 - Case 3 *************************/
                //updating the modified values
    if(empty($_REQUEST['cname'])||empty ($_REQUEST['password'])||empty ($_REQUEST['email']))
    {
         $_GLOBALS['message']="Some of the required Fields are Empty.Therefore Nothing is Updated";
    }
    else
    {
     $query="update student set stdname='".htmlspecialchars($_REQUEST['cname'],ENT_QUOTES)."', stdpassword=ENCODE('".htmlspecialchars($_REQUEST['password'],ENT_QUOTES)."','oespass'),emailid='".htmlspecialchars($_REQUEST['email'],ENT_QUOTES)."',contactno='".htmlspecialchars($_REQUEST['contactno'],ENT_QUOTES)."',address='".htmlspecialchars($_REQUEST['address'],ENT_QUOTES)."',city='".htmlspecialchars($_REQUEST['city'],ENT_QUOTES)."',pincode='".htmlspecialchars($_REQUEST['pin'],ENT_QUOTES)."',firstname='".htmlspecialchars($_REQUEST['fname'],ENT_QUOTES)."',lastname='".htmlspecialchars($_REQUEST['lname'],ENT_QUOTES)."',state='".htmlspecialchars($_REQUEST['state'],ENT_QUOTES)."',dob='".htmlspecialchars($_REQUEST['dob'],ENT_QUOTES)."',fathername='".htmlspecialchars($_REQUEST['fathername'],ENT_QUOTES)."',branch='".htmlspecialchars($_REQUEST['branch'],ENT_QUOTES)."',clgname='".htmlspecialchars($_REQUEST['clgname'],ENT_QUOTES)."',passy='".htmlspecialchars($_REQUEST['passy'],ENT_QUOTES)."' where stdid='".$_REQUEST['student']."';";
     if(!@executeQuery($query))
        $_GLOBALS['message']=mysql_error();
     else
        $_GLOBALS['message']="Your Profile is Successfully Updated.";
    }
    closedb();

}


?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN"
    "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html>
  <head>
    <title>Edit Profile</title>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8"/>
    <link rel="stylesheet" type="text/css" href="oes.css"/>
    <script type="text/javascript" src="validate.js" ></script>
    </head>
  <body >
       <?php

        if($_GLOBALS['message']) {
            echo "<script>alert('".$_GLOBALS['message']."')</script>";
        }
        ?>
      <div id="container">
      <div class="header">
                <img style="margin:10px 2px 2px 10px;float:left;" height="80" width="200" src="images/logo.gif" alt="OES"/><h3 class="headtext"> &nbsp;Profile Editor </h3><br>
            </div>
           <form id="editprofile" action="editprofile.php" method="post">
          <div class="menubar">
               <ul id="menu">
                        <?php if(isset($_SESSION['stdname'])) {
                         // Navigations
                         ?>
                        <li><input type="submit" value="LogOut" name="logout" class="subbtn" title="Log Out"/></li>
                        <li><input type="submit" value="DashBoard" name="dashboard" class="subbtn" title="Dash Board"/></li>
                        <li><input type="submit" value="Save" name="savem" class="subbtn" onclick="validateform('editprofile')" title="Save the changes"/></li>
                     
               </ul>
          </div>
      <div class="page">
          <?php
                        $result=executeQuery("select stdid,stdname,DECODE(stdpassword,'oespass') as stdpass ,emailid,contactno,address,city,pincode,firstname,lastname,state,fathername,dob,clgname,branch,passy from student where stdname='".$_SESSION['stdname']."';");
                        if(mysql_num_rows($result)==0) {
                           header('Location: stdwelcome.php');
                        }
                        else if($r=mysql_fetch_array($result))
                        {
                           //editing components
                 ?>
           <table cellpadding="20" cellspacing="20" style="text-align:left;margin-left:15em" >
              <tr>
                  <td>First Name</td>
                  <td><input type="text" name="fname" value="<?php echo htmlspecialchars_decode($r['firstname'],ENT_QUOTES); ?>" size="16" onkeyup="isalphanum(this)"/></td>

              </tr>
              <tr>
                  <td>Last Name</td>
                  <td><input type="text" name="lname" value="<?php echo htmlspecialchars_decode($r['lastname'],ENT_QUOTES); ?>" size="16" onkeyup="isalphanum(this)"/></td>

              </tr>
              <tr>
                  <td>User Name</td>
                  <td><input type="text" name="cname" value="<?php echo htmlspecialchars_decode($r['stdname'],ENT_QUOTES); ?>" size="16" onkeyup="isalphanum(this)"/></td>

              </tr>

                      <tr>
                  <td>Password</td>
                  <td><input type="password" name="password" value="<?php echo htmlspecialchars_decode($r['stdpass'],ENT_QUOTES); ?>" size="16" onkeyup="isalphanum(this)" /></td>
                 
              </tr>

              <tr>
                  <td>E-mail ID</td>
                  <td><input type="text" name="email" value="<?php echo htmlspecialchars_decode($r['emailid'],ENT_QUOTES); ?>" size="16" /></td>
              </tr>
                       <tr>
                  <td>Contact No</td>
                  <td><input type="text" name="contactno" value="<?php echo htmlspecialchars_decode($r['contactno'],ENT_QUOTES); ?>" size="16" onkeyup="isnum(this)"/></td>
              </tr>

                  <tr>
                  <td>Address</td>
                  <td><textarea name="address" cols="20" rows="3"><?php echo htmlspecialchars_decode($r['address'],ENT_QUOTES); ?></textarea></td>
              </tr>
                       <tr>
                  <td>City</td>
                  <td><input type="text" name="city" value="<?php echo htmlspecialchars_decode($r['city'],ENT_QUOTES); ?>" size="16" onkeyup="isalpha(this)"/></td>
              </tr>
              
                       <tr>
                  <td>State</td>
                  <td><input type="text" name="state" value="<?php echo htmlspecialchars_decode($r['state'],ENT_QUOTES); ?>" size="16" onkeyup="isalpha(this)"/></td>
              </tr>
                       <tr>
                  <td>PIN Code</td>
                  <td><input type="hidden" name="student" value="<?php echo $r['stdid']; ?>"/><input type="text" name="pin" value="<?php echo htmlspecialchars_decode($r['pincode'],ENT_QUOTES); ?>" size="16" onkeyup="isnum(this)" /></td>
              </tr>

<tr>
                  <td>Date of Birth</td>
                  <td><input type="text" name="dob" value="<?php echo htmlspecialchars_decode($r['dob'],ENT_QUOTES); ?>" size="16" /></td>

              </tr>
                             
                       <tr>
                  <td>Father Name</td>
                  <td><input type="hidden" name="fathername" value="<?php echo $r['fathername']; ?>"/><input type="text" name="fathername" value="<?php echo htmlspecialchars_decode($r['fathername'],ENT_QUOTES); ?>" size="16"  /></td>
              </tr>
<tr>
                  <td>Branch Name</td>
                  <td><input type="text" name="branch" value="<?php echo htmlspecialchars_decode($r['branch'],ENT_QUOTES); ?>" size="16" onkeyup="isalphanum(this)"/></td>

              </tr>
              
              <tr>
                  <td>College</td>
                  <td><input type="text" name="clgname" value="<?php echo htmlspecialchars_decode($r['clgname'],ENT_QUOTES); ?>" size="16" onkeyup="isalpha(this)"/></td>
              </tr>
              <tr>
                  <td>Passing Year of B.tech</td>
                  <td><input type="text" name="passy" value="<?php echo htmlspecialchars_decode($r['passy'],ENT_QUOTES); ?>" size="16" onkeyup="isalpha(this)"/></td>
              </tr>
            </table>
<?php
                        closedb();
                        }
                        
                        }
  ?>
      </div>

           </form>
<?php include ("bottommenu.php");?>
      </div>
  </body>
</html>
