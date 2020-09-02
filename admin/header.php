<?php 
	@$_SESSION['login']; 
  	error_reporting(1);
?>
	
<?php

if(!isset($_SESSION[alogin]))
{
	echo "<BR><BR><BR><BR><div class=head1> Your are not logged in<br> Please <a href=index.php>Login</a><div>";
		exit;
}
