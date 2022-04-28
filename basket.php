<?php
include_once("db_connect.php");
if(isset($_POST['basketItem'],$_COOKIE['photouser'])) {
	
$basketItem = $_POST['basketItem'];
$basketOwner = $_POST['basketOwner'];
$basketDate = $_POST['basketDate'];

$sql = "INSERT INTO basket (basketOwner, basketItem, basketDate)
VALUES ('$basketOwner', '$basketItem', '$basketDate')";

if (mysqli_query($conn, $sql)) {
  
} else {
  echo "Error: " . $sql . "<br>" . mysqli_error($conn);
}
}

if(isset($_POST['basketid'],$_COOKIE['photouser'])) {

$basketid = $_POST['basketid'];
$sql = "DELETE FROM basket WHERE basketid=$basketid";
if (mysqli_query($conn, $sql)) {
	 header("Location: userbasket");
} 

}

if(isset($_GET['flush'],$_COOKIE['photouser'])) {
	
$photouser = $_COOKIE['photouser'];

$sql = "DELETE basket, basketimg FROM basket LEFT JOIN basketimg ON basket.basketOwner = basketimgOwner WHERE basket.basketOwner = '$photouser';";
if (mysqli_query($conn, $sql)) {
	 header("Location: userbasket");
} 

}