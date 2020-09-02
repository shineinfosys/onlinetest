<?php


include_once("database.php");




if(!empty($_POST["region"])) {

        $query = "SELECT location, region FROM center_staff WHERE region = '".$_POST["region"]."' ORDER BY location asc ";

	
	$results = mysqli_query($con, $query);
    echo $query;
	

	while($center_location = mysqli_fetch_assoc($results)) {
?>
	<option value="<?php echo $center_location["location"]; ?>" <?php if($_POST['sel'] == $center_location["location"]) echo 'selected'; ?>><?php echo $center_location["location"]; ?></option>
<?php
	}
}
?>


<?php // closing connection 
mysqli_close(); ?>