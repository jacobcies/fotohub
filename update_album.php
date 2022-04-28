<?php 

if(isset($_POST['updateAlbum'],$_COOKIE['photouser'])) {

include_once("db_connect.php");

$albumId = $_POST['albumId'];
$albumNumber = $_POST['albumNumber'];
$albumName = $_POST['albumName'];
$albumDesc = $_POST['albumDesc'];
$albumDate = $_POST['albumDate'];
$albumTags = $_POST['albumTags'];
$albumLat = $_POST['albumLat'];
$albumLng = $_POST['albumLng'];
$albumZoom = $_POST['albumZoom'];
$albumBlog = $_POST['albumBlog'];
$image_date = $_POST['albumDate'];
                           $a = strtotime($image_date);
                           $tooldate = date('d F Y', $a);
                           $year = date('Y', $a);

$sql = "UPDATE album SET albumName='$albumName', albumDesc='$albumDesc',albumDate='$albumDate',albumTags='$albumTags', albumLat='$albumLat',albumLng='$albumLng',albumZoom='$albumZoom',albumBlog='$albumBlog' WHERE albumId=$albumId";

if (mysqli_query($conn, $sql)) {
  header("Location: photo-albumNumber-".$albumNumber."-albumDate-".$year);
  
} else {
  echo "Error updating record: " . mysqli_error($conn);
}

mysqli_close($conn);
} else {
	echo 'you dont have permission';
}
?>