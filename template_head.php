<?php ini_set( "display_errors", 0); ?>
<?php
session_start();
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>
<head>
	<title>Welcome to Online Exam</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js"></script>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
  

  <style>
    .form-check {
    position: relative;
    display: block;
    padding-left: 1.25rem;
    margin-left: 40px;
}
  </style>

</head>

<body>
 <!--
<div class="text-center" style="margin-bottom:0">
  <h2>Online Exam</h2>
  <p>Developed by - Swami Vardhan</p> 
</div> -->




<nav class="navbar navbar-expand-md bg-dark navbar-dark">
  <!-- Brand -->
    <a class="navbar-brand" href="index.php" style="max-width: 150px;">Online Exam</a>

  <!-- Toggler/collapsibe Button -->
  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#collapsibleNavbar">
    <span class="navbar-toggler-icon"></span>
  </button>

  <!-- Navbar links -->
  <div class="collapse navbar-collapse" id="collapsibleNavbar">
    <ul class="navbar-nav">
      <li class="nav-item">
      <a class="nav-link" href="index.php">Home</a>
    </li>
    <li class="nav-item">
      <a class="nav-link" href="sublist.php">Practice</a>
    </li>
    <li class="nav-item">
      <a class="nav-link" href="result.php">Result</a>
    </li>
    <?php
    if(!isset($_SESSION[login])){
        echo '<li class="nav-item">';
        echo '<a class="nav-link" href="./admin/">Admin Login</a>';
        echo '</li>';
    } ?>
    <!-- Dropdown -->
    <?php
    if(isset($_SESSION[login])){
        echo '<li class="nav-item dropdown">';
        echo '<a class="nav-link dropdown-toggle" href="#" id="navbardrop" data-toggle="dropdown">';
        echo '<i class="fa fa-user-circle-o"></i> ';
        echo ucwords($_SESSION[username]);
        echo '</a>';
    }
    ?>
      <div class="dropdown-menu" aria-labelledby="navbardrop">
        <a class="dropdown-item" href="userprofile.php">Profile</a>
        <a class="dropdown-item" href="signout.php">Logout</a>
      </div>
    </li>
    </ul>
  </div>
</nav>

<br>


<div class="footer"  id="footer">
  <a href="https://fb.me/swamivardhan" target="_blank"><h5><span style="padding-right: 0px;" class="badge badge-light">Developed By</span> <span class="badge badge-secondary">Swami Vardhan</span></h5></a>
</div>

<style>
.footer {
   position: fixed;
   left: 0;
   bottom: 0;
   width: 100%;
   background-color: none;
   color: white;
   text-align: center;
   transition-delay: 2s;
}
.footer > p {
    color: #8a8a8a;
    font-weight: bold;
    font-family: monospace;

}
.footer > p > a {
  color: inherit;
}
.container{
    margin-bottom:50px;
}
</style>

<script>
    let didScroll = false;
 
window.onscroll = () => didScroll = true;
 
setInterval(() => {
    if ( didScroll ) {
        didScroll = false;

         $("footer").fadeOut();
         document.getElementById('footer').style.display = 'none';
    }
    else{
        
         $("footer").fadeIn();
         document.getElementById('footer').style.display = 'block';
        
    }
}, 300);
</script>
