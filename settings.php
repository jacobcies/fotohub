<?php
if(!file_exists("db_connect.php")) {
	echo '<meta http-equiv="Refresh" content="0;url=/install">';
}
ob_start();
include_once("db_connect.php");

//set settings

$sql = "SELECT * FROM settings WHERE setid='1'";
$result = mysqli_query($conn, $sql);
while($row = mysqli_fetch_assoc($result)) {
  $setlogwallpaper = $row['setlogwallpaper'];
  $switchvideo = $row['switchvideo'];  
  $switchblog = $row['switchblog'];
  $sharepasswd = $row['sharepasswd'];
  $mapbox = $row['mapbox'];
  }
