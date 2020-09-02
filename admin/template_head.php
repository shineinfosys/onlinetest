<?php
session_start();
error_reporting(1);
?>
<?php ini_set( "display_errors", 0); ?>
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

<nav class="navbar navbar-expand-md bg-dark navbar-dark">
  <!-- Brand -->
    <a class="navbar-brand" href="login.php">Online Exam</a>

  <!-- Toggler/collapsibe Button -->
  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#collapsibleNavbar">
    <span class="navbar-toggler-icon"></span>
  </button>

  <!-- Navbar links -->
  <div class="collapse navbar-collapse" id="collapsibleNavbar">
    <ul class="navbar-nav">
      <li class="nav-item">
      <a class="nav-link" href="login.php">Home</a>
    </li>
    <li class="nav-item">
      <a class="nav-link" href="viewsub.php">View Subjects</a>
    </li>
    <li class="nav-item">
      <a class="nav-link" href="testview.php">View Tests</a>
    </li>
    <li class="nav-item">
      <a class="nav-link" href="questiondelete.php">View Questions</a>
    </li>
    <li class="nav-item">
      <a class="nav-link" href="testresult.php">View Results</a>
    </li>
    <li class="nav-item">
      <a class="nav-link" href="showuser.php">Users List</a>
    </li>
    <li class="nav-item">
      <a class="nav-link" href="./../">User Login</a>
    </li>

    <!-- Dropdown -->
    <li class="nav-item dropdown">
      <a class="nav-link dropdown-toggle" href="#" id="navbardrop" data-toggle="dropdown">
        <?php if(isset($_SESSION['userid'])){ echo ucwords($_SESSION['userid']); } else{ echo 'Profile'; }?>
      </a>
      <div class="dropdown-menu">
        <a class="dropdown-item" href="signout.php">Logout</a>
      </div>
    </li>


    


    </ul>
  </div>
</nav>


<div class="footer"  id="footer" style="z-index: 999;">
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



<br>
<div class="container" style="width:100%;margin-bottom: 80px;">
    <div class="row">
        <div class="col-lg-12">