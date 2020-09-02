<?php include('template_head.php'); ?>


      <div class="row">
        <div class="col-lg-8">
<?php
include("header.php");
include("../database.php");
extract($_REQUEST);
 $id=$_GET['test_id'];
$q=mysqli_query($con,"select * from mst_test where test_id='$id'");
$res=mysqli_fetch_assoc($q);

$region_flag = 0;
if(isset($update))
{

    $comma = 0;
    $t = '(';
    if(isset($_POST['Ahmedabad'])){
        if($comma == 1){
            $t .= ", ";
        }
        $comma = 1;
        $t .= "'".$_POST['Ahmedabad']."'";
        $region_flag = 1;
    }
    if(isset($_POST['Center'])){
        if($comma == 1){
            $t .= ", ";
        }
        $comma = 1;
        $t .= "'".$_POST['Center']."'";
        $region_flag = 1;
    }
    if(isset($_POST['North'])){
        if($comma == 1){
            $t .= ", ";
        }
        $comma = 1;
        $t .= "'".$_POST['North']."'";
        $region_flag = 1;
    }
    if(isset($_POST['Center'])){
        if($comma == 1){
            $t .= ", ";
        }
        $comma = 1;
        $t .= "'".$_POST['Center']."'";
        $region_flag = 1;
    }
    if(isset($_POST['Saurastra1'])){
        if($comma == 1){
            $t .= ", ";
        }
        $comma = 1;
        $t .= "'".$_POST['Saurastra1']."'";
        $region_flag = 1;
    }
    if(isset($_POST['Saurastra2'])){
        if($comma == 1){
            $t .= ", ";
        }
        $comma = 1;
        $t .= "'".$_POST['Saurastra2']."'";
        $region_flag = 1;
    }
    if(isset($_POST['South'])){
        if($comma == 1){
            $t .= ", ";
        }
        $comma = 1;
        $t .= "'".$_POST['South']."'";
        $region_flag = 1;
    }
    if(isset($_POST['Surat'])){
        if($comma == 1){
            $t .= ", ";
        }
        $comma = 1;
        $t .= "'".$_POST['Surat']."'";
        $region_flag = 1;
    }
    $t .= ")";
    
    //echo $t.'<br>';

    $query="update mst_test SET test_name='$testname',total_que='$totque',type='$type', exam_release='$exam_release' where test_id='$id';";
    if($region_flag == 1){
        $query .= "update mst_user set exam_assign=".$id." where mst_user.region in ".$t.";";    
    }
    
    
    //echo $query;
   
    //$query="update mst_test SET test_name='$testname',total_que='$totque',type='$type', exam_release='$exam_release' where test_id='$id'";	
    if (mysqli_multi_query($con, $query)) {
        echo '<div class="alert alert-success" role="alert">
          Record updated successfully.
        </div>';
    }
    else
    {
        echo mysqli_error($con);
    }
    	

    
}



?>
<form name="form1" method="post" onSubmit="return check();">
<div class="p-3 mb-2 bg-secondary text-white text-center">Update TEST</div>

  <table class="table table-striped">

 <tr>
        <td height="26"><div align="left"><strong> Enter Test Name </strong></div></td>
        <td>&nbsp;</td>
	  <td><input class="form-control" value="<?php echo $res['test_name']; ?>" name="testname" type="text" id="testname"></td>
    </tr>
    <tr>
      <td height="26"><div align="left"><strong>Enter Total Question </strong></div></td>
      <td>&nbsp;</td>
      <td><input class="form-control" value="<?php echo $res['total_que']; ?>" name="totque" type="text" id="totque"></td>
    </tr>
    <tr>
      <td height="26"><div align="left"><strong>Test Type</strong></div></td>
      <td>&nbsp;</td>
      <td>
          <select class="form-control" name="type" id="type">
              <option value="0" <?php if($res['type'] == 0) echo 'selected'; ?>>Practice Paper</option>
              <option value="1" <?php if($res['type'] == 1) echo 'selected'; ?>>Exam Paper</option>
          </select>
          <!--<input class="form-control" value="<?php echo $res['type']; ?>" name="type" type="text" id="type"></td>-->
    </tr>
    <tr>
      <td height="26"><div align="left"><strong>Exam Release </strong></div></td>
      <td>&nbsp;</td>
      <td>
          <select class="form-control" name="exam_release" id="exam_release">
              <option value="0" <?php if($res['exam_release'] == 0) echo 'selected'; ?>>No</option>
              <option value="1" <?php if($res['exam_release'] == 1) echo 'selected'; ?>>Yes</option>
          </select>
    </tr>
    <tr>
      <td height="26"><div align="left"><strong>Assign Exam to </strong></div></td>
      <td>&nbsp;</td>
      <td>
          
            <input type="checkbox" class="form-check-input" id="Ahmedabad" name="Ahmedabad" value="Ahmedabad">
            <label for="Ahmedabad">Ahmedabad</label><br>
            <input type="checkbox" class="form-check-input" id="Center" name="Center" value="Center">
            <label for="Center">Center</label><br>
            <input type="checkbox" class="form-check-input" id="North" name="North" value="North">
            <label for="North">North</label><br>
            <input type="checkbox" class="form-check-input" id="Saurastra1" name="Saurastra1" value="Saurastra1">
            <label for="Saurastra1">Saurastra1</label><br>
            <input type="checkbox" class="form-check-input" id="Saurastra2" name="Saurastra2" value="Saurastra2">
            <label for="Saurastra2">Saurastra2</label><br>
            <input type="checkbox" class="form-check-input" id="South" name="South" value="South">
            <label for="South">South</label><br>
            <input type="checkbox" class="form-check-input" id="Surat" name="Surat" value="Surat">
            <label for="Surat">Surat City</label><br>

    </tr>
    
    <tr>
      <td height="26"></td>
      <td>&nbsp;</td>
      <td><input class="btn btn-primary" type="submit" name="update" value="update" ></td>
    </tr>
  </table>
</form>
<p>&nbsp; </p>
</div></div></div></div></div>
<?php mysqli_close($con); ?>
</body>
</html>