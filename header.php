<?php 

error_reporting(1);

    if (isset($_SESSION[username]))
    {   
        
        //user is login
    }
    else{
    ?>
        <script>
            $(document).ready(function(){
                $("#login-form-btn").click(function(){
                    $("#online-exam-img").toggle();
                    $("#multiCollapseExample1").toggle();
                    $('#loginid2').focus();
                });
            });
        </script>
           
                    <div class="row">
                        <div class="col-lg-12">
                        <div class="row">
                            <div class="col-lg-4">
                                Your are not loged in, please <a id="login-form-btn" style="margin-top: 10px;margin-bottom: 10px;" class="btn btn-primary" href="#" role="button"> Login! </a>
                            </div>
                        </div>
                        <div class="row" id="multiCollapseExample1" style="display:none;">
                            <div class="col-lg-12">
                              <div class="card card-body">
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
                    </div>
             <?php exit();
        }
  
?>