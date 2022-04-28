<?php 

if(isset($_POST['file_name'],$_COOKIE['photouser'])) {

include_once("db_connect.php");

$albumId = $_POST['albumId'];
$albumNumber = $_POST['albumNumber'];
$albumDate = $_POST['albumDate'];
$albumUrl = $_POST['albumUrl'];
$file_name = $_POST['file_name'];

$sql = "UPDATE album SET albumCover='$albumUrl/$file_name' WHERE albumId=$albumId";

if (mysqli_query($conn, $sql)) {
  header("Location: photo-albumNumber-".$albumNumber."-albumDate-".$albumDate); 
} else {
  echo "Error updating record: " . mysqli_error($conn);
}

mysqli_close($conn);
} else {
	echo 'Fuck off';
}
?>