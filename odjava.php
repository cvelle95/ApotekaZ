<?php
session_start();
session_destroy();
  	unset($_SESSION['username']);
	unset($_SESSION['privilegije']);
  	header("location: login.php");
	?>