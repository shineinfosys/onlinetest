<?php include('template_head.php'); ?>

<div class="row">
        <div class="col-lg-8">


<?php
include("header.php");
include("../database.php");
 $id=$_GET['sub_id'];

$sql=mysqli_query($con,"delete from mst_subject where sub_id='$id'");
header('location:viewsub.php');
?>

</div></div></div></div></div>
</body>
</html>