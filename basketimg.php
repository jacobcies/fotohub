<?php
include_once("db_connect.php");
if(isset($_POST['basketimgItem'],$_COOKIE['photouser'])) {
	
$basketimgItem = $_POST['basketimgItem'];
$basketimgOwner = $_POST['basketimgOwner'];
$basketimgDate = $_POST['basketimgDate'];

$sql = "INSERT INTO basketimg (basketimgOwner, basketimgItem, basketimgDate)
VALUES ('$basketimgOwner', '$basketimgItem', '$basketimgDate')";

if (mysqli_query($conn, $sql)) {
  
} else {
  echo "Error: " . $sql . "<br>" . mysqli_error($conn);
}
}
// -------------- delete items from basket ------------------


if(isset($_POST['deleteoneItem'],$_COOKIE['photouser'])) {

$basketimgid = $_POST['basketimgid'];
$basketimgName = $_POST['basketimgName'];

$sql = "DELETE FROM basketimg WHERE basketimgid=$basketimgid";
if (mysqli_query($conn, $sql)) {
	if(!empty($basketimgName)) {
		header("Location: userbasket-".$basketimgName);
	} else {
	 header("Location: userbasket");
}
}
}

//---------------- update basket name --------------------

if(isset($_POST['updateName'],$_COOKIE['photouser'])) {

$photouser = $_COOKIE['photouser'];
$basketimgName = $_POST['basketimgName'];
$basketimgNameSelect = $_POST['basketimgNameSelect'];
if(!empty($basketimgName)) {
$sql = "UPDATE basketimg SET basketimgName='$basketimgName' WHERE basketimgOwner='$photouser' AND basketimgName IS NULL";
} else {
$sql = "UPDATE basketimg SET basketimgName='$basketimgNameSelect' WHERE basketimgOwner='$photouser' AND basketimgName IS NULL";	
}

if ($conn->query($sql) === TRUE) {
  header("Location: userbasket");
} else {
  echo "Error updating record: " . $conn->error;
}}

//----------------------Flush not saved basket ------------------------

if(isset($_POST['flushBasket'],$_COOKIE['photouser'])) {
	
$photouser = $_COOKIE['photouser'];

$sql = "DELETE FROM basketimg WHERE basketimgName IS NULL AND basketimgOwner = '$photouser'";
if (mysqli_query($conn, $sql)) {
	 header("Location: userbasket");
}}

//---------------------Delete saved basket -----------------------------

if(isset($_POST['deleteBasket'],$_COOKIE['photouser'])) {
	
$photouser = $_COOKIE['photouser'];
$basketimgName = $_POST['basketimgName'];

$sql = "DELETE FROM basketimg WHERE (basketimgName='$basketimgName' AND basketimgOwner = '$photouser')";
if (mysqli_query($conn, $sql)) {
	header("Location: userbasket");
} 

}