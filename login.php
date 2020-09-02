<?php include('template_head.php'); ?>


<div class="container">
	<div class="panel panel-default">
	  <div class="panel-body">
	      
	      
	      
	  	<!--<h3>Welcome to Online Exam</h3>-->
		<?php
        //include("header.php");
		include("database.php");
		extract($_POST);

		if(isset($submit))
		{
			$rs=mysqli_query($con,"select * from mst_user where login='$loginid' and pass='$pass'");
			$row = mysqli_fetch_assoc($rs);
			if(mysqli_num_rows($rs)<1)
			{
				$found="N";
			}
			else
			{
				$_SESSION['login'] = $row['login'];
				$_SESSION['user_id'] = $row['user_id'];
				$_SESSION['username'] = $row['username'];
				$_SESSION['region'] = $row['region'];
				$_SESSION['location'] = $row['location'];
				$_SESSION['exam_assign'] = $row['exam_assign'];
			}
		}
		if (isset($_SESSION['login']))
		{
		?>
		
		<style>
		    body{
		        display:block;
		        background:none;
		    }
		</style>
			<div class="row">
			  	<div class="col-lg-12">
			  		
	  		<?php
	  			$i = 1;
	  			if($_SESSION['user_id']){
	  			    $query = "SELECT mst_test.sub_id, mst_test.test_id, mst_test.test_name, mst_test.total_que, mst_test.time FROM mst_user 
                            right join mst_test on mst_test.test_id = mst_user.exam_assign
                            where mst_user.user_id = '".$_SESSION['user_id']."'
                            UNION
                                SELECT mst_test.sub_id, mst_test.test_id, mst_test.test_name, mst_test.total_que, mst_test.time FROM `mst_test` where exam_release = 1 and type = 1
                            ";    
	  			}
	  			else{
	  			    $query = "SELECT mst_test.sub_id, mst_test.test_id, mst_test.test_name, mst_test.total_que, mst_test.time FROM `mst_test` where exam_release = 1 and type = 1";
	  			}
	  			
	  			//echo $query;
	  			
				
				$rs = mysqli_query($con, $query);
				if(!$rs){
				    echo mysqli_error($con);
				}
				$result_row = mysqli_num_rows($rs);
				
				
				if($result_row > 0)
				{
				    echo "<h3 class='text-center'>Available Exam</h3>";
					echo "<table class='table table-striped table-hover table-condensed'>";
					echo '<tr><th>Exam Name</th><th>Question</th><th>Time</th></tr>';
					while($row=mysqli_fetch_assoc($rs))
					{
						//echo '<tr><td>'.$i.'</td>';
						echo "<tr><td><a href=quiz.php?testid=".$row['test_id']."&subid=".$row['sub_id']."><font size=4>".$row['test_name']."</font></a></td>";
						echo '<td>'.$row['total_que'].'</td>';
						echo '<td>'.$row['time'].'mins </td>';
						echo '</tr>';
						$i++;
					}
					echo "</table>";
					
		        }
		        else{
		            echo "<h4 class='text-center'>No available Exam</h4>";
		        }
			?>
			  	</div>
			  </div>
		<?php
				exit();
		}
		else{
		    ?>
		    <style>
		    body{
		        display:block;
		        background:#ddd;
		    }
		    
		</style>
		    
		    <?php
		}
		?>



	  <div class="row d-flex justify-content-center">
	  	<div class="col-lg-4" style="border: 1px solid #ddd;border-radius: 5px;padding: 20px;background: #fff;box-shadow: 1px 1px 8px 0px #888888;margin-top: 50px;">
	  	    <?php if($_GET['alert'] == 1){
				    echo '<h4 class="text-danger">You are not login, Please login!</h4>';
				}
				else if($_GET['alert'] == 2){
				    echo '<h4 class="text-success">You are successfully logout!</h4>';
				}
				
				?>
	  		<form method="post" action="index.php">
				
				<div class="form-group">
                  <label for="loginid2">User ID</label>
                  <input type="text" class="form-control" id="loginid2" name="loginid" placeholder="Enter User ID" required>
                </div>

                <div class="form-group">
                  <label for="pass2">Password</label>
                  <input type="password" class="form-control" id="pass2" name="pass" placeholder="Enter Password" required>
                </div>

                <div class="form-group">
                  <a class="btn btn-light" href="signup.php">Register! Yourself</a>
                  <input type="submit" class="btn btn-primary" id="submit" name="submit" style="" Value="  Login  " />
                </div>

                <div class="form-group">
                  
                </div>

				
			    
			    <?php
				if(isset($found))
				{
				    echo '<div class="alert alert-danger" role="alert">';
					echo "Invalid User ID or Password";
					echo '</div>';
				}
				?>
					
					    
				   
				    </form>

				    
	  	</div>
	  </div>

	  </div>
	</div>
</div> <!-- container div -->
</body>
</html>
<?php // closing connection 
mysqli_close($con); ?>