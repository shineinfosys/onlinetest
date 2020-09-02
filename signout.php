<?php
session_start();
session_destroy();
//header("Location: index.php?login=1&alert=2");
header("Location: login.php?alert=2");
?>
