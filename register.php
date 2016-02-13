<?php include ("auth.php");?>
<?php
error_reporting(0);
session_start();
include_once 'oesdb.php';
    
		$link = mysql_connect($dbserver, $dbusername, $dbpassword);
	if(!$link) {
        die('Failed to connect to server: ' . mysql_error());
    }
    
    //Select database
    $db = mysql_select_db($dbname);
    if(!$db) {
        die("Unable to select database");
    }
 
	

$questions=mysql_query("SELECT * FROM securityquestion")
or die("Something is wrong ... \n" . mysql_error());


if(isset($_REQUEST['stdsubmit']))
{
     $result=executeQuery("select max(stdid) as std from student");
     $r=mysql_fetch_array($result);
     if(is_null($r['std']))
     $newstd=1;
     else
     $newstd=$r['std']+1;

     $result=executeQuery("select stdname as std from student where stdname='".htmlspecialchars($_REQUEST['cname'],ENT_QUOTES)."';");

    // $_GLOBALS['message']=$newstd;
    if(empty($_REQUEST['cname'])||empty ($_REQUEST['password'])||empty ($_REQUEST['email']))
    {
         $_GLOBALS['message']="Some of the required Fields are Empty";
    }else if(mysql_num_rows($result)>0)
    {
        $_GLOBALS['message']="Sorry the User Name is Not Available Try with Some Other name.";
    }
    else
    {
     $query="insert into student values($newstd,'".htmlspecialchars($_REQUEST['cname'],ENT_QUOTES)."',ENCODE('".htmlspecialchars($_REQUEST['password'],ENT_QUOTES)."','oespass'),'".htmlspecialchars($_REQUEST['email'],ENT_QUOTES)."','".htmlspecialchars($_REQUEST['contactno'],ENT_QUOTES)."','".htmlspecialchars($_REQUEST['address'],ENT_QUOTES)."','".htmlspecialchars($_REQUEST['city'],ENT_QUOTES)."','".htmlspecialchars($_REQUEST['pin'],ENT_QUOTES)."','".htmlspecialchars($_REQUEST['fname'],ENT_QUOTES)."','".htmlspecialchars($_REQUEST['lname'],ENT_QUOTES)."','".htmlspecialchars($_REQUEST['state'],ENT_QUOTES)."','".htmlspecialchars($_REQUEST['question'],ENT_QUOTES)."','".md5 (htmlspecialchars($_REQUEST['answer'],ENT_QUOTES))."','".htmlspecialchars($_REQUEST['passy'],ENT_QUOTES)."','".htmlspecialchars($_REQUEST['fathername'],ENT_QUOTES)."','".htmlspecialchars($_REQUEST['dob'],ENT_QUOTES)."','".htmlspecialchars($_REQUEST['clgname'],ENT_QUOTES)."','".htmlspecialchars($_REQUEST['branch'],ENT_QUOTES)."')";
     if(!@executeQuery($query))
                $_GLOBALS['message']=mysql_error();
     else
     {
        $success=true;
        $_GLOBALS['message']="Successfully Your Account is Created.Click <a href=\"index.php\">Here</a> to LogIn";
       // header('Location: index.php');
     }
    }
    closedb();
}
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN"
    "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html>
  <head>
    <title>Register</title>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8"/>
    <link rel="stylesheet" type="text/css" href="oes.css"/>
    <script type="text/javascript" src="validate.js" ></script>
    </head>
  <body >
       <?php

        if($_GLOBALS['message']) {
            echo "<div class=\"message\">".$_GLOBALS['message']."</div>";
        }
        ?>
      <div id="container">
     <div class="header">
                <img style="margin:10px 2px 2px 10px;float:left;" height="80" width="200" src="images/logo.gif" alt="OES"/><h3 class="headtext"> &nbsp;Student Registration  </h3><br>
            </div>
          <div class="menubar">
              <?php if(!$success): ?>

              <h2 style="text-align:center;color:#ffffff;">New User Registration</h2>
              <?php endif; ?>
             
          </div>
      <div class="page">
          <?php
          if($success)
          {
                echo "<h2 style=\"text-align:center;color:#0000ff;\">Thank You For Registering with Online Examination System.<br/><a href=\"index.php\">Login Now</a></h2>";
          }
          else
          {

          ?>
          <form id="admloginform"  action="register.php" method="post" onsubmit="return validateform('admloginform');">
                   <table cellpadding="20" width="600" cellspacing="20" style="text-align:left;margin-left:15em"  class="reg">
                   <tr>
                    <td colspan="2" style="text-align:center; font-size:12px"><font color="#FF0000">* </font>Every Feild of the form is required</td>
                </tr>
              <tr>
                  <td>First Name</td>
                  <td><input type="text" name="fname" value="" size="16" onkeyup="isalphanum(this)"/></td>

              </tr>
              <tr>
                  <td>Last Name</td>
                  <td><input type="text" name="lname" value="" size="16" onkeyup="isalphanum(this)"/></td>

              </tr>
              <tr>
                  <td>User Name</td>
                  <td><input type="text" name="cname" value="" size="16" onkeyup="isalphanum(this)"/></td>

              </tr>

                      <tr>
                  <td>Password</td>
                  <td><input type="password" name="password" value="" size="16" onkeyup="isalphanum(this)" /></td>

              </tr>
                      <tr>
                  <td>Re-type Password</td>
                  <td><input type="password" name="repass" value="" size="16" onkeyup="isalphanum(this)" /></td>

              </tr>
              <tr>
                  <td>E-mail ID</td>
                  <td><input type="text" name="email" value="" size="16" /></td>
              </tr>
                       <tr>
                  <td>Contact No</td>
                  <td><input type="text" name="contactno" maxlength="10" value="" size="16" onkeyup="isnum(this)"/></td>
              </tr>

                  <tr>
                  <td>Address</td>
                  <td><textarea name="address" cols="20" rows="3"></textarea></td>
              </tr>
                       <tr>
                  <td>City</td>
                  <td><input type="text" name="city" value="" size="16" onkeyup="isalpha(this)"/></td>
              </tr>
                  <tr>
                <td>State </td>
                <td><input required="required"  name="state" type="text" class="textfield"onkeyup="isalpha(this)"  id="state" /></td>
                </tr>
             
             
                       <tr>
                  <td>PIN Code</td>
                  <td><input type="text" name="pin" value="" maxlength="6" size="16" onkeyup="isnum(this)" /></td>
              </tr>
              
              <tr>
                  <td>Security Question </td>
                    <td><select name="question" id="question">
                    <option value="select">- select question -
                    <?php 
                    //loop through quantities table rows
                    while ($row=mysql_fetch_array($questions)){
                    echo "<option value=$row[sqid]>$row[squestion]"; 
                    }
                    ?>
                    </select></td>
                </tr>
                <tr>
                  <td>Security Answer</td>
                  <td><input name="answer" type="text" class="textfield" id="answer" /></td>
                </tr>
                
                <tr>
                <td>Branch </td>
                    <td><select  required="required" name="branch" id="branch">
                    <option value="select">- select branch -</option>
                    <option value="ME">ME</option>
  <option value="EE">EE</option>
  <option value="EC">EC</option>
  <option value="IN">IN</option>
                    </select></td>
                </tr>
              
                <tr>
                <td>DOB </td>
                <td><input name="dob" type="date"  required="required" class="textfield" id="dob" /></td>
                </tr>
                
                <tr>
                <td>Father Name </td>
                <td><input name="fathername"  required="required" type="text" class="textfield"  id="fathername" /></td>
                </tr>
                 <tr>
                <td>College Name</td>
                <td> <input required="required" name="clgname" type="text" onkeyup="isalpha(this)"  class="textfield" id="clgname" /></td>
                </tr>
                
                 <tr>
                <td>B.tech Passing Year</td>
                <td> <input name="passy" type="text" maxlength="4" class="textfield" onkeyup="isnum(this)"id="passy"  required="required" /></td>
                </tr>
                
                              
                       <tr>
                           <td style="text-align:right;"><input type="submit" name="stdsubmit" value="Register" class="subbtn" /></td>
                  <td><input type="reset" name="reset" value="Reset" class="subbtn"/></td>
              </tr>
            </table>
        </form>
       <?php } ?>
      </div>
      <div id="footer">
          <p style="font-size:70%;color:#ffffff;"> © 2014-2015. All right reserverd</p>
      </div>
      
      </div>
  </body>
</html>

