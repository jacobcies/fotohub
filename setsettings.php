<?php
ob_start();
include_once("db_connect.php");

if(isset($_POST['setwallpaper'])) {
$target_dir = "assets/img/wallpaper/";
$target_file = $target_dir . basename($_FILES["fileToUpload"]["name"]);
$uploadOk = 1;
$imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));
  $check = getimagesize($_FILES["fileToUpload"]["tmp_name"]);
  if($check !== false) {
    echo "File is an image - " . $check["mime"] . ".";
    $uploadOk = 1;
  } else {
    echo "File is not an image.";
    $uploadOk = 0;
  }
if (file_exists($target_file)) {
  $target_file = $target_dir . rand(1000,9999) . basename($_FILES["fileToUpload"]["name"]);
  $uploadOk = 1;
}
if ($_FILES["fileToUpload"]["size"] > 5000000) {
  echo "Sorry, your file is too large.";
  $uploadOk = 0;
}
if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
&& $imageFileType != "gif" ) {
  echo "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
  $uploadOk = 0;
}
if ($uploadOk == 0) {
  echo "Sorry, your file was not uploaded.";
} else {
  if (move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $target_file)) {
  	$up_file = $_FILES["fileToUpload"]["name"];
  	$sql = "UPDATE settings SET setlogwallpaper='assets/img/wallpaper/$up_file' WHERE setid='1'";
   if (mysqli_query($conn, $sql)) { 	
  	echo "<script>window.location.href='profile?up';</script>";
 }
  } else {
    echo "Sorry, there was an error uploading your file.";
  }
}
}

//switchvideo

if(isset($_POST['switchvideobutton'])) {
	$switchvideo = $_POST['switchvideo'];
$sql = "UPDATE settings SET switchvideo='$switchvideo' WHERE setid='1'";
   if (mysqli_query($conn, $sql)) { 	
  	echo "<script>window.location.href='profile?up';</script>";
 }
}

//switch blog

if(isset($_POST['switchblogi'])) {
	$switchblog = $_POST['switchblog'];
$sql = "UPDATE settings SET switchblog='$switchblog' WHERE setid='1'";
   if (mysqli_query($conn, $sql)) { 	
  	echo "<script>window.location.href='profile?up';</script>";
 }
}

//switch blog

if(isset($_POST['sharepasbutton'])) {
	$sharepasswd = $_POST['sharepasswd'];
$sql = "UPDATE settings SET sharepasswd='$sharepasswd' WHERE setid='1'";
   if (mysqli_query($conn, $sql)) { 
   echo "<script>window.location.href='profile?up';</script>";
 }
}

//mapbox token
if(isset($_POST['mapboxtoken'])) {
	$mapbox = $_POST['mapbox'];
$sql = "UPDATE settings SET mapbox='$mapbox' WHERE setid='1'";
   if (mysqli_query($conn, $sql)) { 
   echo "<script>window.location.href='profile?up';</script>";
 }
}
?>
