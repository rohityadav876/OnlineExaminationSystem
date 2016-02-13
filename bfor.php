<?php
error_reporting(0);
session_start();
include_once 'oesdb.php';
if(isset($_REQUEST['change']))
    {
        //redirect to testconducter
       
       $_SESSION['qn']=substr($_REQUEST['change'],2);
       header('Location: testconducter.php');

    }
?>

           <form id="button" action="bfor.php" method="post">
          
    
          <?php
		     $result10=executeQuery("select * from studentquestion where testid=".$_SESSION['testid']." and stdid=".$_SESSION['stdid']." order by qnid ;");
                        if(mysql_num_rows($result10)==0) {
                          echo"<h3 style=\"color:#0000cc;text-align:center;\">Please Try Again.</h3>";
                        }
                        else
                        {
                           //editing components
                 ?>
                 
        <?php
		
                        while($r10=mysql_fetch_array($result10))
						 {
                                    $i=$i+1;
                                    
                                    
                                    if(strcmp(htmlspecialchars_decode($r10['answered'],ENT_QUOTES),"unanswered")==0 )
                                    {
                                        echo"<input style='color:#000000;  background:url(\"images/unanswered.png\");' type=\"submit\" value=\"Q ".$r10['qnid']."\" name=\"change\"  />";
                                    }
									else if (strcmp(htmlspecialchars_decode($r10['answered'],ENT_QUOTES),"review")==0)
									{
echo"<td><input style='color:#FFF; background:url(\"images/reviewnans.png\");' type=\"submit\" value=\"Q ".$r10['qnid']."\" name=\"change\" class=\"ssubbtn\" /></td></tr>";
									}
									else if(strcmp(htmlspecialchars_decode($r10['answered'],ENT_QUOTES),"rnu")==0)
									{
	
echo"<input style='color:#FFF; background:url(\"images/review.png\");' type=\"submit\" value=\"Q ".$r10['qnid']."\" name=\"change\" class=\"ssubbtn\" />";

									}
									
                                    else
                                    {
 
echo"<input style='color:#fff; background:url(\"images/answered.png\");' type=\"submit\" value=\"Q ".$r10['qnid']."\" name=\"change\" class=\"ssubbtn\" />";

                                    }
                                }
						}
                     
           ?>
                        

  

           </form>
