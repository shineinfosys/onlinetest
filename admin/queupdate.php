<?php include('template_head.php'); ?>
   
      <div class="row">
        <div class="col-lg-8">
          <h2>Modify Question</h2>
<?php
include("header.php");
include("../database.php");
extract($_REQUEST);
 $id=$_GET['que_id'];
$q=mysqli_query($con,"select * from mst_question where que_id='$id'");
$res=mysqli_fetch_assoc($q);


if(isset($update))
{

$addque =  mysqli_real_escape_string($con, $_POST['addque']);
$ans1 =  mysqli_real_escape_string($con, $_POST['ans1']);
$ans2 =  mysqli_real_escape_string($con, $_POST['ans2']);
$ans3 =  mysqli_real_escape_string($con, $_POST['ans3']);
$ans4 =  mysqli_real_escape_string($con, $_POST['ans4']);
$anstrue =  mysqli_real_escape_string($con, $_POST['anstrue']);
$id =  mysqli_real_escape_string($con, $_GET['que_id']);


    $query="update mst_question SET que_desc='$addque',ans1='$ans1',ans2='$ans2',ans3='$ans3',ans4='$ans4',true_ans='$anstrue' where que_id='$id'";	
    //echo $query;
   
    if ($result = mysqli_query($con,$query))
    {
        //echo "records updated";	
        echo '<div class="alert alert-success" role="alert">
              Question updated succesfully!
            </div>';
    }
    else{
        echo "failed to updated";	
        echo '<div class="alert alert-danger" role="alert">
              Question updated failed!
            </div>';
    }
}



?>
<form name="form1" method="post" onSubmit="return check();">
  <div class="table-responsive">         
    <table class="table table-hover table-bordered">

 <tr>
        <td height="26"><div align="left"><strong> Enter Question </strong></div></td>
        
	    <td><textarea class="form-control"name="addque" cols="60" rows="2" id="addque"><?php echo $res['que_desc']; ?></textarea></td>
    </tr>
    <tr>
      <td height="26"><div align="left"><strong>Enter Answer1 </strong></div></td>
      
      <td><input class="form-control"value="<?php echo $res['ans1']; ?>" name="ans1" type="text" id="ans1" size="85" maxlength="85"></td>
    </tr>
    <tr>
      <td height="26"><strong>Enter Answer2 </strong></td>
      
      <td><input class="form-control" value="<?php echo $res['ans2']; ?>" name="ans2" type="text" id="ans2" size="85" maxlength="85"></td>
    </tr>
    <tr>
      <td height="26"><strong>Enter Answer3 </strong></td>
      
      <td><input class="form-control" value="<?php echo $res['ans3']; ?>" name="ans3" type="text" id="ans3" size="85" maxlength="85"></td>
    </tr>
    <tr>
      <td height="26"><strong>Enter Answer4</strong></td>
      
      <td><input class="form-control" name="ans4"value="<?php echo $res['ans4']; ?>" type="text" id="ans4" size="85" maxlength="85"></td>
    </tr>
    <tr>
      <td height="26"><strong>Enter True Answer </strong></td>
      
      <td><select class="form-control" name="anstrue" type="text" id="anstrue">
            <option value="1" <?php if($res['true_ans'] == 1) echo 'selected'; ?>>Option 1</option>
            <option value="2" <?php if($res['true_ans'] == 2) echo 'selected'; ?>>Option 2</option>
            <option value="3" <?php if($res['true_ans'] == 3) echo 'selected'; ?>>Option 3</option>
            <option value="4" <?php if($res['true_ans'] == 4) echo 'selected'; ?>>Option 4</option>
          </select></td>
    </tr>
    <tr>
      <td height="26"></td>
      
      <td><input class="btn btn-primary" type="submit" name="update" value="UPDATE" ></td>
    </tr>
	</table>
</div>
</form>
<p>&nbsp; </p>

</div></div></div></div></div>
</body>
</html>