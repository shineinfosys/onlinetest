<?php include('template_head.php'); ?>
   
      <div class="row">
        <div class="col-lg-8">
<?php

require("../database.php");
include("header.php");
error_reporting(1);
?>

<?php
extract($_POST);

echo "<BR>";
if (!isset($_SESSION[alogin]))
{
	echo "<br><h2><div  class=head1>You are not Logged On Please Login to Access this Page</div></h2>";
	echo "<a href=index.php><h3 align=center>Click Here for Login</h3></a>";
	exit();
}
echo "<h2 class='text-center bg-primary'>ADD Question</h2>";
if($_POST[submit]=='Save' || strlen($_POST['testid'])>0 )
{
extract($_POST);

$addque =  mysqli_real_escape_string($con, $_POST['addque']);
$ans1 =  mysqli_real_escape_string($con, $_POST['ans1']);
$ans2 =  mysqli_real_escape_string($con, $_POST['ans2']);
$ans3 =  mysqli_real_escape_string($con, $_POST['ans3']);
$ans4 =  mysqli_real_escape_string($con, $_POST['ans4']);
$anstrue =  mysqli_real_escape_string($con, $_POST['anstrue']);
$testid =  mysqli_real_escape_string($con, $_POST['testid']);


mysqli_query($con,"insert into mst_question(test_id,que_desc,ans1,ans2,ans3,ans4,true_ans) values ('$testid','$addque','$ans1','$ans2','$ans3','$ans4','$anstrue')",$cn) or die(mysqli_error());
echo '<div class="alert alert-success"><strong>Success!</strong> Question Added Successfully.</div>';

unset($_POST);
}
?>
<SCRIPT LANGUAGE="JavaScript">
function check() {
mt=document.form1.addque.value;
if (mt.length<1) {
alert("Please Enter Question");
document.form1.addque.focus();
return false;
}
a1=document.form1.ans1.value;
if(a1.length<1) {
alert("Please Enter Answer1");
document.form1.ans1.focus();
return false;
}
a2=document.form1.ans2.value;
if(a1.length<1) {
alert("Please Enter Answer2");
document.form1.ans2.focus();
return false;
}
a3=document.form1.ans3.value;
if(a3.length<1) {
alert("Please Enter Answer3");
document.form1.ans3.focus();
return false;
}
a4=document.form1.ans4.value;
if(a4.length<1) {
alert("Please Enter Answer4");
document.form1.ans4.focus();
return false;
}
at=document.form1.anstrue.value;
if(at.length<1) {
alert("Please Enter True Answer");
document.form1.anstrue.focus();
return false;
}
return true;
}
</script>

<div style="margin:auto;width:90%;height:500px;box-shadow:2px 1px 2px 2px #CCCCCC;text-align:left">
<form name="form1" method="post" onSubmit="return check();">
  <div class="table-responsive">         
    <table class="table table-hover table-bordered">
    <tr>
      <td width="24%" height="32"><div align="left"><strong>Select Test Name </strong></div></td>
      
      <td width="75%" height="32">
        <select class="form-control" name="testid" id="testid">
<?php

$test_paper = intval($_GET['test_paper']);


$rs=mysqli_query($con,"Select * from mst_test order by test_name");
	  while($row=mysqli_fetch_array($rs))
{
if($test_paper==$row[0])
{

  echo "<option value='$row[0]' selected>$row[2]</option>";
  echo "<script> $('#testid').attr('readonly','readonly');</script>";
}
else
{
  echo "<option value='$row[0]'>$row[2]</option>";
}
}
?>
      </select>
        
    <tr>
        <td height="26"><div align="left"><strong> Enter Question </strong></div></td>
        
	    <td><textarea class="form-control" name="addque" cols="60" rows="2" id="addque"></textarea></td>
    </tr>
    <tr>
      <td height="26"><div align="left"><strong>Enter Answer1 </strong></div></td>
      
      <td><input class="form-control" name="ans1" type="text" id="ans1" size="85" maxlength="85"></td>
    </tr>
    <tr>
      <td height="26"><strong>Enter Answer2 </strong></td>
      
      <td><input class="form-control" name="ans2" type="text" id="ans2" size="85" maxlength="85"></td>
    </tr>
    <tr>
      <td height="26"><strong>Enter Answer3 </strong></td>
      
      <td><input class="form-control" name="ans3" type="text" id="ans3" size="85" maxlength="85"></td>
    </tr>
    <tr>
      <td height="26"><strong>Enter Answer4</strong></td>
      
      <td><input class="form-control" name="ans4" type="text" id="ans4" size="85" maxlength="85"></td>
    </tr>
    <tr>
      <td height="26"><strong>Enter True Answer </strong></td>
      
      <td><select class="form-control" name="anstrue" type="text" id="anstrue">
            <option value="1">Option 1</option>
            <option value="2">Option 2</option>
            <option value="3">Option 3</option>
            <option value="4">Option 4</option>
          </select></td>
    </tr>
    <tr>
      <td height="26"></td>
      
      <td><input class="form-control btn btn-primary" type="submit" name="submit" value="Add" ></td>
    </tr>
  </table>
</div>
</form>
<p>&nbsp; </p>
</div>

</div></div></div></div></div>
</body>
</html>