<?php
session_start();
     $host='localhost';
     $user='ivan';//promeni posle
     $pass = 'ivak47';
     $db = 'apotekaz';
 
     $dataBase = new mysqli($host,$user,$pass,$db) or die("Neuspesna konekcija na bazu");
     if ($dataBase->connect_errno) {
        printf("Connect failed: %s\n", $mysqli->connect_error);
        exit();
	}
	$sid = $_SESSION['sesija_id'];
	$querry = "UPDATE sesija SET is_expired = 1 WHERE sesija_id = $sid ";
	$dataBase->query($querry);
session_destroy();
  	unset($_SESSION['username']);
	unset($_SESSION['privilegije']);
	unset($_SESSION['sesija_id']);
	unset($_SESSION['logged']);
	unset($_SESSION['user_id']);
	  header("location: login.php");
	  
	  $dataBase->close();
	?>