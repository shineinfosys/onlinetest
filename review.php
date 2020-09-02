<?php include('template_head.php'); ?>
<?php
include("header.php");
include("database.php");

?>

<?php

error_reporting(1);
extract($_POST);
extract($_GET);
extract($_SESSION);
/*$rs=mysql_query($con,"select * from mst_question where test_id=$tid",$cn) or die(mysql_error());
if($_SESSION[qn]>mysql_num_rows($rs))
{
unset($_SESSION[qn]);
exit;
}*/
if(isset($test_id))
{
	//$_SESSION[sid]=$subid;
	$_SESSION[tid]=$test_id;
	$rurl = "location:review.php?unique_exam_key=".$_GET['unique_exam_key']."&test_id=".$_GET['test_id'];
	header($url);
}
/*
if(!isset($_SESSION[sid]) || !isset($_SESSION[tid]))
{
	echo '<script>alert("Failed to Initialize review of exam!");</script>';
	header("location: index.php");
}
*/
?>

<div class="container">
	<div class="panel panel-default">
	  <div class="panel-body">
	      <h2 class='text-center'><span class="badge badge-light">Exam Review </span><span class="badge badge-secondary" id="test_name_span"></span></h2>
	  		<div id="question_container" class="container py-3 my-3 border rounded shadow-sm">
			    <div class="row">
			        
<?php

if(isset($_GET['unique_exam_key'])){
    // get all question paper and answer here 
    //$ques_query = "select * from mst_useranswer where test_id = ".$_GET['test_id']." and unique_exam_key = ".$_GET['unique_exam_key']." AND qid != 0 group by qid order by qid, time asc";
    $ques_query = "select mst_useranswer.test_id, mst_test.test_name, mst_useranswer.qid, mst_question.que_desc, mst_question.ans1, mst_question.ans2, mst_question.ans3, mst_question.ans4, mst_question.true_ans, mst_useranswer.your_ans, mst_useranswer.time, mst_useranswer.unique_exam_key 
from mst_useranswer 
left join mst_question on mst_question.que_id = mst_useranswer.qid
left join mst_test on mst_question.test_id = mst_test.test_id
where mst_useranswer.test_id = ".$_GET['test_id']." and mst_useranswer.unique_exam_key = ".$_GET['unique_exam_key']." 
order by mst_useranswer.qid, mst_useranswer.time asc";


    //echo $ques_query.'<br>';
    
    $counter = 1;
    
    if($ques_result = mysqli_query($con, $ques_query,$cn))
    {
      $rowcount = mysqli_num_rows($ques_result); 
      //mysqli_data_seek($ques_result, 0);
      //$row = mysqli_fetch_row($ques_result);
      
      if($rowcount==0){
          echo '<div class="p-3 mb-2 bg-danger text-white">No review available for this exam</div>';
          exit;
      }
    }
    else
    {
    	echo 'failed to get data from server';
    }
    
}
else{
    echo 'uniqueKey: '.$_GET['unique_exam_key'];
    echo '<br>Direct access to review page not allowed! or invalid redirection.<br>Please contact to administrator.';
    exit;
}


?>
    
                    <section class="col-12">
			            <ul class="nav nav-tabs flex-nowrap  scrollbar-light-blue" role="tablist" style="overflow-x: scroll;">
<style>
.scrollbar-light-blue::-webkit-scrollbar-track {
-webkit-box-shadow: inset 0 0 6px rgba(0, 0, 0, 0.1);
    background-color: #007bff38;
border-radius: 10px; }

.scrollbar-light-blue::-webkit-scrollbar {
    width: 0;
    background-color: #F5F5F5;
    height: 5px; }

.scrollbar-light-blue::-webkit-scrollbar-thumb {
border-radius: 10px;
-webkit-box-shadow: inset 0 0 6px rgba(0, 0, 0, 0.1);
background-color: #82B1FF; }

.scrollbar-light-blue {
  scrollbar-color: #82B1FF #F5F5F5;
}


</style>   			                
<?php
mysqli_data_seek($ques_result, 0);
while($row = mysqli_fetch_row($ques_result)) {
    //title="Question-'.$counter.'" temporary disable title to li
	if($counter == 1)
	{
		echo '<li role="presentation" class="nav-item">';
		echo '<a href="#step'.$counter.'" class="nav-link active"'; 
		echo ' data-toggle="tab" aria-controls="step'.$counter;
		echo '" role="tab" >'.$counter.'</a>';
		echo '</li>';
	}
	elseif($counter == $rowcount)
	{
		echo '<li role="presentation" class="nav-item">
				<a href="#step'.$counter.'" class="nav-link disabled" data-toggle="tab" aria-controls="complete'.$counter.'" role="tab" >'.$counter.'</a>
			  </li>';	
			  break;
	}
	else
	{
		echo '<li role="presentation" class="nav-item">
				<a href="#step'.$counter.'" class="nav-link disabled" data-toggle="tab" aria-controls="step'.$counter.'" role="tab" >'.$counter.'</a>
			  </li>';	
	}

	$counter = $counter+1; 
}//while($counter < $rowcount); 

?>
			            </ul>
			            <form name=myfm method=post action="quiz.php?testid=<?php echo $_GET['testid']; ?>&subid=<?php echo $_GET['subid']; ?>">
			            	<input type="hidden" class="form-check-input" name="total" value="<?php echo $rowcount; ?>">
			            	<input type="hidden" class="form-check-input" name="tid" value="<?php echo $tid; ?>">
			            	<input type="hidden" class="form-check-input" name="subid" value="<?php echo $subid; ?>">

			                <div class="tab-content py-2">


<?php
$counter = 1;
mysqli_data_seek($ques_result, 0);
$rowcount = mysqli_num_rows($ques_result); 

mysqli_data_seek($ques_result, 0);
while($row = mysqli_fetch_row($ques_result)) { 

	$qid = $row[2];
	$question = $row[3];
	$option1 = $row[4];
	$option2 = $row[5];
	$option3 = $row[6];
	$option4 = $row[7];
	$true_ans = $row[8];
	$your_ans = $row[9];
	$attempt_time = $row[10];
	$test_name = $row[1];
    
    
	$word = '[&_0]';
	
	if($true_ans == $your_ans){
	    $correct = 1;
	}
	else{
	    $correct = 0;
	}
	
	if($counter == 1){
		echo '					<div class="tab-pane active" role="tabpanel" id="step'.$counter.'">';
		echo '<script>$("#test_name_span").text("'.$test_name.'");</script>';
	}
	else{
		echo '					<div class="tab-pane" role="tabpanel" id="step'.$counter.'">';
	}
	

	?>

		                        <h6>
									<span style="color: #8e8e8e;font-style: italic;font-variant: diagonal-fractions;font-weight: bold;">
										Q<?php echo $counter; ?>.</span>  
									<?php echo $question; ?>
								</h6>
		                        <div class="form-check" style="<?php if(strpos($option1, $word) !== false){echo 'display:none;';}else{} ?>">
								  <label class="form-check-label" style="<?php if($true_ans == 1) echo 'color:green;font-weight: bold;'; ?>">
								    <input type="radio" class="form-check-input" name="ans<?php echo $counter; ?>" value="1"  disabled="disabled" readonly="readonly" <?php if($your_ans == 1){echo 'checked="checked"'; } ?>><?php echo $option1; ?>
								  </label>
								</div>
								<div class="form-check" style="<?php if(strpos($option2, $word) !== false){echo 'display:none;';}else{} ?>">
								  <label class="form-check-label" style="<?php if($true_ans == 2) echo 'color:green;font-weight: bold;'; ?>">
								    <input type="radio" class="form-check-input" name="ans<?php echo $counter; ?>" value="2" disabled="disabled" readonly="readonly" <?php if($your_ans == 2){echo 'checked="checked"'; } ?>><?php echo $option2; ?>
								  </label>
								</div>
								<div class="form-check" style="<?php if(strpos($option3, $word) !== false){echo 'display:none;';}else{} ?>">
								  <label class="form-check-label" style="<?php if($true_ans == 3) echo 'color:green;font-weight: bold;'; ?>">
								    <input type="radio" class="form-check-input" name="ans<?php echo $counter; ?>"  value="3" disabled="disabled" readonly="readonly" <?php if($your_ans == 3){echo 'checked="checked"'; } ?>><?php echo $option3; ?>
								  </label>
								</div>
								<div class="form-check" style="<?php if(strpos($option4, $word) !== false){echo 'display:none;';}else{} ?>">
								  <label class="form-check-label" style="<?php if($true_ans == 4) echo 'color:green;font-weight: bold;'; ?>">
								    <input type="radio" class="form-check-input" name="ans<?php echo $counter; ?>" value="4"  disabled="disabled" readonly="readonly" <?php if($your_ans == 4){echo 'checked="checked"'; } ?>><?php echo $option4; ?>
								  </label>
								</div>
								<div class="form-check">
								    <lable class="form-check-label">
								        <?php
								            if($correct == 1)
								            { 
								                echo '<span class="bg-success text-white">';
								                echo 'Your answer was correct.';
								                echo '</span>';
								            } 
								            else
								            { 
								                echo '<span class="bg-danger text-white">';
								                echo 'Your answer was wrong.';
								                echo '</span>';
								            } 
								            
								        ?>
								    </lable>
								</div>
								<div class="form-check">
								    <lable class="form-check-label">
								        <?php
								            echo '<span class="text-info">Attempt on: '.date_format(date_create($attempt_time),"d-M-Y H:i:s").'</span>';
								        ?>
								    </lable>
								</div>

	


	<?php
    
	
	if($counter == 1){
		echo '	                    <button type="button" class="btn btn-primary next-step float-right">Next</button>';
	}
	else if($counter == $rowcount)
	{
		echo '						<ul class="float-right">';
		echo '							<li class="list-inline-item">';
		echo '								<button type="button" class="btn btn-outline-primary prev-step">Previous</button>';
		echo '							</li>';
		echo '							<li class="list-inline-item">';
		?>								<!--<button type="button" name="submit_paper" onclick="window.location='sublist.php';" class="btn btn-primary btn-info-full next-step">Back to Exam Page</button>
		                               --> <a name="submit_paper" href="<?php echo $_SERVER['HTTP_REFERER']; ?>" class="btn btn-primary btn-info-full next-step">Back to Exam Page</a>
		<?php
		echo '							</li>';
		echo '						</ul>';
	}
	else
	{
		echo '						<ul class="float-right">';
		echo '                      	<li class="list-inline-item">';
		echo '                      		<button type="button" class="btn btn-outline-primary prev-step">Previous</button>';
		echo '                      	</li>';
		echo '                      	<li class="list-inline-item">';
		echo '                      		<button type="button" class="btn btn-outline-primary next-step">Next</button>';
		echo '                      	</li>';		                            
		echo '                      </ul>';
	}
	
	echo '	                    </div>';
	// end of question  list
	$counter++;

}

?>

							<div class="clearfix"></div>
		                </div>
		            </form>
		        </section>
		    </div>
		</div>

<style type="text/css">
	.nav-link {
    display: block;
    padding: 0.2rem 0.5rem;
}


h2 > span[class*="badge"] {
        font-size: 65%;
        white-space: pre-wrap;
        line-height: 160%;
        display: inline;
} 

h6 > span[class*="badge"] {
        font-size: 95%;
        white-space: pre-wrap;
        line-height: 160%;
        display: inline;
} 

.float-right{
    margin-top:15px;
}


</style>



</div></div></div>

<script type="text/javascript">
	$(document).ready(function () {
    //Initialize tooltips
    $('.nav-tabs > li a[title]').tooltip();
    
    //Wizard
    $('a[data-toggle="tab"]').on('show.bs.tab', function (e) {
        var $target = $(e.target);
        if ($target.parent().hasClass('disabled')) {
            return false;
        }
    });

    $(".next-step").click(function (e) {
        var $active = $('.nav-tabs li>.active');
        $active.parent().next().find('.nav-link').removeClass('disabled');
        nextTab($active);
    });
    
    $(".prev-step").click(function (e) {
        var $active = $('.nav-tabs li>a.active');
        prevTab($active);
    });
    
    //key listner code start here
    $(document).keydown(function(e) {
        switch(e.which) {
            case 37: // left
                    var $active = $('.nav-tabs li>a.active');
                    prevTab($active);
                    break;
            case 39: // right
                    var $active = $('.nav-tabs li>.active');
                    $active.parent().next().find('.nav-link').removeClass('disabled');
                    nextTab($active);
                    break;
            default: return; // exit this handler for other keys
        }
        e.preventDefault(); // prevent the default action (scroll / move caret)
    });
    //key listner code end here
    
    
});

function nextTab(elem) {
    $(elem).parent().next().find('a[data-toggle="tab"]').click();
}
function prevTab(elem) {
    $(elem).parent().prev().find('a[data-toggle="tab"]').click();
}

$('.nav-tabs').find('.nav-link').removeClass('disabled');
</script>
</body>
</html>