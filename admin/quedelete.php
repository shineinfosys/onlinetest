<?php include('template_head.php'); ?>
 
<?php
include("header.php");
include("../database.php");
 $id=$_GET['que_id'];
$test_id = $_GET['test_id'];
if ($result = mysqli_query($con,"delete from mst_question where que_id='$id'")) {
    mysqli_free_result($result);
    mysqli_close($con);
    echo '<div class="alert alert-success" role="alert">
      Question deleted successfully!
    </div>';

    echo '<div class="alert alert-light" role="alert">
            You will redirect automatically to previous page! If not redirected please <a href="questiondelete.php?test_paper='.$test_id.'">click here</a> to go to previous page. 
        </div>';
    sleep(2);
    header('location:questiondelete.php');
}
else{
     echo '<div class="alert alert-success" role="alert">
      Failed to do question deletion! <p>Please <a href="questiondelete.php?test_paper='.$test_id.'">click here</a> to go to previous page.</p>
    </div>';
    header('location:questiondelete.php');
}

?>

</div></div></div>
</body>
</html>