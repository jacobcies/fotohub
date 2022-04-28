<?php 
include_once("db_connect.php");

//update image note

if(isset($_POST['update_note'],$_COOKIE['photouser'])) {

$id = $_POST['id'];
$albumNumber = $_POST['albumNumber'];
$photo_note = $_POST['photo_note'];
$albumDate = $_POST['albumDate'];

$sql = "UPDATE images SET photo_note='$photo_note' WHERE id=$id";

if (mysqli_query($conn, $sql)) {
  header("Location: photo-albumNumber-".$albumNumber."-albumDate-".$albumDate); 
} else {
  echo "Error updating record: " . mysqli_error($conn);
}
}

//update image favorite.

 if(isset($_POST['favupdate'])) {
 	
 	$id = $_POST['id'];
   $albumNumber = $_POST['albumNumber'];
   $albumDate = $_POST['albumDate'];
   $photo_fav = 1;
 	
 	$sql = "UPDATE images SET photo_fav=1 WHERE id='$id'";

if (mysqli_query($conn, $sql)) {
	header("Location: photo-albumNumber-".$albumNumber."-albumDate-".$albumDate); 
} else {
 echo "Error updating record: " . mysqli_error($conn);
}
 }
 
 //remove from favorite
 
 if(isset($_POST['favremove'])) {
 	
 	$id = $_POST['id'];
   $albumNumber = $_POST['albumNumber'];
   $albumDate = $_POST['albumDate'];
   $photo_fav = 0;
 	
 	$sql = "UPDATE images SET photo_fav=0 WHERE id='$id'";

if (mysqli_query($conn, $sql)) {
  header("Location: photo-albumNumber-".$albumNumber."-albumDate-".$albumDate); 
} else {
  echo "Error updating record: " . mysqli_error($conn);
}
 }



?>