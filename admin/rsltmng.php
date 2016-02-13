
<?php include ("auth.php");?>
<?php
error_reporting(0);
session_start();
include_once '../oesdb.php';
/************************** Step 1 *************************/
if(!isset($_SESSION['admname'])) {
    $_GLOBALS['message']="Session Timeout.Click here to <a href=\"login.php\">Re-LogIn</a>";
}
else if(isset($_REQUEST['logout'])) {
    /************************** Step 2 - Case 1 *************************/
    //Log out and redirect login page
        unset($_SESSION['admname']);
        header('Location: logout.php');

    }
    else if(isset($_REQUEST['dashboard'])) {
    /************************** Step 2 - Case 2 *************************/
        //redirect to dashboard
            header('Location: index.php');

        }
        else if(isset($_REQUEST['back'])) {
    /************************** Step 2 - Case 3s *************************/
            //redirect to Result Management
                header('Location: rsltmng.php');

            }

?>
<html>
    <head>
        <title>Manage Results of students</title>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8"/>

 <style type="text/css" media="print" >
           #nonPrintable{display:none;} /*ID for the div or any element we do not want to print*/
		   .nonPrintable{display:none;} /*class for the div or any element we do not want to print*/
</style>

    </head>
    <body>
        <?php

        if($_GLOBALS['message']) {
            echo "<script>alert('".$_GLOBALS['message']."')</script>";
        }
        ?>
        <div id="container" >
            <div class="header" id="nonPrintable">
                <img style="margin:10px 2px 2px 10px;float:left;" height="80" width="200" src="../images/logo.gif" alt="OES"/><h3 class="headtext"> &nbsp;Result management System </h3><br>
            </div>
            <form name="rsltmng" action="rsltmng.php" method="post">
                <div class="menubar" id="nonPrintable" >


                    <ul id="menu">
                        <?php if(isset($_SESSION['admname'])) {
                        // Navigations

                            ?>
                        <li><input type="submit" value="LogOut" name="logout" class="subbtn" title="Log Out"/></li>
                            <?php  if(isset($_REQUEST['testid'])) { ?>
                        <li><input type="submit" value="Back" name="back" class="subbtn" title="Manage Results"/></li>
                            <?php }else { ?>
                        <li><input type="submit" value="DashBoard" name="dashboard" class="subbtn" title="Dash Board"/></li>
                            <?php } ?>
                    </ul>
                </div>
                <div class="page" >
                        <?php
                        if(isset($_REQUEST['testid'])) 
						{
                            $result=executeQuery("select t.testname,DATE_FORMAT(t.testfrom,'%d %M %Y') as fromdate,DATE_FORMAT(t.testto,'%d %M %Y %H:%i:%S') as todate,sub.subname,IFNULL((select sum(marks) from question where testid=".$_REQUEST['testid']."),0) as maxmarks from test as t, subject as sub where sub.subid=t.subid and t.testid=".$_REQUEST['testid'].";") ;
							
							$result1=executeQuery("select count(distinct stdid) from studentquestion as st where st.testid=".$_REQUEST['testid']."");
							$r1=mysql_fetch_array($result1);
							
                            if(mysql_num_rows($result)!=0) 
							{

                                $r=mysql_fetch_array($result);
                                ?>
                    <table cellpadding="20" cellspacing="30" border="0" style="background:#CDCDCD url(../images/page.png);text-align:left;line-height:20px;">
                        <tr>
                            <td colspan="2"><h3 style="color:#0000cc;text-align:center;">Test Summary</h3></td>
                        </tr>
                        <tr>
                            <td colspan="2"><button id="nonPrintable" style="width:150px; height:50px; margin-left:37%"><a href='javascript:window.print()'> <img src="../images/printer.png" width="16" height="16" alt=""/> Print this report</a></button></td>
                        </tr>
                        <tr>
                            <td colspan="2" ><hr style="margin-top:-30px;"></td>
                        </tr>
                        <tr>
                            <td>Test Name</td>
                            <td><?php echo htmlspecialchars_decode($r['testname'],ENT_QUOTES); ?></td>
                        </tr>
                        <tr>
                            <td>Subject Name</td>
                            <td><?php echo htmlspecialchars_decode($r['subname'],ENT_QUOTES); ?></td>
                        </tr>
                        <tr>
                            <td>Validity</td>
                            <td><?php echo $r['fromdate']." To ".$r['todate']; ?></td>
                        </tr>
                        <tr>
                            <td>Max. Marks</td>
                            <td><?php echo $r['maxmarks']; ?></td>
                        </tr>
                        <tr><td colspan="2"><hr ></td></tr>
                        <tr>
                            <td colspan="2"><h3 style="color:#0000cc;text-align:center;">Attempted Students</h3></td>
                        </tr>
                        <tr>
                            <td colspan="2" ><hr style="color:#ff0000;border-width:1px; margin-top:-30px;"/></td>
                        </tr>
                        
                        <tr style="margin-top:-100px;">
                            <td colspan="2" style="color:#000;border-width:1px; margin-top:-100px;"> Total student appears in the examination is =<?php echo $r1['count(distinct stdid)']; ?></td>
                        </tr>

                    </table>
                                <?php

                                $result=executeQuery("select s.stdname,s.stdid,s.emailid from studenttest as st, student as s where s.stdid=st.stdid and st.testid=".$_REQUEST['testid']." order by st.stdid;" );
								
								$result2=executeQuery("select sq.stdanswer,sq.answered,q.correctanswer,q.marks,q.negmark from studentquestion as sq, question as q where sq.testid=q.testid  and sq.qnid=q.qnid and  sq.testid=".$_REQUEST['testid']." order by sq.stdid;" );
								$result3 = executeQuery("select totalquestions from test where test.testid=".$_REQUEST['testid']." ;");
 $r3 = mysql_fetch_array($result3);
 

                                if(mysql_num_rows($result1)==0) {
                                    echo"<h3 style=\"color:#0000cc;text-align:center;\">No Students Yet Attempted this Test!</h3>";
                                }
                                else {
                                    ?>
                    <table cellpadding="30" cellspacing="10" class="datatable">
                        <tr>
                            <th>Student Name</th>
                            <th>Email-ID</th>
                            <th>Obtained Marks</th>
                            <th>Result(%)</th>

                        </tr>
                                        <?php
										            while($r=mysql_fetch_array($result)) {
                                        $i=$i+1;
                                        $om=0;
                                        $tm=0;
                                        $result1=executeQuery("select sum(q.marks) as om from studentquestion as sq, question as q where sq.testid=q.testid and sq.qnid=q.qnid  and sq.stdanswer=q.correctanswer and sq.stdid=".$r['stdid']." and sq.testid=".$_REQUEST['testid']." order by sq.stdid;");
                                        $r1=mysql_fetch_array($result1);
                                        $result2=executeQuery("select sum(marks) as tm from question where testid=".$_REQUEST['testid'].";");
                                        $r2=mysql_fetch_array($result2);
										
										$result4=executeQuery("select sum(q.negmark) as negma from studentquestion as sq, question as q where sq.testid=q.testid and sq.qnid=q.qnid  and sq.stdanswer!=q.correctanswer and sq.stdid=".$r['stdid']." and sq.testid=".$_REQUEST['testid']." order by sq.stdid;");
                                        $r4=mysql_fetch_array($result4);										
                                        if($i%2==0) {
                                            echo "<tr class=\"alt\">";
                                        }
                                        else { echo "<tr>";}
                                        echo "<td>".$r['stdname']."</td><td>".htmlspecialchars_decode($r['emailid'],ENT_QUOTES)."</td>";
                                        if(is_null($r2['tm'])) {
                                            $tm=0;
                                            
                                        }
                                        else {
                                            $tm=$r2['tm'];
                                            
                                        }
                                        if(is_null($r1['om']) and is_null($r4['negma'])) {
                                            $om=0;
                                            echo "<td>$om</td>";
                                        }
                                        else {
                                            $om=($r1['om']-$r4['negma']);
											
                                            echo "<td>$om</td>";
                                        }
                                        if($tm==0) {
                                            echo "<td>0</td>";
                                        }
                                        else {
                                            echo "<td>".(($om/$tm)*100)." %</td>";
                                        }
                                        
                                    }
										
										    ?>

                                        <?php
							
                                        
								   
										}
										}
                                else {
                                    echo"<h3 style=\"color:#0000cc;text-align:center;\">Something went wrong. Please logout and Try again.</h3>";
                                }
                                ?>
                    </table>


                        <?php

                        }
						
                        else {

                            $result=executeQuery("select t.testid,t.testname,DATE_FORMAT(t.testfrom,'%d %M %Y') as fromdate,DATE_FORMAT(t.testto,'%d %M %Y %H:%i:%S') as todate,sub.subname,(select count(stdid) from studenttest where testid=t.testid) as attemptedstudents from test as t, subject as sub where sub.subid=t.subid;");
                            if(mysql_num_rows($result)==0) {
                                echo "<h3 style=\"color:#0000cc;text-align:center;\">No Tests Yet...!</h3>";
                            }
                            else {
                                $i=0;

                                ?>
                    <table cellpadding="30" cellspacing="10" class="datatable">
                        <tr>
                            <th>Test Name</th>
                            <th>Validity</th>
                            <th>Subject Name</th>
                            <th>Attempted Students</th>
                            <th>Details</th>
                        </tr>
            <?php
                                    while($r=mysql_fetch_array($result)) {
                                        $i=$i+1;
                                        if($i%2==0) {
                                            echo "<tr class=\"alt\">";
                                        }
                                        else { echo "<tr>";}
                                        echo "<td>".htmlspecialchars_decode($r['testname'],ENT_QUOTES)."</td><td>".$r['fromdate']." To ".$r['todate']." PM </td>"
                                            ."<td>".htmlspecialchars_decode($r['subname'],ENT_QUOTES)."</td><td>".$r['attemptedstudents']."</td>"
                                            ."<td class=\"tddata\"><a title=\"Details\" href=\"rsltmng.php?testid=".$r['testid']."\"><img src=\"../images/reports.png\" height=\"30\" width=\"40\" alt=\"Students result report\" /></a></td></tr>";
                                    }
                                    ?>
                    </table>
        <?php
                            }
                        }
                        closedb();
                    }

                    ?>

                </div>
            </form>
            <?php require_once("ABottom.php");?>
      </div>
  </body>
</html>

