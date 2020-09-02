<?php include('template_head.php'); ?>


<div class="container">
	<div class="panel panel-default">
	  <div class="panel-body">
		<?php
		include("header.php");
		include("database.php");
		extract($_GET);
		$rs1=mysqli_query($con,"select sub_name from mst_subject where sub_id=$subid");
		$row1=mysqli_fetch_array($rs1);
		

?>
		<div class="list-group">
		  <a href="#" class="list-group-item list-group-item-action active"><?php echo $row1[0]; ?></a>
		  
		  
		

<?php
		
		$rs=mysqli_query($con,"select * from mst_test where exam_release = 1 and sub_id=$subid");
		if(mysqli_num_rows($rs)<1)
		{
			echo '<a href="#" class="list-group-item list-group-item-action">No Quiz for this Subject</a>';
			exit;
		}
		
		while($row=mysqli_fetch_row($rs))
		{
			echo '<a href="quiz.php?testid='.$row[0].'&subid='.$subid.'" class="list-group-item list-group-item-action">'.$row[2].'</a>';
		}
		
		?>

		</div>
	</div>
</div>
</div>
<?php // closing connection 
mysqli_close($con); ?>

</body>
</html>
