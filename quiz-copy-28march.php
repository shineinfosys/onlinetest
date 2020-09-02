<?php include('template_head.php'); ?>
<?php
include("header.php");
include("database.php");

?>

<?php

error_reporting(1);
include("database.php");
extract($_POST);
extract($_GET);
extract($_SESSION);
/*$rs=mysql_query($con,"select * from mst_question where test_id=$tid",$cn) or die(mysql_error());
if($_SESSION[qn]>mysql_num_rows($rs))
{
unset($_SESSION[qn]);
exit;
}*/
if(isset($subid) && isset($testid))
{
	$_SESSION[sid]=$subid;
	$_SESSION[tid]=$testid;
	header("location:quiz.php");
}

if(!isset($_SESSION[sid]) || !isset($_SESSION[tid]))
{
	header("location: index.php");
}

?>

<div class="container">
	<div class="panel panel-default">
	  <div class="panel-body">
	  		<h2 class='text-center'></h2>
                
<?php

$query="select * from mst_question";

$rs=mysqli_query($con,"select * from mst_question where test_id=$tid",$cn) or die(mysqli_error());
if(!isset($_SESSION[qn]))
{
	
	$delete_old = "delete from mst_useranswer where sess_id='" . session_id() ."'";
	//echo $delete_old;
	$del = mysqli_query($con, $delete_old) or die(mysqli_error());
	
	if($del){
		$_SESSION[qn]=0;

	}
	else{
		echo 'Failed to delete old exam history.';
	}

	$_SESSION[trueans]=0;
	
}
else
{	
		if($submit=='Next Question' && isset($ans))
		{
				mysqli_data_seek($rs,$_SESSION[qn]);
				$row= mysqli_fetch_row($rs);	
				mysqli_query($con,"insert into mst_useranswer(sess_id, test_id, que_des, ans1,ans2,ans3,ans4,true_ans,your_ans) values ('".session_id()."', $tid,'$row[2]','$row[3]','$row[4]','$row[5]', '$row[6]','$row[7]','$ans')") or die(mysqli_error());
				if($ans==$row[7])
				{
							$_SESSION[trueans]=$_SESSION[trueans]+1;
				}
				$_SESSION[qn]=$_SESSION[qn]+1;
		}
		else if($submit=='Get Result' && isset($ans))
		{
				mysqli_data_seek($rs,$_SESSION[qn]);
				$row= mysqli_fetch_row($rs);	
				mysqli_query($con,"insert into mst_useranswer(sess_id, test_id, que_des, ans1,ans2,ans3,ans4,true_ans,your_ans) values ('".session_id()."', $tid,'$row[2]','$row[3]','$row[4]','$row[5]', '$row[6]','$row[7]','$ans')") or die(mysqli_error());
				if($ans==$row[7])
				{
							$_SESSION[trueans]=$_SESSION[trueans]+1;
				}
				$examQuery = "SELECT * FROM `mst_test` where test_id = '".$tid."'";
                $getExamName = mysqli_query($con, $examQuery) or die("Fail to get Exam Name!");
                
                if (mysqli_num_rows($getExamName) > 0) {
                    while($row = mysqli_fetch_assoc($getExamName)) {
                       $exam =  $row["test_name"]. "<br>";
                    }
                 }
                
				echo "<h2> Result of <span style='font-weight:bold;text-decoration: underline;'>".$exam."[".$tid."]</b> - ".ucwords($_SESSION[login])."</h2>";
				$_SESSION[qn]=$_SESSION[qn]+1;
				
				
				echo '<table align=center class="table table-hover"><tr class="table-primary"><td>Total Question<td>'.$_SESSION[qn].'</td></tr>';
				echo '<tr class="table-success"><td>Right Answer</td><td>'.$_SESSION[trueans].'</td></tr>';
				$w=$_SESSION[qn]-$_SESSION[trueans];
				echo '<tr class="table-danger"><td>Wrong Answer<td> '. $w.'</td></tr>';
				echo "</table>";
				$date = new DateTime();
                $date->add(new DateInterval('PT5H30M'));
                $currentdatetime = $date->format('Y-m-d H:i:s');
                //mysqli_query($con, "delete from mst_result where test_id = '".$tid."' and login = '".$login."' ");
				mysqli_query($con, "insert into mst_result(login,test_id,test_date,score) values('$login',$tid,'".$currentdatetime."',$_SESSION[trueans])") or die(mysqli_error());
				echo "<h1 align=center><a href=review.php?test_id=".$tid."> Review Question</a> </h1>";
				unset($_SESSION[qn]);
				unset($_SESSION[sid]);
				unset($_SESSION[tid]);
				unset($_SESSION[trueans]);
				exit;
		}
}
$rs=mysqli_query($con,"select * from mst_question where test_id=$tid",$cn) or die(mysqli_error());
if($_SESSION[qn]>mysqli_num_rows($rs)-1)
{
	unset($_SESSION[qn]);
	echo "<h1 class=head1>Some Error  Occured</h1>";
	session_destroy();
	echo "Please <a href=index.php> Start Again</a>";

	exit;
}
mysqli_data_seek($rs,$_SESSION[qn]);
$row= mysqli_fetch_row($rs);
echo "<form name=myfm method=post action=quiz.php>";
$n=$_SESSION[qn]+1;
?>
	<h3><?php echo '<span style="color: #8e8e8e;font-style: italic;font-variant: diagonal-fractions;font-weight: bold;">Q'.$n.'.</span> '; echo $row[2]; ?></h3>
	<div class="form-check">
	  <label class="form-check-label">
	    <input type="radio" class="form-check-input" name="ans" value="1"><?php echo $row[3]; ?>
	  </label>
	</div>
	<div class="form-check">
	  <label class="form-check-label">
	    <input type="radio" class="form-check-input" name="ans" value="2"><?php echo $row[4]; ?>
	  </label>
	</div>
	<div class="form-check">
	  <label class="form-check-label">
	    <input type="radio" class="form-check-input" name="ans"  value="3"><?php echo $row[5]; ?>
	  </label>
	</div>
	<div class="form-check ">
	  <label class="form-check-label">
	    <input type="radio" class="form-check-input" name="ans" value="4" ><?php echo $row[6]; ?>
	  </label>
	</div>
<?php


if($_SESSION[qn]<mysqli_num_rows($rs)-1)
echo "<input type=submit name=submit value='Next Question'></form>";
else
echo "<input type=submit name=submit value='Get Result'></form>";
echo "";
?>










<?php // closing connection 
mysqli_close($con); ?>
</div></div></div>
</body>
</html>