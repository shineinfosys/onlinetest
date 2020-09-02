<?php include('template_head.php'); ?>
 <?php include("header.php");
	  include("../database.php");   ?>
	  
	  
      <div class="row">
        <div class="col-lg-12">




        	<ul class="nav nav-tabs">
			    <li class="nav-item">
			    	<a class="nav-link active" data-toggle="tab" href="#user">User</a>
			    </li>
			    <li class="nav-item">
			    	<a class="nav-link" data-toggle="tab" href="#admin">Admin</a>
			    </li>
			  </ul>

			  <div class="tab-content" style="border: 1px solid #ddd;border-collapse: collapse;border-top: 0;">
			      
			    <div id="user" class="container tab-pane active" style="">
			      <br>
			      
			      <div class="input-group col-lg-12">
                        <div class="input-group mb-3">
                          <div class="input-group-prepend">
                            <span class="form-control input-group-text" id="basic-addon3">Name : </span>
                          </div>
                          <input class="form-control" type="text" id="myInput" onkeyup="myFunction()" placeholder="Search by names..." title="Search by Name..." aria-describedby="basic-addon3">
                        </div>
                    
                  </div>
			 
<style>
    #myInput {
  background-image: url('/css/searchicon.png');
  background-position: 10px 10px;
  background-repeat: no-repeat;
  width: 100%;
  font-size: 16px;
  padding: 12px 20px 12px 20px;
  border: 1px solid #ddd;
  margin-bottom: 12px;
}
</style>
			      <br>
			      	<?php
			      	    if($_SESSION['user_type'] == 1){
			      	        $query = "select * from mst_user order by region, location, username asc";
			      	    }
			      	    else{
			      	        $query = "select * from mst_user where region = '".$_SESSION['region']."' order by region, location, username asc ";    
			      	    }
			      	    //echo $query;
			      		$sql=mysqli_query($con,$query);	
						//echo '<div class="table-responsive">';          
				  		echo '<table id="myTable" class="table table-hover table-sm table-hover table-bordered responsive-table">';
						echo '<thead>';
						echo "<tr  class='table-active'>
						<th>#</th>
						<th>Region</th>
						<th>Location</th>
						<th>Name</th>
						<th>UserID</th>
						<th>Password</th>
						<th>Action</th></tr>";
                        echo '</thead>';						
					    $i = 1;
						while($result=mysqli_fetch_assoc($sql))
						{
						$id=$result['username'];
						
						echo "<tbody><tr>";
						echo "<td>".$i."</td>"; $i++;
						echo "<td>".$result['region']. "</td>";
						echo "<td>".$result['location']. "</td>";
						//echo "<td>".$result['login']. "</td>";
						echo "<td>".ucwords($result['username'])."</td>";
						echo "<td><span style='font-size:100%' class='badge badge-warning'>".$result['login']."</span></td>";
						echo "<td><span style='font-size:100%' class='badge badge-warning'>".$result['pass']."</span></td>";
						
						echo "<td>";
						echo "<a href='usermodify.php?action=0&region=".$result['region']."&location=".$result['location']."&user_id=".$result['user_id']."&login=".$result['login']."' title='Modify User'><i class='fa fa-fw fa-pencil-square-o'></i>Modify</a>";
						echo '<span class="badge">&nbsp;&nbsp;</span>';
						echo "<a href='userdelete.php?action=1&region=".$result['region']."&location=".$result['location']."&user_id=".$result['user_id']."&login=".$result['login']."' title='Delete User'><i class='fa fa-fw fa-trash-o'></i>Delete</a>";
						echo "</td>";
						echo "</tr></tbody>";
						echo"</div>";
						}
						echo "</table>"; //echo "</div>";
					?>
			    </div>
			    <div id="admin" class="container tab-pane fade">
			      <br>
			      <?php
			      		$sql=mysqli_query($con,"SELECT * FROM `mst_admin`");	
						echo '<div class="table-responsive">';          
				  		echo '<table class="table table-hover table-sm table-hover table-bordered">';
						
						echo "<thead><tr class='table-active'>
						<th>ID</th>
						<th>Region</th>
						<th>Login ID</th>
						<th>Password</th>
						<th>Action</th></tr></thead><tbody>";
					
						while($result=mysqli_fetch_assoc($sql))
						{
						$id=$result['username'];
						
						echo "<tr>";	
						echo "<td>".$result['id']. "</td>";
						echo "<td>".$result['region']. "</td>";
						echo "<td><span style='font-size:100%' class='badge badge-warning'>".$result['loginid']."</span></td>";
						echo "<td><span style='font-size:100%' class='badge badge-warning'>".$result['pass']. "</span></td>";
						echo "<td><button type='button' class='btn btn-default' disabled>Modify</button></td>";
						echo "</tr>";
						}
						echo "</tbody</table></div>";
					?>
			    </div>
			  </div>


       

</div></div>
</div></div></div>
<script>
function myFunction() {
  var input, filter, table, tr, td, i, txtValue;
  input = document.getElementById("myInput");
  filter = input.value.toUpperCase();
  table = document.getElementById("myTable");
  tr = table.getElementsByTagName("tr");
  for (i = 0; i < tr.length; i++) {
    td = tr[i].getElementsByTagName("td")[3];
    if (td) {
      txtValue = td.textContent || td.innerText;
      if (txtValue.toUpperCase().indexOf(filter) > -1) {
        tr[i].style.display = "";
      } else {
        tr[i].style.display = "none";
      }
    }       
  }
}
</script>

</body>
</html>