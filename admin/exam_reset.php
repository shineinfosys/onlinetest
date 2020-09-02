<?php include('template_head.php'); ?>


      <div class="row">
        <div class="col-lg-8">
<?php
include("header.php");
include("../database.php");
extract($_REQUEST);
$test_id = $_GET['test_id'];


if(isset($test_id) && isset($region) && isset($reset))
{
    $query = "UPDATE `mst_user` SET `exam_assign` = '' WHERE `mst_user`.`region` = '".$region."'";
    //echo $query;
    
    if (mysqli_multi_query($con, $query)) {
        echo '<div class="alert alert-success" role="alert">
          Assign exam reset done successfully.
        </div>';
        echo '<a class="btn btn-primary" href="login.php" role="button">Back to Home Page</a>';
    }
    else
    {
        echo mysqli_error($con);
    }
}


   
    
?>

<p>&nbsp; </p>
</div></div></div></div></div>
<?php mysqli_close($con); ?>
</body>
</html>