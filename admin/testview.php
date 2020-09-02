<?php include('template_head.php'); ?>


      <div class="row">
        <div class="col-lg-8">


<?php
include("header.php");
include("../database.php");
{
$sql=mysqli_query($con,"select * from mst_test order by sub_id, test_name asc");	
	
	echo '<div class="table-responsive">';          
  	echo '<table class="table table-hover table-bordered">';
	echo"<thead><tr><th colspan=5><a class='btn btn-danger' href=\"testadd.php\"> ADD Test</a>&emsp;&emsp;</th></tr>";
	echo "<tr><th class='text-primary'>ID</th><th class='text-primary'>Test Paper</th>
	<th class='text-primary'>Que</th>
	<th class='text-primary'>Update</th>
	<th class='text-primary'>Delete</th></tr></thead><tbody>";
	
	while($result=mysqli_fetch_assoc($sql))
	{
$id=$result['test_id'];
	
	echo "<tr>";	
	echo "<td>".$result['test_id']. "</td>";
	echo "<td>".$result['test_name']."</td>";
	echo "<td>".$result['total_que']."</td>";
	echo "<td><a href='testupdate.php?test_id=$id'><i class='fa fa-pencil-square-o'></i>Update</a></td>";
	echo "<td><a href='testdelete.php?test_id=$id'><i class='fa fa-trash-o'></i>Delete</a></td>";
	echo "</tr>";
	}
	echo "</tbody></table>";


}
?>
</div></div></div></div></div>
</body>
</html>