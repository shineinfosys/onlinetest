<?php include('template_head.php'); ?>
   
      <div class="row">
        <div class="col-lg-8">

<?php
include("header.php");
include("../database.php");
?>


<?php
if(isset($_GET['test_paper'])){
  $q = "select * from mst_question where test_id = ".$_GET['test_paper'];
  $sql=mysqli_query($con,$q); 
}
else
{
  $sql=mysqli_query($con,"select * from mst_question");   
}


  $query = "SELECT mst_subject.sub_id, mst_subject.sub_name, mst_test.test_id, mst_test.test_name FROM `mst_test`left join mst_subject on mst_test.sub_id = mst_subject.sub_id"; 
  $test_paper = mysqli_query($con, $query) or die('failed to get test list');

  
	echo '<div class="table-responsive">';          
  	echo '<table id="test_paper" class="table table-hover table-bordered">';
	//echo "<tr><th><a  class='btn btn-danger'href=\"questionadd.php\">Add Question </a>&emsp;&emsp;</th>";
  echo "<th colspan='4'>";
  ?>
  <form method="get">
  <div class="input-group mb-3">
    <div class="input-group-prepend">
    <span class="input-group-text" id="inputGroup-sizing-default"><a  class='btn btn-danger' href="questionadd.php?test_paper=<?php echo $_GET['test_paper']; ?>">Add Question </a></span>
  </div>
  
  <select class="form-control" aria-label="Default" aria-describedby="inputGroup-sizing-default" name="test_paper" id="test_paper" style="    height: 52px;border: 1px solid #ddd;" onchange='this.form.submit()'>
    <option value="">--Select Test Paper--</option>
    <?php
    $test_id = intval($_GET['test_paper']);
    $temp = NULL;
      while($result=mysqli_fetch_assoc($test_paper)){
          
          
          if($temp!= $result['sub_id']){ echo '<optgroup label="'.ucwords($result['sub_name']).'">'; }
        
          if($test_id==$result['test_id']){
            echo "<option selected value=".$result['test_id'].">".$result['test_name']."</option>";  
          }else
          {
            echo "<option value=".$result['test_id'].">".$result['test_name']."</option>";
          }
          
          if($temp!= $result['']){ echo '</optgroup>'; }

          $temp = $result['sub_id'];
        
      }
     ?>
  </select>
  </div>
</form>
  <?php
  echo "</th>";
  echo "</tr>";
  
    if(isset($_GET['test_paper'])){
        $test_paper = $_GET['test_paper'];
    	echo "<tr><th class='text-primary'>ID</th><th class='text-primary'>Question</th>
    	<th class='text-primary'>Update</th>
    	<th class='text-primary'>Delete</th></tR>";
    	
    	while($result=mysqli_fetch_assoc($sql))
    	{
            $id=$result['que_id'];
        	echo "<tr>";	
        	echo "<td>".$result['que_id']. "</td>";
        	echo "<td>".$result['que_desc']."</td>";
        	echo "<td><a href='queupdate.php?que_id=$id'><i class='fa fa-pencil-square-o'></i>Edit</a></td>";
        	echo "<td><a href='quedelete.php?test_id=$test_paper&que_id=$id'><i class='fa fa-trash-o'></i>Delete</a></td>";
        	echo "</tr>";
    	}
    }
	echo "</table>";

?>
</div></div></div></div></div>
</body>
</html>
