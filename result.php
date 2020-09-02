<?php include('template_head.php'); ?>


<div class="container">
	<div class="panel panel-default">
	  <div class="panel-body">
      <div class="row">
        <div class="col-lg-8">
<?php
include("header.php");
include("database.php");
extract($_SESSION);

$query = "SELECT mst_result.user_id, mst_result.login, mst_result.test_id, mst_test.test_name, mst_result.test_date, mst_test.total_que, mst_result.score, mst_result.unique_exam_key FROM `mst_result` 
left join mst_test on mst_test.test_id = mst_result.test_id 
where mst_result.user_id = '".$_SESSION['user_id']."' order by mst_result.test_date desc limit 20";

//echo $query;

$rs=mysqli_query($con,$query,$cn) or die(mysqli_error());

echo "<h3 class=head1> Result </h3>";
echo '[Click on exam titile to review]';
if(mysqli_num_rows($rs)<1)
{
	echo "<br><br><h1 class=head1> You have not given any quiz</h1>";
	exit;
}
echo '<div class="table-responsive"><table class="table table-striped table-bordered table-condensed table-hover" align=center><thead class="thead-dark"><tr><th>Time</th><th>Exam Title<th>Score</thead>';
while($row=mysqli_fetch_row($rs))
{
    $score = number_format($row[6]/$row[5]*100,2);
    echo '<tr>';
    
    $unique_exam_key = $row[7];
    $tid = $row[2];
    
    echo "<td>".date_format(date_create($row[4]),"dM'y H:iA")."</td>";
    
    echo "<td><a class='text-secondary' href=review.php?unique_exam_key='".$unique_exam_key."'&test_id=".$tid.">".$row[3]."</a> </td>";
    
    
    if($score > 90){
        echo "<td class='text-success'>";  echo $score."%";  
    }
    else if($score > 60 && $score < 90){
        echo "<td class='text-warning'>"; echo $score."%";
    }
    else
    {
        echo "<td class='text-danger'>"; echo $score."%";
    }
    
    
    echo "</tr>";

}
echo "</table></div>";
?>
</div></div>
</div></div></div>
</body>
</html>
<?php // closing connection 
mysqli_close($con); ?>