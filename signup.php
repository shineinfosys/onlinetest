<?php include('template_head.php'); ?>


<div class="container">
  <div class="panel panel-default">
    <div class="panel-body">
<?php //include("header.php"); ?>

  <div class="row">
    <div class="col-lg-6">
    <form name="form1" method="post" action="signupuser.php" onSubmit="return check();">
      
      <div class="form-group">
        <label for="name">User Name:</label>
        <input class="form-control" type="text" id="name" name="name" placeholder="Full Name" required>
      </div>

      <div class="form-group">
        <label for="lid">User ID:</label>
        <input class="form-control" type="text" id="lid" name="lid" placeholder="User ID" required>
      </div>


      <div class="form-group">
        <label for="region">Service Center:</label>
        <div class="input-group mb-3">
          <select class="form-control" type="text" id="region" name="region" placeholder="Region" onchange="getCenter(this.value);" required>
            <option value="Ahmedabad">Ahmedabad</option>
            <option value="Center">Center</option>
            <option value="North">North</option>
            <option value="Saurastra1">Saurastra1</option>
            <option value="Saurastra2">Saurastra2</option>
            <option value="South">South</option>
            <option value="Surat">Surat City</option>
          </select> 
          <select class="form-control" type="text" id="location" name="location" placeholder="Location" required>
            <option value="">---</option>
          </select>
        </div>
      </div>
    
      
    <div class="form-group">
      <label for="email">Email address:</label>
      <input type="email" class="form-control" placeholder="Enter email" name="email" id="email" required>
    </div>

    
    
    <div class="form-group">
      <label for="pwd">Password:</label>
      <div class="input-group mb-3">
      <input type="password" class="form-control" placeholder="Enter password" id="pass" name="pass" required>
      <input type="password" class="form-control" placeholder="Re-enter password" id="cpass" name="cpass" required>
    </div>
    </div>

    <button type="submit" class="btn btn-primary">Signup</button>
  </form>
</div></div>


</div></div></div>


<!-- location selector code start here  -->
<script type="text/javascript">
function getCenter(val) {
  $.ajax({
  type: "POST",
  url: "get_location.php",
  data:'region='+val,
  success: function(data){
    $("#location").html(data);
  }
  });
}
</script>  

<script type="text/javascript">
            var e = document.getElementById("region");
            var value = e.options[e.selectedIndex].value;
           getCenter(value);
</script>
    
    
 <script language="javascript">
function check()
{

 if(document.form1.lid.value=="")
  {
    alert("Plese Enter Login Id");
  document.form1.lid.focus();
  return false;
  }
 
 if(document.form1.pass.value=="")
  {
    alert("Plese Enter Your Password");
  document.form1.pass.focus();
  return false;
  } 
  if(document.form1.cpass.value=="")
  {
    alert("Plese Enter Confirm Password");
  document.form1.cpass.focus();
  return false;
  }
  if(document.form1.pass.value!=document.form1.cpass.value)
  {
    alert("Confirm Password does not matched");
  document.form1.cpass.focus();
  return false;
  }
  if(document.form1.name.value=="")
  {
    alert("Plese Enter Your Name");
  document.form1.name.focus();
  return false;
  }
  if(document.form1.address.value=="")
  {
    alert("Plese Enter Address");
  document.form1.address.focus();
  return false;
  }
  if(document.form1.city.value=="")
  {
    alert("Plese Enter City Name");
  document.form1.city.focus();
  return false;
  }
  if(document.form1.phone.value=="")
  {
    alert("Plese Enter Contact No");
  document.form1.phone.focus();
  return false;
  }
  if(document.form1.email.value=="")
  {
    alert("Plese Enter your Email Address");
  document.form1.email.focus();
  return false;
  }
  e=document.form1.email.value;
    f1=e.indexOf('@');
    f2=e.indexOf('@',f1+1);
    e1=e.indexOf('.');
    e2=e.indexOf('.',e1+1);
    n=e.length;

    if(!(f1>0 && f2==-1 && e1>0 && e2==-1 && f1!=e1+1 && e1!=f1+1 && f1!=n-1 && e1!=n-1))
    {
      alert("Please Enter valid Email");
      document.form1.email.focus();
      return false;
    }
  return true;
  }
  
</script>
</body>
</html>
<?php // closing connection 
mysqli_close($con); ?>