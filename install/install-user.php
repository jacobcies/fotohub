<?php
if(isset($_POST['adduser'])) {

include '../db_connect.php';

$usemail = $_POST['usemail'];
$uspasswd = $_POST['uspasswd'];
$userName = $_POST['userName'];
$userSurname = $_POST['userSurname'];
$userLang = 'lang/lang.en.php';
$userPhoto = 'assets/img/users/userlogo.png';
$userlevel = 5;

$sql = "INSERT INTO users
 (usemail, uspasswd, userName, userSurname, userPhoto, userlevel, userLang)
VALUES ('$usemail', '$uspasswd', '$userName', '$userSurname', '$userPhoto', '$userlevel', '$userLang')";

if ($conn->query($sql) === TRUE) {
  
} else {
  echo "Error: " . $sql . "<br>" . $conn->error;
}
$serverh = $_COOKIE['serverh'];
$sql = "UPDATE settings SET weburl='$serverh' WHERE setid=1";

if ($conn->query($sql) === TRUE) {
   
} else {
  echo "Error updating record: " . $conn->error;
}

}

?>

<h1>Now you can go to your photo album</h1>
<a href="/" >Login</a>