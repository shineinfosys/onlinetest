<?php include('template_head.php'); ?>
<?php
include("header.php");
include("database.php");

?>

<div class="container">
	<div class="panel panel-default col-lg-8" style="border: 1px solid #ddd;padding: 20px;border-radius: 10px;box-shadow: 2px 2px 5px 2px #ddd;">
	  <div class="panel-body">
	  		
<?php 

if(isset($_SESSION['user_id']) && isset($_SESSION['login']) && !isset($_POST['user_id']))
{
    $region = $_SESSION['region'];
    $location = $_SESSION['location'];
    $user_id = $_SESSION['user_id'];
    $login = $_SESSION['login'];
    
    $query = "SELECT * FROM `mst_user` where `user_id` = ".$user_id;
    if($sql=mysqli_query($con,$query))
    {
        $rowcount=mysqli_num_rows($sql);
        if($rowcount == 1)
    	{
    	    
    	    $row = mysqli_fetch_assoc($sql);
    	    $service_center = $row['location'];
?>    	    
    	    <div class="row">
            <div class="col-lg-12">
                <div class="alert alert-primary" role="alert">
                    Modify your Details carefully!
                </div>
                <form name="form1" action="userprofile.php" method="post">
                  <input type="hidden" name="user_id" id="user_id" value="<?php echo $row['user_id']; ?>">
                  <input type="hidden" id="user_id" name="user_id" value="<?php echo $row['user_id']; ?>">
                  <input type="hidden" id="login" name="login" value="<?php echo $row['login']; ?>">
                  <div class="form-group">
                    <label for="name">Login ID:</label>
                    <div class="input-group">
                        <input class="form-control" type="text" value="<?php echo $row['user_id']; ?>" disabled="disabled" required>
                        <input class="form-control" type="text" value="<?php echo $row['login']; ?>" disabled="disabled" required>
                    </div>
                  </div>
            
                  <div class="form-group">
                    <label for="lid">User Name:</label>
                    <input class="form-control" type="text" id="username" name="username" value="<?php echo $row['username']; ?>" required>
                  </div>
            
            
                  <div class="form-group">
                    <label for="region">Service Center:</label>
                    <div class="input-group mb-3">
                      <select class="form-control" type="text" id="region" name="region" placeholder="Region" onchange="getCenter(this.value);" required>
                        <option value="Ahmedabad" <?php if($row['region'] == 'Ahmedabad') echo selected ?>>Ahmedabad</option>
                        <option value="Center" <?php if($row['region'] == 'Center') echo selected ?>>Center</option>
                        <option value="North" <?php if($row['region'] == 'North') echo selected ?>>North</option>
                        <option value="Saurastra1" <?php if($row['region'] == 'Saurastra1') echo selected ?>>Saurastra1</option>
                        <option value="Saurastra2" <?php if($row['region'] == 'Saurastra2') echo selected ?>>Saurastra2</option>
                        <option value="South" <?php if($row['region'] == 'South') echo selected ?>>South</option>
                        <option value="Surat" <?php if($row['region'] == 'Surat') echo selected ?>>Surat City</option>
                      </select> 
                      <select class="form-control" type="text" id="location" name="location" placeholder="Location" required>
                        <option value="">---</option>
                      </select>
                    </div>
                  </div>
                
                  
                <div class="form-group">
                  <label for="email">Email address:</label>
                  <input type="email" class="form-control" value="<?php echo $row['email']; ?>" name="email" id="email" required>
                </div>
                
                <div class="form-group">
                  <label for="pwd">Password:</label>
                  <div class="input-group mb-3">
                      <input type="text" class="form-control" value="<?php echo $row['pass']; ?>" id="pass" name="pass" required>
                      <div class="input-group-append">
                        <button type="button" class="form-control" onclick="random_pass();" style="border-top-left-radius: 0;border-bottom-left-radius: 0;"><i class="fa fa-refresh"></i></button>
                      </div>
                    </div>
                </div>
                
                  <div class="form-group mb-2">
                    
                    <button type="button" class="btn btn-secondary mb-2" onclick="window.history.back();">Cancel</button> &nbsp;&nbsp;&nbsp;&nbsp;
                    <button type="submit" class="btn btn-primary  mb-2">Save Changes</button>
                  </div>
                  
                
                
              </form>
            </div>
    	    </div>
    	    
    	    
<?php  	}
        
    }
    else{
        echo '<div class="row"><div class="col-lg-8">';
        
        echo '<div class="alert alert-danger" role="alert">';
        echo 'Failed to modify user ['.$user_id.']';
        echo '</div>';
        echo '</div></div>';
    }
}
else if(isset($_POST['user_id']))
{
    $user_id = $_POST['user_id'];
    $username = ucwords($_POST['username']);
    $region = $_POST['region'];
    $location = $_POST['location'];
    $email = $_POST['email'];
    $pass = $_POST['pass'];
    //update query 
    
    $query = "update mst_user set pass = '$pass', username = '$username', region = '$region', location = '$location', email = '$email' where user_id = '$user_id'";
    //echo $query;
    
    if (mysqli_query($con, $query)) {
        echo '<div class="row"><div class="col-lg-8">';
        
        echo '<div class="alert alert-success" role="alert">';
        echo 'Your details saved successfully!';
        echo '</div>';
        
        echo '<br>';
        echo '<a class="btn btn-primary" href="index.php" role="button">Back to User list</a>';
        
        echo '</div></div>';
        
    } 
    else {
        echo "Error updating record: " . mysqli_error($con);
    }


    
    
}

   
    
?>



<!-- location selector code start here  -->


<script type="text/javascript">
function getCenter(val,sel) {
  $.ajax({
  type: "POST",
  url: "./get_location.php",
  data:'region='+val+'&sel='+sel,
  success: function(data){
    $("#location").html(data);
  }
  
  });
}
</script>  

<script type="text/javascript">
            var e = document.getElementById("region");
            var sel = '<?php echo $service_center; ?>';
            var value = e.options[e.selectedIndex].value;
           getCenter(value,sel);
    
    function makeid(length) {
       var result           = '';
       var characters       = 'abcdefghijklmnopqrstuvwxyz0123456789';
       var charactersLength = characters.length;
       for ( var i = 0; i < length; i++ ) {
          result += characters.charAt(Math.floor(Math.random() * charactersLength));
       }
       return result;
    }  
    
    function random_pass()
    {
        var pass = makeid(10);
        $('#pass').val(pass);
    }
           
</script>

<script>
    $( document ).ready(function() {
        $('#location').val('<?php echo $service_center; ?>').change();
    });
    
</script>
	  </div>
	</div>
</div>

</body>
</html>
<?php // closing connection 
mysqli_close($con); ?>