<?php
   session_start();
   include_once("db_connect.php");
   $user = $_COOKIE["photouser"];
   unset($_SESSION["photouser"]);
   unset($_SESSION["password"]);
   unset($_COOKIE['photouser']); 
   
   setcookie('photouser', null, -1, '/'); 
   setcookie('userCode', null, -1, '/'); 
   
   session_destroy();
   session_write_close();
   
   $sql = "UPDATE users SET userLoged=0,userCode=NULL WHERE usemail='$user'";
	if (mysqli_query($conn, $sql)) {}
   
   header('Refresh: 0; URL = /');
?>