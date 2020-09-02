<?php include('template_head.php'); ?>
<?php


?>

<div class="container">
	<div class="panel panel-default">
	  <div class="panel-body">
	      <?php
	        include("header.php");
            include("database.php");
	      ?>
	  		<h2 class='text-center'>Subject List</h2>
	  		<?php
	  			$i = 1;
				$rs=mysqli_query($con,"select * from mst_subject");
					echo "<table class='table table-striped table-hover'>";
					echo '<tr><th>#</th><th>Subjects</th></tr>';
					while($row=mysqli_fetch_row($rs))
					{
						echo '<tr><td>'.$i.'</td>';
						echo "<td><a href=showtest.php?subid=$row[0]><font size=4>$row[1]</font></a></td>";
						echo '</tr>';
						$i++;
					}
					echo "</table>";
			?>

	  </div>
	</div>
</div>
</body>
</html>
<?php // closing connection 
mysqli_close($con); ?>