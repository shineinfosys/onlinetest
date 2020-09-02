<?php include('template_head.php'); ?>
   
      <div class="row">
        <div class="col-lg-12">

<?php
include("header.php");
include("../database.php");
?>


<?php
if(isset($_GET['test_paper'])){
    if(isset($_SESSION['region'])){
        $q = "SELECT mst_user.region, mst_user.location, mst_user.username, mst_test.test_name, mst_test.total_que, r.score, r.test_date, r.unique_exam_key, r.test_id
                FROM (select * from mst_result order by test_date asc)r 
                left join mst_user on mst_user.user_id = r.user_id
                left join mst_test on mst_test.test_id = r.test_id
                
                where r.test_id = ".$_GET['test_paper']." AND
                mst_user.region = '".$_SESSION['region']."'
                group by mst_user.login
                order by mst_user.region, mst_user.location, mst_user.username, r.test_date asc";

    }else{
        $q = "SELECT mst_user.region, mst_user.location, mst_user.username, mst_test.test_name, mst_test.total_que, r.score, r.test_date, r.unique_exam_key, r.test_id
                FROM (select * from mst_result order by test_date asc)r 
                left join mst_user on mst_user.user_id = r.user_id
                left join mst_test on mst_test.test_id = r.test_id
                
                where r.test_id = ".$_GET['test_paper']."
                group by mst_user.login
                order by mst_user.region, mst_user.location, mst_user.username, r.test_date asc";
    }
      
   // echo $q;
    $sql=mysqli_query($con,$q); 
}
else
{
    if(isset($_SESSION['region'])){
        $q = "SELECT mst_user.region, mst_user.location, mst_user.username, mst_test.test_name, mst_test.total_que, r.score, r.test_date, r.unique_exam_key, r.test_id
                FROM (select * from mst_result order by test_date asc)r 
                left join mst_user on mst_user.user_id = r.user_id
                left join mst_test on mst_test.test_id = r.test_id
                
                where mst_user.region = '".$_SESSION['region']."'
                
                order by mst_user.region, mst_user.location, mst_user.username, r.test_date asc";

    }else{
        $q = "SELECT mst_user.region, mst_user.location, mst_user.username, mst_test.test_name, mst_test.total_que, r.score, r.test_date, r.unique_exam_key, r.test_id
                FROM (select * from mst_result order by test_date asc)r 
                left join mst_user on mst_user.user_id = r.user_id
                left join mst_test on mst_test.test_id = r.test_id
                order by mst_user.region, mst_user.location, mst_user.username, r.test_date asc";  
    }
      
    //echo $q;
    $sql=mysqli_query($con,$q); 
}


  $query = "SELECT mst_subject.sub_id, mst_subject.sub_name, mst_test.test_id, mst_test.test_name FROM `mst_test`left join mst_subject on mst_test.sub_id = mst_subject.sub_id"; 
  
  
  $test_paper = mysqli_query($con, $query) or die('failed to get test list');

  //echo '<br>'.$query.'<br>';
  
	echo '<div class="table-responsive">';          
  	echo '<table class="table">';
	//echo "<tr><th><a  class='btn btn-danger'href=\"questionadd.php\">Add Question </a>&emsp;&emsp;</th>";
  echo "<th colspan='4'>";
  ?>
  <form method="get">
  <div class="input-group mb-3">
    <div class="input-group-prepend">
    <span class="input-group-text" id="inputGroup-sizing-default">Select Test Paper</span>
  </div>
  
  <select class="form-control" aria-label="Default" aria-describedby="inputGroup-sizing-default" name="test_paper" id="test_paper" style="    height: 52px;border: 1px solid #ddd;" onchange='this.form.submit()'>
    <option value="">--Select Test Paper--</option>
    <?php
    $test_id = intval($_GET['test_paper']);
    
    $subject = '';
    
    while ($result=mysqli_fetch_assoc($test_paper)) {
        if ($subject != $result['sub_name']) {
            
            
                echo '</optgroup>';
            
                echo '<optgroup label="'.ucwords($result['sub_name']).'">';
                $subject = $result['sub_name'];
            
        }
        if($test_id==$result['test_id']){
    	    echo '<option selected value="'.$result['test_id'].'"><span class="glyphicon glyphicon-menu-down"></span>'.$result['test_name'].'</option>';
        }
        else{
    	    echo '<option value="'.$result['test_id'].'"><span class="glyphicon glyphicon-menu-down"></span>'.$result['test_name'].'</option>';
        }
        
    }

     ?>
  </select>
  </div>
</form>
  <?php
  echo "</th>";
  echo "</tr>";
  echo "</table>";

  echo '<table width="100%" id="test_paper_result" class="table-striped table-bordered" style="text-align: center;">';
	echo "<thead><tr style='background: #616161;color: white;'><th width=5%>#</th><th>Location</th><th>User Name</th><th>Test Paper</th><th>Score %</th><th>Attempt Date</th></thead>";
	$i = 1;
	while($result=mysqli_fetch_assoc($sql))
	{
    

    echo '<tr>';
    if($i<10){
        echo "<td>0".$i. "</td>";    
    }
    else{
        echo "<td>".$i. "</td>";
    }
		
//	echo "<td>".$result['region']. "</td>";
    echo "<td>".$result['location']. "</td>";
  
    echo "<td><a class='text-secondary' href=review.php?unique_exam_key='".$result['unique_exam_key']."'&test_id=".$result['test_id'].">".$result['username']."</a> </td>";
    //echo "<td>".$result['username']. "</td>";
    echo "<td>".$result['test_name']. "</td>";
    //echo "<td>".$result['total_que']. "</td>";
    //echo "<td>".$result['score']. "</td>";
  
    $scoreper = number_format($result['score']/$result['total_que']*100,2);
    if($scoreper < 90){
      echo '<td><span class="text-danger">';
    }
    else{
      echo "<td><span class='text-success'>";    
    }
  
    echo $scoreper."%</span></td>";
    echo "<td>".date_format(date_create($result['test_date']),"dM'y h:ia"). "</td>";
	echo "</tr>";
	$i++;
	}
	echo "</table>";

?>

<br><br><br><br>
</div></div></div></div></div>



<script src="https://cdn.datatables.net/1.10.20/js/jquery.dataTables.min.js"></script> 
<script src="https://code.jquery.com/jquery-3.3.1.js"></script>
<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.20/css/jquery.dataTables.min.css">
<script>
$(document).ready(function() {
    $('#test_paper_result').DataTable({
        "paging":   true,
        "ordering": false,
        "info":     true
    });
} );
</script>

</body>
</html>
