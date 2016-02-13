<?php include ("auth.php");?>

<?php
error_reporting(0);
session_start();
include_once 'oesdb.php';
if(isset($_REQUEST['change']))
    {
        //redirect to testconducter
       
       $_SESSION['qn']=substr($_REQUEST['change'],7);
       header('Location: testconducter.php');

    }
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN"
    "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">

<html>
  <head>
    <title>Summary</title>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8"/>
    <meta http-equiv="CACHE-CONTROL" content="NO-CACHE"/>
    <meta http-equiv="PRAGMA" content="NO-CACHE"/>
    <meta name="ROBOTS" content="NONE"/>


    <script type="text/javascript" src="validate.js" ></script>
    <script type="text/javascript" src="cdtimer.js" ></script>
        <style>
.text
{
	overflow:scroll;
	border-radius:5px;
	border:2px solid #21E078;
	color:#000000;
	background:#FFFFFF;
	width:200px;
	height:200px;
}
</style>



    </head>
  <body >
  <div class="text">
    
           <form id="summary" action="summary.php" method="post">
          
    
          <?php

                        $result=executeQuery("select * from studentquestion where testid=".$_SESSION['testid']." and stdid=".$_SESSION['stdid']." order by qnid ;");
                        if(mysql_num_rows($result)==0) {
                          echo"<h3 style=\"color:#0000cc;text-align:center;\">Please Try Again.</h3>";
                        }
                        else
                        {
                           //editing components
                 ?>
                 
        <?php
                        while($r=mysql_fetch_array($result)) {
                                    $i=$i+1;
                                    if($i%2==0)
                                    {
                                    echo " ";
                                    }
                                    
                                    if(strcmp(htmlspecialchars_decode($r['answered'],ENT_QUOTES),"unanswered")==0 )
                                    {
                                        echo"<input style='color:#168; background-color:#f60' type=\"submit\" value=\"Change ".$r['qnid']."\" name=\"change\" class=\"ssubbtn\" />";
                                    }
									else if (strcmp(htmlspecialchars_decode($r['answered'],ENT_QUOTES),"review")==0)
									{
echo"<td><input style='color:#FFF; background-color:#f60' type=\"submit\" value=\"Change ".$r['qnid']."\" name=\"change\" class=\"ssubbtn\" /></td></tr>";
									}
									else if(strcmp(htmlspecialchars_decode($r['answered'],ENT_QUOTES),"rnu")==0)
									{
	
echo"<input style='color:#000; background-color:#f60' type=\"submit\" value=\"Change ".$r['qnid']."\" name=\"change\" class=\"ssubbtn\" />";


									}
									
                                    else
                                    {
 
echo"<input style='color:#FFc; background-color:#f60' type=\"submit\" value=\"Change ".$r['qnid']."\" name=\"change\" class=\"ssubbtn\" />";

                                    }
                                }

                                ?>
                            <?php
                            }
                            closedb();

         
                    
                    ?>

  

           </form>
               </div>
  </body>
</html>

