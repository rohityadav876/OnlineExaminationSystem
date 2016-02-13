<?php
session_start();
if(isset($_REQUEST['button']))
    {
        //redirect to testconducter
       
       $_SESSION['qn']=substr($_REQUEST['change'],7);
       header('Location: testconducter.php');

    }
?>
<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>looped buttons</title>
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
button
{
	width:50px;
}
.text a
{
	text-decoration:none;
	}
</style>
</head>
<body>
<form id="button" action="button.php" method="post">
<div class="text">
<?php
session_start();
include_once 'oesdb.php';
$j= $_SESSION['tqn'];

for($i=$_SESSION['qn']; $i<$j+1;$i++)
{
	
                        $result=executeQuery("select * from studentquestion where testid=".$_SESSION['testid']." and stdid=".$_SESSION['stdid']." order by qnid ;");
                        if(mysql_num_rows($result)==0) {
                          echo"<h3 style=\"color:#0000cc;text-align:center;\">Please Try Again.</h3>";
                        }
                        else
                        {

?>

                  <?php
                        while($r=mysql_fetch_array($result)) {
                                    $i=$i+1;
                                    if($i%2==0)
                                    {
                                    
                                    }
                                   
                                    if(strcmp(htmlspecialchars_decode($r['answered'],ENT_QUOTES),"unanswered")==0 )
                                    {
                                        echo " <button style=' background-color:black' type='button' name='button'><a href='http://www.google.com'>".$r['qnid']."</a></button>";
                                    }
									else if (strcmp(htmlspecialchars_decode($r['answered'],ENT_QUOTES),"review")==0)
									{
										
										echo " <button style=' background-color:black' type='button' name='button'><a href='http://www.google.com'>".$r['qnid']."</a></button>";
									}
									else if(strcmp(htmlspecialchars_decode($r['answered'],ENT_QUOTES),"rnu")==0)
									{
										
						              	echo " <button style='color:#168; background-color:#168' type='button' name='button'><a href='http://www.google.com'>".$r['qnid']."</a></button>";
									}
									
                                    else
                                    {
                                       echo " <button style='color:#168; background-color:#f60' type='button' name='button'><a href='http://www.google.com'>".$r['qnid']."</a></button>";
                                    }
						}}
                  
}
               ?>
	</div>
    </form>
</body>
</html>













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
						}
                                ?>
                        

  


