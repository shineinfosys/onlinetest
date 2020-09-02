<?php include('template_head.php'); ?>


      <div class="row">
        <div class="col-lg-12">
<?php
include("header.php");
include("../database.php");
//extract($_REQUEST);



if(isset($_GET['action']) && isset($_GET['region']) && isset($_GET['location']) && isset($_GET['user_id']) && isset($_GET['login']))
{
    $action = $_GET['action'];
    $region = $_GET['region'];
    $location = $_GET['location'];
    $user_id = $_GET['user_id'];
    $login = $_GET['login'];
    //show details... 
        
    $query = "SELECT * FROM `mst_user` where `user_id` = ".$user_id;
    
    if($sql=mysqli_query($con,$query))
    {
        $rowcount=mysqli_num_rows($sql);
        if($rowcount == 1)
    	{
    	    
    	    $row = mysqli_fetch_assoc($sql);
?>    	    
    	    <div class="row" id="dd">
            <div class="col-lg-6">
                <div class="alert alert-danger" role="alert">
                    User Details to delete!
                </div>
                <form name="form1" method="post">
                    <input class="form-control" type="hidden" id="userid" name="userid" value="<?php echo $row['user_id']; ?>">
                  <div class="form-group">
                    <label for="name">User ID:</label>
                    <div class="input-group">
                        <input class="form-control" type="text" id="user_id" name="user_id" value="<?php echo $row['user_id']; ?>" disabled="disabled" required>
                        <input class="form-control" type="text" id="login" name="login" value="<?php echo $row['login']; ?>" disabled="disabled" required>
                    </div>
                  </div>
            
                  <div class="form-group">
                    <label for="lid">User Name:</label>
                    <input class="form-control" type="hidden" id="username" name="username" value="<?php echo ucwords($row['username']); ?>">
                    <input class="form-control" type="text" value="<?php echo ucwords($row['username']); ?>"  disabled="disabled" required>
                  </div>
            
            
                  <div class="form-group">
                    <label for="region">Service Center:</label>
                    <div class="input-group mb-3">
                      <select class="form-control" type="text" id="region" name="region" placeholder="Region" onchange="getCenter(this.value);"  disabled="disabled" required>
                        <option value="<?php echo $row['region']; ?>"><?php echo $row['region']; ?></option>
                      </select> 
                      <select class="form-control" type="text" id="location" name="location" placeholder="Location"  disabled="disabled" required>
                        <option value="<?php echo $row['location']; ?>"><?php echo $row['location']; ?></option>
                      </select>
                    </div>
                  </div>
                
                  
                <div class="form-group">
                  <label for="email">Email address:</label>
                  <input type="email" class="form-control" value="<?php echo $row['email']; ?>" name="email" id="email" disabled="disabled" required>
                </div>
            
                <button type="submit" class="btn btn-primary">Delete User</button>
              </form>
            </div>
    	    </div>
    	    
    <?php  	} //end of row count
        
    } //query run check  
    else{
        echo '<div class="alert alert-danger" role="alert">';
        echo 'Failed to get user ['.$user_id.'] details.';
        echo '</div>';
    }
}


if(isset($_POST['userid']))
{
    echo '<style>#dd{display:none;}</style>';
    $user_id = $_POST['userid'];
    $query = "delete from mst_user where user_id='$user_id'";
    //echo $query;
    
    if ($rs=mysqli_query($con,$query)){
        echo '<div class="alert alert-success" role="alert">
              User [<span style="font-size:100%;" class="badge badge-warning">'.$_POST['username'].'</span>] deleted successfully.
            </div>';
        echo '<a class="btn btn-primary" href="showuser.php" role="button">Back to User list</a>';
	}
    else
    {
        echo '<div class="alert alert-danger" role="alert">';
        echo 'Fail to delete user ['.$user_id.'].';
        echo '</div>';
        echo '<div class="alert alert-danger" role="alert">';
        echo mysqli_error($con);
        echo '</div>';
    }
}
?>


<p>&nbsp; </p>
</div></div></div></div></div>
<?php mysqli_close($con); ?>
</body>
</html>