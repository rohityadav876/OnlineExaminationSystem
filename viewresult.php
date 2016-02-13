<?php include ("auth.php");
	session_start();?>
<?php
error_reporting(0);
session_start();
include_once 'oesdb.php';
if(!isset($_SESSION['stdname'])) {
    $_GLOBALS['message']="Session Timeout.Click here to <a href=\"index.php\">Re-LogIn</a>";
}
else if(isset($_REQUEST['logout'])) {
    //Log out and redirect login page
        unset($_SESSION['stdname']);
        header('Location: logout.php');

    }
    else if(isset($_REQUEST['back'])) {
        //redirect to View Result

            header('Location: viewresult.php');

        }
        else if(isset($_REQUEST['dashboard'])) {
        //redirect to dashboard

            header('Location: stdwelcome.php');

        }

?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN"
    "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html>
    <head>
        <title>View Result</title>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8"/>
        <meta http-equiv="CACHE-CONTROL" content="NO-CACHE"/>
        <meta http-equiv="PRAGMA" content="NO-CACHE"/>
        <meta name="ROBOTS" content="NONE"/>

        <link rel="stylesheet" type="text/css" href="oes.css"/>
        <script type="text/javascript" src="validate.js" ></script>
        <style type="text/css" media="print" >
           #nonPrintable{display:none;} /*class for the div or any element we do not want to print*/
		   .nonPrintable{display:none;} /*class for the div or any element we do not want to print*/
</style>

    </head>
    <body >
        <?php

        if($_GLOBALS['message']) {
            echo "<script>alert('".$_GLOBALS['message']."')</script>";
        }
        ?>
        <div id="container">
            <div class="header" id="nonPrintable">
                <img style="margin:10px 2px 2px 10px;float:left;" height="80" width="200" src="images/logo.gif" alt="OES"/><h3 class="headtext"> &nbsp;View Result </h3><br>
            </div>
            <form id="summary" action="viewresult.php" method="post">
                <div class="menubar" id="nonPrintable">
                    <ul id="menu">
                        <?php if(isset($_SESSION['stdname'])) {
                        // Navigations
                        if(isset($_REQUEST['details'])) {
              ?>
                        <li><input type="submit" value="LogOut" name="logout" class="subbtn" title="Log Out"/></li>
                        <li><input type="submit" value="Back" name="back" class="subbtn" title="View Results"/></li>
                        <?php
                        }
                        else
                        {
                            ?>
                        <li><input type="submit" value="LogOut" name="logout" class="subbtn" title="Log Out"/></li>
                        <li><input type="submit" value="DashBoard" name="dashboard" class="subbtn" title="Dash Board"/></li>
                        <?php
                        }
                        ?>

                    </ul>


                </div>
                <div class="page">

                        <?php

                        if(isset($_REQUEST['details'])) {
                            $result=executeQuery("select s.stdname,t.testname,sub.subname,DATE_FORMAT(st.starttime,'%d %M %Y %H:%i:%s') as stime,TIMEDIFF(st.endtime,st.starttime) as dur,(select sum(marks) from question where testid=".$_REQUEST['details'].") as tm,
							
							IFNULL((select sum(q.marks) from studentquestion as sq, question as q where sq.testid=q.testid and sq.qnid=q.qnid and  sq.stdanswer=q.correctanswer and sq.stdid=".$_SESSION['stdid']." and sq.testid=".$_REQUEST['details']."),0) as om ,
							
							IFNULL((select sum(q.negmark) from studentquestion as sq, question as q where sq.testid=q.testid and sq.qnid=q.qnid and  sq.stdanswer!=q.correctanswer and sq.stdid=".$_SESSION['stdid']." and sq.testid=".$_REQUEST['details']." ),0) as obneg 
							
							
							from student as s,test as t, subject as sub,studenttest as st where s.stdid=st.stdid and st.testid=t.testid and t.subid=sub.subid and st.stdid=".$_SESSION['stdid']." and st.testid=".$_REQUEST['details'].";") ;
                            if(mysql_num_rows($result)!=0) {

                                $r=mysql_fetch_array($result);
								
                        ?>
                    <table cellpadding="20" cellspacing="30" border="0" style="background:#ffffff url(images/page.png);text-align:left;line-height:20px;">
                        <tr>
                            <td colspan="2"><h3 style="color:#0000cc;text-align:center;">Test Summary</h3></td>
                        </tr>
                        <tr>
                            <td colspan="2"><button id="nonPrintable" style="width:150px; height:50px; margin-left:30%"><a href='javascript:window.print()'><img src="images/printer.png" width="16" height="16" alt=""/> print your report </a></button></td>
                        </tr>
                        <tr>
                            <td colspan="2" ><hr style="color:#168;border-width:1px;"/></td>
                        </tr>
                        <tr>
                            <td>Student Name</td>
                            <td><?php echo htmlspecialchars_decode($r['stdname'],ENT_QUOTES); ?></td>
                        </tr>
                        <tr>
                            <td>Test</td>
                            <td><?php echo htmlspecialchars_decode($r['testname'],ENT_QUOTES); ?></td>
                        </tr>
                        <tr>
                            <td>Subject</td>
                            <td><?php echo htmlspecialchars_decode($r['subname'],ENT_QUOTES); ?></td>
                        </tr>
                        <tr>
                            <td>Date and Time</td>
                            <td><?php echo $r['stime']; ?></td>
                        </tr>
                        <tr>
                            <td>Test Duration</td>
                            <td><?php echo $r['dur']; ?></td>
                        </tr>
                        <tr>
                            <td>Max. Marks</td>
                            <td><?php echo $r['tm']; ?></td>
                        </tr>
                        <tr>
                            <td>Obtained Marks</td>
                            <td><?php 
							$ma=($r['om']-$r['obneg']);
							echo $ma; ?></td>
                        </tr>
                        <tr>
                            <td>Percentage</td>
                            <td><?php echo (($ma/$r['tm'])*100)." %"; ?></td>
                        </tr>
                        <tr>
                            <td colspan="2" ><hr style="color:#168;border-width:1px;"/></td>
                        </tr>
                         <tr>
                            <td colspan="2"><h3 style="color:#0000cc;text-align:center;">Test Information in Detail</h3></td>
                        </tr>
                        
                         <tr>
                            <td colspan="2"><h5 style="color:#0000cc;text-align:center;">If you reviewed and answered any question and your answers is correct the  you will awarded full marks.</h5></td>
                        </tr>
                        <tr>
                            <td colspan="2" ><hr style="color:#9CD5EC;border-width:1px;"/></td>
                        </tr>
                    </table>
                                <?php

                                $result1=executeQuery("select q.qnid as questionid,q.question as quest,q.correctanswer as ca,sq.answered as status,sq.stdanswer as sa from studentquestion as sq,question as q where q.qnid=sq.qnid and sq.testid=q.testid and sq.testid=".$_REQUEST['details']." and sq.stdid=".$_SESSION['stdid']." order by q.qnid;" );

                                if(mysql_num_rows($result1)==0) {
                                    echo"<h3 style=\"color:#0000cc;text-align:center;\"> 1.Sorry because of some problems Individual questions Cannot be displayed.".mysql_error()."</h3>";
                                }
                                else {
                                    ?>
                    <table cellpadding="30" cellspacing="10" class="datatable">
                        <tr>
                            <th>Q. No</th>
                            <th style="width:500px;">Question</th>
                            <th>Correct Answer</th>
                            <th>Your Answer</th>
                            <th>reviewed</th>
                            <th>Score</th>
                            <th>&nbsp;</th>
                        </tr>
                                        <?php
                                        while($r1=mysql_fetch_array($result1)) {

                                        if(is_null($r1['sa']))
                                        $r1['sa']="question"; //any valid field of question
                                           $result2=executeQuery("select ".$r1['ca']." as corans,
										   IF('".$r1['status']."'='answered',(select ".$r1['sa']." from question where qnid=".$r1['questionid']." and testid=".$_REQUEST['details']."),IF('".$r1['status']."'='unanswered','<h4>UNANSWERED</h4>',IF('".$r1['status']."'='rnu','<h4> Review and Unanswered<h4>',(select ".$r1['sa']." from question where qnid=".$r1['questionid']." and testid=".$_REQUEST['details'].")))) as stdans,
										   
										 
										   IF('".$r1['status']."'='review',('YES'),'NO') as review,
										   IF('".$r1['status']."'='rnu',('YES'),'NO') as review1,										   
										    IF('".$r1['status']."'='answered' or '".$r1['status']."'='review' or '".$r1['status']."'='unanswered' ,
											IFNULL((select q.marks from question as q, studentquestion as sq where q.qnid=sq.qnid and q.testid=sq.testid and q.correctanswer=sq.stdanswer and sq.stdid=".$_SESSION['stdid']." and q.qnid=".$r1['questionid']." and q.testid=".$_REQUEST['details']."),0),0) as stdmarks,IF('".$r1['status']."'='answered' or '".$r1['status']."'='review' or '".$r1['status']."'='unanswered' ,
											IFNULL((select q.negmark from question as q, studentquestion as sq where q.qnid=sq.qnid and q.testid=sq.testid and q.correctanswer!=sq.stdanswer and sq.stdid=".$_SESSION['stdid']." and q.qnid=".$r1['questionid']." and q.testid=".$_REQUEST['details']."),0),0) as negma 
											
											 from question where qnid=".$r1['questionid']." and testid=".$_REQUEST['details'].";");

                                            if($r2=mysql_fetch_array($result2)) {
                                                ?>
                        <tr>
                            <td style="text-align:center"><?php echo $r1['questionid']; ?></td>
                            <td style="text-align:center" ><?php echo htmlspecialchars_decode($r1['quest'],ENT_QUOTES); ?></td>
                            <td style="text-align:center"><?php echo htmlspecialchars_decode($r2['corans'],ENT_QUOTES); ?></td>
                            <td style="text-align:center"><?php echo htmlspecialchars_decode($r2['stdans'],ENT_QUOTES);

									
								 ?></td>
                                 
                            <td style="text-align:center">
							
							<?php
							 if(strcmp($r2['review'],"YES")==0)
							 echo htmlspecialchars_decode($r2['review'],ENT_QUOTES);
							 else if(strcmp($r2['review1'],"YES"==0))
							 {
								 echo htmlspecialchars_decode($r2['review1'],ENT_QUOTES);
							 }
							  ?></td>
                            <td><?php echo $m=($r2['stdmarks']-$r2['negma']); ?></td>
                                                    <?php
                                                    if($r2['stdmarks']==0) {
                                                        echo"<td class=\"tddata\"><img src=\"images/wrong.png\" title=\"Wrong Answer\" height=\"30\" width=\"40\" alt=\"Wrong Answer\" /></td>";
                                                    }
                                                    else if ($r2['review']=='YES') 
													{
														echo"<td class=\"tddata\"><img src=\"images/review.png\" title=\"review Answer\" height=\"30\" width=\"40\" alt=\"review Answer\" /></td>";
														
														}else{
                                                        echo"<td class=\"tddata\"><img src=\"images/correct.png\" title=\"Correct Answer\" height=\"30\" width=\"40\" alt=\"Correct Answer\" /></td>";
                                                    }
                                                    ?>
                        </tr>
                            <?php
                                                }
                                                else {
                                                    echo"<h3 style=\"color:#0000cc;text-align:center;\">Sorry because of some problems Individual questions Cannot be displayed.</h3>".mysql_error();
                                                }
                                            }

                                        }
                                    }
                                    else {
                                        echo"<h3 style=\"color:#0000cc;text-align:center;\">Something went wrong. Please logout and Try again.</h3>".mysql_error();
                                    }
                                    ?>
                    </table>
                                <?php

                        }
                        else {


                            $result=executeQuery("select st.*,t.testname,t.testdesc,DATE_FORMAT(st.starttime,'%d %M %Y %H:%i:%s') as startt from studenttest as st,test as t where t.testid=st.testid and st.stdid=".$_SESSION['stdid']." and st.status='over' order by st.testid;");
                            if(mysql_num_rows($result)==0) {
                                echo"<h3 style=\"color:#0000cc; text-align:center; padding-top:10px; height:50px; \">I Think You Haven't Attempted Any Exams Yet..! Please Try Again After Your Attempt.</h3>";
                            }
                            else {
                            //editing components
                                ?>
                    <table cellpadding="30" cellspacing="10" class="datatable">
                        <tr>
                            <th>Date and Time</th>
                            <th>Test Name</th>
                            <th>Max. Marks</th>
                            <th>Obtained Marks</th>
                            <th>Percentage</th>
                            <th>Details</th>
                        </tr>
            <?php
            while($r=mysql_fetch_array($result)) {
                                        $i=$i+1;
                                        $om=0;
                                        $tm=0;
                                        $result1=executeQuery("select sum(q.marks) as om from studentquestion as sq, question as q where sq.testid=q.testid and sq.qnid=q.qnid  and sq.stdanswer=q.correctanswer and sq.stdid=".$_SESSION['stdid']." and sq.testid=".$r['testid']." order by sq.testid;");
                                        $r1=mysql_fetch_array($result1);
                                        $result2=executeQuery("select sum(marks) as tm from question where testid=".$r['testid'].";");
										
                                        $r2=mysql_fetch_array($result2);
										$result4=executeQuery("select sum(q.negmark) as negma from studentquestion as sq, question as q where sq.testid=q.testid and sq.qnid=q.qnid  and sq.stdanswer!=q.correctanswer and sq.stdid=".$_SESSION['stdid']." and sq.testid=".$r['testid']." order by sq.testid;");
                                        $r4=mysql_fetch_array($result4);										
                                        if($i%2==0) {
                                            echo "<tr class=\"alt\">";
                                        }
                                        else { echo "<tr>";}
                                        echo "<td>".$r['startt']."</td><td>".htmlspecialchars_decode($r['testname'],ENT_QUOTES)." : ".htmlspecialchars_decode($r['testdesc'],ENT_QUOTES)."</td>";
                                        if(is_null($r2['tm'])) {
                                            $tm=0;
                                            echo "<td>$tm</td>";
                                        }
                                        else {
                                            $tm=$r2['tm'];
                                            echo "<td>$tm</td>";
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
                                        echo"<td class=\"tddata\"><a title=\"Details\" href=\"viewresult.php?details=".$r['testid']."\"><img src=\"images/reports.png\" height=\"30\" width=\"40\" alt=\"Details\" /></a></td></tr>";
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
<?php include ("bottommenu.php");?>      </div>
  </body>
</html>