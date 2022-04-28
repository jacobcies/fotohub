<?php
include_once("db_connect.php");
if(isset($_POST['updateUser'],$_COOKIE['photouser'])) {

$usid = $_POST['usid'];	
$userName = $_POST['userName'];
$userSurname = $_POST['userSurname'];
$usemail = $_POST['usemail'];
$uspasswd = $_POST['uspasswd'];
$userlevel = $_POST['userlevel'];
$userLang = $_POST['userLang'];

$sql = "UPDATE users SET usemail='$usemail',uspasswd='$uspasswd',userName='$userName',userSurname='$userSurname',userlevel='$userlevel',userLang='$userLang' WHERE usid=$usid";

if (mysqli_query($conn, $sql)) {
	if(isset($_POST['guest'])) {
		setcookie("userLang", "$userLang", time()+3600*24*30);
	header("Location: profile?up");	
} else {
  header("Location: users");
 } 
} else {
  echo "Error updating record: " . mysqli_error($conn);
}
mysqli_close($conn);
}