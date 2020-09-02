<?php include('template_head.php'); ?>


      <div class="row">
        <div class="col-lg-8">
<?php
include("header.php");
include("../database.php");
 $id=$_GET['test_id'];

$sql=mysqli_query($con,"delete from mst_test where test_id='$id'");
header('location:testview.php');
?>

</div></div></div></div></div>
</body>
</html>