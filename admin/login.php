<?php include('template_head.php'); ?>
      


<?php
//include("header.php");
include("../database.php");
extract($_POST);
if($_SERVER["REQUEST_METHOD"] == "POST")
{
	$query = "select * from mst_admin where loginid='$loginid' and pass='$pass'";

	//echo $query;
	$rs=mysqli_query($con,$query,$cn) or die(mysqli_error());
	if(mysqli_num_rows($rs)<1)
	{
		echo "<BR><BR><BR><BR><div class=head1> Invalid User Name or Password<br>
		<a href='index.php'>Click here to login again </a>
		<div>";
	//exit;
		echo "<script>window.location='index.php'</script>";		
	}
	else
	{
	    $row = mysqli_fetch_assoc($rs);
	    $_SESSION['region'] = $row['region'];
	    $_SESSION['user_type'] = $row['user_type'];
	    echo "<script>window.location='login.php'</script>";			
    	$_SESSION['alogin'] = "true";
    	$_SESSION['userid'] = $loginid;
	}
}
else if(!isset($_SESSION[alogin]))
{
	echo "<BR><BR><BR><BR><div class=head1> Your are not logged in<br> Please <a href=index.php>Login</a><div>";
		exit;
}

		echo"<h4 class='text-center'>Admistrative Area</h4>";	

?>

<div class="row d-flex justify-content-center">
    
<?php
// released exam code start here *******************************************************
$query = "SELECT mst_test.test_id, mst_test.test_name, mst_subject.sub_id, mst_subject.sub_name, mst_test.total_que, mst_test.time, mst_test.exam_release, mst_test.type FROM `mst_test`
            left join mst_subject on mst_test.sub_id = mst_subject.sub_id
            where mst_test.exam_release = 1 and mst_test.type = 1";
//echo $query;
$result = mysqli_query($con,$query,$cn) or die(mysqli_error());
if(mysqli_num_rows($result)>0){
    while($row = mysqli_fetch_assoc($result))
    {
        $test_id = $row['test_id'];
        $test_name = $row['test_name'];
        $sub_id = $row['sub_id'];
        $subject = $row['sub_name'];
        $total_question = $row['total_que'];
        $time = $row['time'];
        
        
        
        echo '<div class="col-lg-4">';
        echo '<div class="card" style="">';
        echo '<div class="card-body">';
        echo '<h5 class="card-title">Avaliable Online Exam - <span style="font-size:100%" class="badge badge-secondary">All Gujarat</span></h5>';
        echo '<h6 class="card-subtitle mb-2 text-muted"><span style="font-size:100%" class="badge badge-warning">'.$test_name.'</span></h6>';
        echo '<p class="card-text">Total Question: '.$total_question.'<br>Time: '.$time.'mins</p>';
        echo '<a href="testupdate.php?test_id='.$test_id.'" class="card-link btn btn-danger">Un-Release</a>';
        //echo '<a href="#" class="card-link">Another link</a>';
        echo '</div>';
        echo '</div>';  
        echo '</div>';
    }
    
}
else{
    echo '<div class="col-lg-4">';
    echo '<div class="card" style="">';
    echo '<div class="card-body">';
    echo '<h5 class="card-title">No online Exam</h5>';
    echo '<a href="testview.php" class="card-link btn btn-primary">Set Online Exam Paper</a>';
    echo '</div>';
    echo '</div>';  
    echo '</div>';
}
// released exam code end here *******************************************************




// assign exam code start here *******************************************************
$query = "SELECT mst_user.region, mst_user.exam_assign as test_id, mst_test.test_name, mst_test.total_que, mst_test.time ,mst_test.sub_id, mst_subject.sub_name FROM `mst_user` 
            inner join mst_test on mst_user.exam_assign = mst_test.test_id 
            inner join mst_subject on mst_test.sub_id = mst_subject.sub_id 
            group by mst_user.region, exam_assign 
            order by mst_user.region, exam_assign asc";
//echo $query;
$result = mysqli_query($con,$query,$cn) or die(mysqli_error());
if(mysqli_num_rows($result)>0){
    while($row = mysqli_fetch_assoc($result))
    {
        $region = $row['region'];
        $test_id = $row['test_id'];
        $test_name = $row['test_name'];
        $total_question = $row['total_que'];
        $time = $row['time'];
        $sub_id = $row['sub_id'];
        $subject = $row['sub_name'];
        
        
        echo '<div class="col-lg-4">';
        echo '<div class="card" style="">';
        echo '<div class="card-body">';
        echo '<h5 class="card-title">Assign Exam - <span style="font-size:100%" class="badge badge-secondary">'.$region.'</span></h5>';
        echo '<h6 class="card-subtitle mb-2 text-muted"><span style="font-size:100%" class="badge badge-warning">'.$test_name.'</span></h6>';
        echo '<p class="card-text">Total Question: '.$total_question.'<br>Time: '.$time.'mins</p>';
        echo '<a href="exam_reset.php?region='.$region.'&test_id='.$test_id.'&reset=0" class="card-link btn btn-secondary">Reset</a>';
        echo '<a href="testview.php" class="card-link btn btn-primary">Assign Another</a>';
        echo '</div>';
        echo '</div>';  
        echo '</div>';        
    }
}
else{
    echo '<div class="col-lg-4">';
    echo '<div class="card" style="">';
    echo '<div class="card-body">';
    echo '<h5 class="card-title">No assign Exam</h5>';
    echo '<a href="testview.php" class="card-link btn btn-primary">Assign Exam</a>';
    echo '</div>';
    echo '</div>';  
    echo '</div>';
}


// assign exam code end here *******************************************************
?>
</div>

<style>
    .card{
            margin: 10px;
            box-shadow: 1px 1px 3px 2px #ddd;
    }
    .card:hover{
        box-shadow: 1px 1px 3px 2px #b6e1ff;
    }
</style>

</body>
</html>
