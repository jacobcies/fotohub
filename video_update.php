<?php
include_once("db_connect.php");
if(isset($_POST['updateVideo'],$_COOKIE['photouser'])) {

$videoid = $_POST['videoid'];	
$videoName = $_POST['videoName'];
$videoDate = $_POST['videoDate'];
$videoTags = $_POST['videoTags'];

$sql = "UPDATE video SET videoName='$videoName',videoDate='$videoDate',videoTags='$videoTags' WHERE videoid=$videoid";

if (mysqli_query($conn, $sql)) {
	
  header("Location: video?all");
 
} else {
  echo "Error updating record: " . mysqli_error($conn);
}
mysqli_close($conn);
}