<?php include('template_head.php'); ?>
 
      
<?php
//include("header.php");
?>


<div class="row d-flex justify-content-center">
  <div class="col-lg-4"  style="border: 1px solid #ddd;border-radius: 5px;padding: 20px;background: #fff;box-shadow: 1px 1px 8px 0px #888888;margin-top: 50px;">
<h5 class="text-center card-subtitle mb-2 text-muted">Adminstrative Login</h5>
<form name="form1" method="post" action="login.php">
  <div class="form-group">
    <label for="loginid">Login ID:</label>
    <input type="text" class="form-control" id="loginid" name="loginid" required>
  </div>
  <div class="form-group">
    <label for="pwd">Password:</label>
    <input type="password" class="form-control" name="pass" id="pass" required>
  </div>
  
  <input type="submit" id="submit" class="btn btn-default" style="color: #fff!important;background-color: #2196F3!important;" value="Submit" />



</form>
</div></div>

</div></div></div>

<style>
    body{
		        display:block;
		        background:#ddd;
		    }
</style>

</body>
</html>
