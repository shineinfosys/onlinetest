<?php

$a=array("shineqsd_user1","shineqsd_user1","shineqsd_user1","shineqsd_user1","shineqsd_user1","shineqsd_user1", "shineqsd_user1","shineqsd_user1","shineqsd_user1");
$random_keys=array_rand($a,3);

$dbuser = $a[$random_keys[0]];



$con=mysqli_connect("localhost",$dbuser,"vardhan@125","shineqsd_onlinetest") or die('Database not connected');



?>