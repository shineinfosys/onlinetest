<?php include('template_head.php'); ?>
<?php
include("header.php");
//include("database.php");
//$_SESSION[refresh]=0;


?>

<?php

error_reporting(1);
include("database.php");
extract($_POST);
extract($_GET);
extract($_SESSION);


/*$rs=mysql_query($con,"select * from mst_question where test_id=$tid",$cn) or die(mysql_error());
if($_SESSION[qn]>mysql_num_rows($rs))
{
unset($_SESSION[qn]);
exit;
}*/



if(isset($subid) && isset($testid))
{
	$_SESSION[sid]=$subid;
	$_SESSION[tid]=$testid;
	//header("location:quiz.php"); 
	
}


if(!isset($_GET['red'])){
   //echo "Welcome to Online Exam</br>"; 
    $url1=$_SERVER['REQUEST_URI'];
    //echo '<a href="'.$url1.'&red=1" >Click here to start your exam.</a>'; 
    
?>
<style>
    .list-group > .list-group {
  display: block;
  margin-bottom: 0;
  color: ;
}
.list-group-item:focus-within + .list-group {
  display: block;
}

.list-group > .list-group-item {
  border-radius: 0;
  border-width: 1px 0 0 0;
}

.list-group > .list-group-item:first-child {
  border-top-width: 0;
}

.list-group  > .list-group > .list-group-item {
  padding-left: 2.5rem;
}
.list-group > a {
    color: #828282;
}

.answered
{
    background: #cce5ff;    
}

.not-answer
{
    background: #ffdbdb;
}
</style>
<h2>General Insturctions: </h2>
<div class="list-group">
  <p class="list-group-item">1. The clock will be start when click on Start Exam button. The countdown timer at top of navigation will display the remaining time available for you to complete the examination. When the time reaches zero, the examination will end by itself. You need not terminate the examination or submit your paper.</p>

  
  <p class="list-group-item">2. To answer a quetion, do the following:</p>
  <div class="list-group">
    <p class="list-group-item">2.1 Click on the question number in the question palette at top of your screen to go to that numbered question directly. Note that using option does Not save your answer to current position until you click on Save & Submit button available on last question.</p>
    <p class="list-group-item">2.2 Click on Next / Previous button to navigate your questions.</p>
  </div>
  
    <p class="list-group-item">3. Click on Save & Submit button will save your answer and exam will terminated.</p>
    <p class="list-group-item">4. Choose one answer from the 4 options, given below the question.</p>
    <p class="list-group-item">5. You first successfull exam result will considered only, so no fruit of taking exam multiple times.</p>
    <p class="list-group-item">I agree with all terms & conditions of exam, I will resposible for any external factor affect my exam.</p>
    <a href="<?php echo $url1.'&red=1'; ?>" class="list-group-item list-group-item-action active">
    Click here to start your exam.
  </a>
</div>
<style>
    .list-group-item{
            margin-bottom: 0;
    }
</style>
<?php
   
exit;   
    
}
/*
if(!isset($_SESSION[sid]) || !isset($_SESSION[tid]))
{
	echo '<script>alert("Failed to Initialize exam!");</script>';
	header("location: index.php");
}
*/
?>

<div class="container" id="container">
	<div class="panel panel-default">
	  <div class="panel-body">
	  		<h2 class='text-center'><span class="badge badge-light">Exam </span><span class="badge badge-secondary" id="test_name_span"></span></h2>



	  		<div id="question_container" class="container py-3 my-3 border rounded shadow-sm">
<?php

if(isset($_SESSION['user_id']) && isset($_SESSION['login']) && isset($_SESSION['username']) && isset($_SESSION['region']) && isset($_SESSION['location']))
{
    //
    $login_flag = TRUE;
}
else{
	$login_flag = FALSE;
	echo '<br>'.$_SESSION['login'];
	echo '<br>'.$_SESSION['user_id'];
    echo '<br>'.$_SESSION['username'];
    echo '<br>'.$_SESSION['region'];
    echo '<br>'.$_SESSION['location'];
	echo '<br>Wrong profile configuration.<br> Contact to administration or ASM'; exit;
}







$question_qyery = "select mst_test.test_id, mst_test.test_name, mst_test.total_que, mst_test.time, mst_test.exam_release, mst_test.type, mst_question.que_id, mst_question.que_desc, mst_question.ans1, mst_question.ans2, mst_question.ans3, mst_question.ans4, mst_question.true_ans from mst_question 
left join mst_test on mst_test.test_id = mst_question.test_id
where mst_question.test_id='$testid'";

//echo $question_qyery;
if($ques_result = mysqli_query($con, $question_qyery,$cn))
{
    
    while($row = mysqli_fetch_row($ques_result)) {
        $timer = 60*$row[3];
        $total_question = $row[2];
        $test_name = $row[1];
        $test_type = $row[5];
        $exam_release = $row[4];
    }
    
    echo '<script>$("#test_name_span").text("'.$test_name.'");</script>';
    
    if($test_type == $_SESSION['exam_complete']){
        $exam_complete = 1;
    }
    if($exam_complete == 1){
	    //show exam complete message
	  	echo '<div class="alert alert-primary" role="alert">';
        echo 'You have attempt your exam <span style="padding: 5px;" class="badge badge-warning">'.$test_name.'</span>, so please check your <a href="result.php" class="alert-link">exam result</a>. If not done then please <a href="signout.php" class="alert-link">re-login</a> and check.';
        echo '</div>';
        exit;
	  		        
	}
}


//mysqli_free_result($ques_result);


?>
	  		    <?php 
	  		    if(!isset($_POST['name']) && !isset($_POST['submit_paper']) && $login_flag){
            		//echo 'name: '.$_POST['name'].'<br>'; ?>
	  		    <div class="row">
	  		        <section class="col-12">
	  		            <div class="col-12">Timer: <span id="display" style="color:#FF0000;font-size:15px"> </span></div>
	  		       </section>
	  		        <section class="col-12">
	  		            <div class="col-12"><span id="timer" style="color:#FF0000;font-size:15px"> </span></div>
	  		        </section>
	  		    </div>
	  		    
	  		        <script>
            var div = document.getElementById('display');
            var timer = document.getElementById('timer');

              function CountDown(duration, display) {

                        var timer = duration, minutes, seconds;

                      var interVal=  setInterval(function () {
                            minutes = parseInt(timer / 60, 10);
                            seconds = parseInt(timer % 60, 10);

                            minutes = minutes < 10 ? "0" + minutes : minutes;
                            seconds = seconds < 10 ? "0" + seconds : seconds;
                    display.innerHTML ="<b>" + minutes + "m : " + seconds + "s" + "</b>";
                            if (timer > 0) {
                               --timer;
                            }else{
                       clearInterval(interVal)
                                SubmitFunction();
                             }

                       },1000);

                }

              function SubmitFunction(){
                timer.innerHTML="Time is up! Your exam is being sumited automatically...";
                //document.getElementById('MCQuestion').submit();
                window.setTimeout(function() {
                	document.getElementById("myfm").submit();
                }, 5000);
                
                //document.MCQuestion.submit.bind(document.MCQuestion);
               }
               CountDown(<?php echo $timer; ?>,div);
            </script>
	  		   <?php     
	  		        
	  		    }
	  		    
	  		    
	  		    
	  		    ?>
	  		    
			    <div class="row">
			        <section class="col-12">
			            <ul class="nav nav-tabs flex-nowrap" role="tablist" id="question_list">
<?php
// get all question paper and answer here 

//$ques_query = "select que_id from mst_question where test_id='".$tid."'";



$counter = 1;
mysqli_data_seek($ques_result, 0); 
if(isset($ques_result))
{
  $rowcount = mysqli_num_rows($ques_result); //echo 'row_count: '.$rowcount.'<br>';
}
else
{
	echo 'failed to get data from server';
}
mysqli_data_seek($ques_result, 0); 
while($row = mysqli_fetch_row($ques_result)) {
	if($counter == 1)
	{
		echo '<li role="presentation" class="nav-item">';
		echo '<a href="#step'.$counter.'" class="nav-link active"'; 
		echo ' data-toggle="tab" aria-controls="step'.$counter;
		echo '" role="tab" title="Question-'.$counter.'">'.$counter.'</a>';
		echo '</li>';
	}
	elseif($counter == $rowcount)
	{
		echo '<li role="presentation" class="nav-item">
				<a href="#step'.$counter.'" class="nav-link" data-toggle="tab" aria-controls="complete'.$counter.'" role="tab" title="Question-'.$counter.'">'.$counter.'</a>
			  </li>';	
			  break;
	}
	else
	{
		echo '<li role="presentation" class="nav-item">
				<a href="#step'.$counter.'" class="nav-link" data-toggle="tab" aria-controls="step'.$counter.'" role="tab" title="Question-'.$counter.'">'.$counter.'</a>
			  </li>';	
	}

	$counter = $counter+1; 
}//while($counter < $rowcount); 

?>
			            </ul>
			            <form id="myfm" name=myfm method=post action="quiz.php?&red=1&testid=<?php echo $_GET['testid']; ?>&subid=<?php echo $_GET['subid']; ?>">
			            	<input type="hidden" class="form-check-input" name="total" value="<?php echo $rowcount; ?>">
			            	<input type="hidden" class="form-check-input" name="tid" value="<?php echo $tid; ?>">
			            	<input type="hidden" class="form-check-input" name="subid" value="<?php echo $subid; ?>">
			            	<input type="hidden" class="form-check-input" name="test_type" value="<?php echo $test_type; ?>">
                            <input type="hidden" class="form-check-input" name="exam_release" value="<?php echo $exam_release; ?>">
                            <input type="hidden" class="form-check-input" name="test_name" value="<?php echo $test_name; ?>">
			                <div class="tab-content py-2">


<?php
$counter = 1;
//$ques_query = "select * from mst_question where test_id='".$tid."'";
mysqli_data_seek($ques_result, 0); 
while($row = mysqli_fetch_row($ques_result)) { 

	$qid = $row[6];
	$question = $row[7];
	$option1 = $row[8];
	$option2 = $row[9];
	$option3 = $row[10];
	$option4 = $row[11];
	$correct = $row[12];
	
	$word = '[&_0]';
	
	if($counter == 1){
		echo '					<div class="tab-pane active" role="tabpanel" id="step'.$counter.'">';
	}
	else{
		echo '					<div class="tab-pane" role="tabpanel" id="step'.$counter.'">';
	}
	



	echo '	                        <h6>';
	echo '								<span style="color: #8e8e8e;font-style: italic;font-variant: diagonal-fractions;font-weight: bold;">Q';
	echo $counter;
	echo '								.</span> '; 
	echo $question;
	echo '							</h6>';
	
	
	
    	echo '	                        <div class="form-check">';
    	echo '							  <label class="form-check-label">';
    	if(strpos($option1, $word) !== false){ 
    	    //echo '							    <input disabled type="radio" class="form-check-input" name="ans'.$counter.'" value="1">'.$option1;
    	}
    	else{
    	    echo '							    <input type="radio" class="form-check-input" name="ans'.$counter.'" value="1">'.$option1;
    	}
    	echo '							    <input type="hidden" class="form-check-input" name="qid[]" value="'.$qid.'">';
    	echo '							  </label>';
    	echo '							</div>';
	

    	echo '							<div class="form-check">';
    	echo '							  <label class="form-check-label">';
    	//echo '							    <input type="radio" class="form-check-input" name="ans'.$counter.'" value="2">'.$option2;
    	if(strpos($option2, $word) !== false){ 
    	    //echo '							    <input disabled type="radio" class="form-check-input" name="ans'.$counter.'" value="2">'.$option2;
    	}
    	else{
    	    echo '							    <input type="radio" class="form-check-input" name="ans'.$counter.'" value="2">'.$option2;
    	}
    	echo '							  </label>';
    	echo '							</div>';

    	echo '							<div class="form-check">';
    	echo '							  <label class="form-check-label">';
    	//echo '							    <input type="radio" class="form-check-input" name="ans'.$counter.'"  value="3">'.$option3;
    	if(strpos($option3, $word) !== false){ 
    	    //echo '							    <input disabled type="radio" class="form-check-input" name="ans'.$counter.'"  value="3">'.$option3;
    	}
    	else{
    	    echo '							    <input type="radio" class="form-check-input" name="ans'.$counter.'"  value="3">'.$option3;
    	}
    	echo '							  </label>';
    	echo '							</div>';

    	echo '							<div class="form-check ">';
    	echo '							  <label class="form-check-label">';
    	//echo '							    <input type="radio" class="form-check-input" name="ans'.$counter.'" value="4" >'.$option4;
    	if(strpos($option4, $word) !== false){ 
    	    //echo '							    <input disabled type="radio" class="form-check-input" name="ans'.$counter.'" value="4" >'.$option4;
    	}
    	else{
    	    echo '							    <input type="radio" class="form-check-input" name="ans'.$counter.'" value="4" >'.$option4;
    	}
    	echo '								<input type="hidden" class="form-check-input" name="correct'.$counter.'" value="'.$correct.'">';
    	echo '							  </label>';
    	echo '							</div>';

	
	?>


	<?php

	if($counter == 1 && $rowcount > 1){
		echo '	                    <button type="button" class="btn btn-primary next-step float-right">Next</button>';
	}
	else if($rowcount == 1){
		echo '						<ul class="float-right">';
		echo '							<li class="list-inline-item">';
		echo '								<input type="submit" name="submit_paper" id="submit_paper" class="btn btn-primary btn-info-full next-step" value="Submit & View Result">';
		echo '							</li>';
		echo '						</ul>';	    
	}
	else if($counter == $rowcount)
	{
		echo '						<ul class="float-right">';
		echo '							<li class="list-inline-item">';
		echo '								<button type="button" class="btn btn-outline-primary prev-step">Previous</button>';
		echo '							</li>';
		echo '							<li class="list-inline-item">';
		echo '								<input type="submit" name="submit_paper" id="submit_paper" class="btn btn-primary btn-info-full next-step" value="Submit & View Result">';
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
</style>



<?php
//echo 'testsdfsdf'; exit;
		//if (isset($_POST['submit_paper'])) // && isset($_POST['total']))
		if ($_SERVER['REQUEST_METHOD'] == 'POST')
		{
			echo '<style>#question_container{display:none;}</style>';			
			$subid = $_POST['subid'];
			$tid = $_POST['tid'];
			
			$test_name =$_POST['test_name'];
			$test_type = $_POST['test_type'];
			$total = $_POST['total'];
			
			$user_id = $_SESSION['user_id'];
			
			//$qid = 
			
			$score = 0;
            
            
            
            $n=20; 
            function random_string($n) { 
                $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ'; 
                $randomString = ''; 
              
                for ($i = 0; $i < $n; $i++) { 
                    $index = rand(0, strlen($characters) - 1); 
                    $randomString .= $characters[$index]; 
                } 
              
                return $randomString; 
            } 
              
            //$key=rand(); 
            $unique_exam_key = md5(random_string($n));
			// Loop through the all question paper array
			foreach ($_POST['qid'] as $index=>$value) 
			{

			    // Do something with each valid friend entry ...
			    if ($value) {
			    	$qid = $_POST['qid'][$index];
			    	$que_des = $_POST['qid'][$index];
			    	
			    	//$your_ans = $_POST['your_ans'][$index];
			    	switch ($index) {
			    		case 0: $your_ans = $_POST['ans1']; $correct = $_POST['correct1']; break;
			    		case 1: $your_ans = $_POST['ans2']; $correct = $_POST['correct2'];  break;
			    		case 2: $your_ans = $_POST['ans3']; $correct = $_POST['correct3'];  break;
			    		case 3: $your_ans = $_POST['ans4']; $correct = $_POST['correct4']; break;
			    		case 4: $your_ans = $_POST['ans5']; $correct = $_POST['correct5'];  break;
			    		case 5: $your_ans = $_POST['ans6']; $correct = $_POST['correct6'];  break;
			    		case 6: $your_ans = $_POST['ans7']; $correct = $_POST['correct7'];  break;
			    		case 7: $your_ans = $_POST['ans8']; $correct = $_POST['correct8'];  break;
			    		case 8: $your_ans = $_POST['ans9']; $correct = $_POST['correct9'];  break;
			    		case 9: $your_ans = $_POST['ans10']; $correct = $_POST['correct10'];  break;
			    		case 10: $your_ans = $_POST['ans11']; $correct = $_POST['correct11'];  break;
			    		case 11: $your_ans = $_POST['ans12']; $correct = $_POST['correct12'];  break;
			    		case 12: $your_ans = $_POST['ans13']; $correct = $_POST['correct13'];  break;
			    		case 13: $your_ans = $_POST['ans14']; $correct = $_POST['correct14'];  break;
			    		case 14: $your_ans = $_POST['ans15']; $correct = $_POST['correct15'];  break;
			    		case 15: $your_ans = $_POST['ans16']; $correct = $_POST['correct16'];  break;
			    		case 16: $your_ans = $_POST['ans17']; $correct = $_POST['correct17'];  break;
			    		case 17: $your_ans = $_POST['ans18']; $correct = $_POST['correct18'];  break;
			    		case 18: $your_ans = $_POST['ans19']; $correct = $_POST['correct19'];  break;
			    		case 19: $your_ans = $_POST['ans20']; $correct = $_POST['correct20'];  break;
			    	}
			    	/*
			    	echo '<br>$qid: '.$qid;
			    	echo '<br>$que_des: '.$que_des;
			    	echo '<br>$your_ans: '.$your_ans; */
			    	
                    
                    
			            if($index == 0){
    			        	$insert_query = "insert into mst_useranswer(
    								unique_exam_key, user_id, sess_id, test_id, qid, que_des, true_ans,your_ans) 
    							values('".$unique_exam_key."',".$_SESSION['user_id'].",'".session_id()."', $tid,'$qid', '$que_des', '$correct','$your_ans');";
    							if($your_ans == $correct){
    					    		$score = $score + 1;
    					    	}
    			        }
    			        else{
    			        	$insert_query .= "insert into mst_useranswer(
    								unique_exam_key, user_id, sess_id, test_id, qid, que_des, true_ans,your_ans) 
    							values('".$unique_exam_key."',".$_SESSION['user_id'].",'".session_id()."', $tid,'$qid', '$que_des', '$correct','$your_ans');";
    							if($your_ans == $correct){
    					    		$score = $score + 1;
    					    	}
    			        }
			        
			        
			    }
			}
			
			
        $date = new DateTime();
        $date->add(new DateInterval('PT5H30M'));
        $currentdatetime = $date->format('Y-m-d H:i:s');
        
		$insert_query .= "insert into mst_result(user_id, login,test_id,test_date,score,unique_exam_key) values('$user_id', '$_SESSION[login]',$tid,'".$currentdatetime."',$score,'$unique_exam_key');";
		
	//	echo $insert_query;
		
			//exit;
			$flag = 0;
			if ($result = mysqli_multi_query($con, $insert_query)) {
				echo '<div class="alert alert-success">
  						<strong>Success!</strong> Exam completed successfully.
					  </div>';
			    $flag = 1;
			}
			else {
				echo '<div class="alert alert-danger">
  						<strong>Error!</strong>'.mysqli_error($con).'
					  </div>';
			    $flag = 0;
			}

			mysqli_free_result($result);


			
			if($flag == 1){
				
                //mysqli_free_result($getExamName);
				echo "<h3> Result of <span  class='badge badge-secondary'>".$test_name."</span> - ".ucwords($_SESSION[login])."</h3>";
				//$_SESSION[qn]=$_SESSION[qn]+1;
				
				
				echo '<table align=center class="table table-hover"><tr class="table-primary"><td>Total Question<td>'.$total.'</td></tr>';
				echo '<tr class="table-success"><td>Right Answer</td><td>'.$score.'</td></tr>';
				$w=$total-$score;
				echo '<tr class="table-danger"><td>Wrong Answer<td> '. $w.'</td></tr>';
				echo "</table>";
				
				/*
				if($score_update){
					echo '<div class="alert alert-success">
  						<strong>Success!</strong> Score updated successfully.
					  </div>';
				}
				else{
					echo '<div class="alert alert-danger">
  						<strong>Error!</strong>'.mysqli_error($con).'
					  </div>';
				}*/
				
				if($_SESSION['exam_assign'] == $tid or $test_type == 1)
				{
				    echo "<h3 align=center>Review not avaliable in exam paper</h3>";
				    $_SESSION['exam_complete'] = 1;
				}    
				else{
				    echo "<h3 align=center><a href=review.php?unique_exam_key='".$unique_exam_key."'&test_id=".$tid."> Review Question</a> </h3>";
				}

				
			}
			mysqli_close($con);	






		}//post check code end here

?>



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
});

function nextTab(elem) {
    $(elem).parent().next().find('a[data-toggle="tab"]').click();
}
function prevTab(elem) {
    $(elem).parent().prev().find('a[data-toggle="tab"]').click();
}

$('.nav-tabs').find('.nav-link').removeClass('disabled');
</script>


<style>
    .list-inline-item:not(:last-child) {
    margin-right: 0;
}

h2 > span[class*="badge"] {
        font-size: 65%;
        white-space: pre-wrap;
        line-height: 160%;
        display: inline;
} 

h6 > span[class*="badge"] {
        font-size: 90%;
        white-space: pre-wrap;
        line-height: 160%;
        display: inline;
} 

.float-right{
    margin-top:15px;
}

</style>
</body>
</html>