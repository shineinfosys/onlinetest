<?php include('template_head.php'); ?>
    	<div class="row">
    		<div class="col-lg-8">
<?php
include("header.php");
include("../database.php");



	$sql=mysqli_query($con,"select * from mst_subject");	
	
	echo '<div class="table-responsive">';          
  	echo '<table class="table table-hover table-bordered">';
	
	echo "<thead><tr><th colspan=4><a class='btn btn-danger' href='subadd.php'>Add Subject</a></th></tr>";
	echo "<tr><th class='text-primary'>ID</th><th class='text-primary'>name</th>
	<th class='text-primary'>Update</th>
	<th class='text-primary'>Delete</th></tr></thead><tbody>";
	
	while($result=mysqli_fetch_assoc($sql))
	{
		$id=$result['sub_id'];
	
		echo "<tr>";	
		echo "<td>".$result['sub_id']. "</td>";
		echo "<td>".$result['sub_name']."</td>";
		echo "<td><a href='subupdate.php?sub_id=$id'><i class='fa fa-pencil-square-o'></i>Update</a></td>";
		echo "<td><a href='subdelete.php?sub_id=$id'><i class='fa fa-trash-o'></i>Delete</a></td>";
		echo "</tr>";
	}
	echo "</tbody></table>";

?>
</div></div>
</div></div></div>
</body>
</html>
