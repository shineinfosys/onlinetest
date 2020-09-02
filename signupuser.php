<?php include('template_head.php'); ?>


<div class="container">
  <div class="panel panel-default">
    <div class="panel-body">
<?php //include("header.php"); ?>


<div class="row d-flex justify-content-center">
    <div class="col-lg-6">

<?php

extract($_POST);
include("database.php");
$rs=mysqli_query($con,"select * from mst_user where login='$lid'");
if (mysqli_num_rows($rs)>0)
{
	echo '<div class="alert alert-danger">
    <strong>Alert!</strong> Login Id Already Exists. Please <a href="index.php?login=1" class="btn btn-primary alert-link">Login</a>.
  </div>';
	exit;
}
$query="insert into mst_user(user_id,login,pass,username,region,location,email) values('$uid','$lid','$pass','$name','$region','$location','$email')";


$rs=mysqli_query($con,$query)or die("Could Not Perform the Query");

echo '<div class="alert alert-success">
  		<strong>Success!</strong> User ID['.$lid.'] Created Sucessfully. <p>Please Login using your Login ID to take Quiz</p><br><a class="btn btn-primary alert-link" href="index.php?login=1">Login</a>
	</div>';


?>

</div></div>
</body>
</html>
<?php // closing connection 
mysqli_close($con); ?>
