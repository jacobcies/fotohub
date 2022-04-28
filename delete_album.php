<?php 
include_once("db_connect.php");
if(isset($_POST['deleteAlbum'],$_COOKIE['photouser']) && $_POST['deleteCode'] == 'DELETE ALBUM') {

$albumId = $_POST['albumId'];

$sql = "SELECT * FROM album WHERE albumId=$albumId";
$result = mysqli_query($conn, $sql);
$row = mysqli_fetch_assoc($result);
   $albumUrl = $row['albumUrl']; 
   $albumTumb = $row['albumTumb']; 
  
  array_map('unlink', glob("$albumTumb/*.*"));
  rmdir($albumTumb);
  array_map('unlink', glob("$albumUrl/*.*"));
  rmdir($albumUrl);
  
$sql = "SELECT * FROM images WHERE albumId=$albumId";
$result = mysqli_query($conn, $sql);
$treshold = mysqli_num_rows($result);

if($treshold>0) {  
$sql = "DELETE images,album FROM images INNER JOIN album ON images.albumId = album.albumId WHERE album.albumId=$albumId";
} else {
	$sql = "DELETE FROM album WHERE albumId=$albumId";
}

if (mysqli_query($conn, $sql)) {
	$to = $_COOKIE['photouser'];
					$subject = "PhotoHub Delete Album";
					$txt = "Message from PhotoHub.\nAlbum has been deleted from PhotoHub.
					\nThank You\nPhotoHub";
					$headers = $_COOKIE['photouser'];;
					mail($to,$subject,$txt,$headers);
 header("Location: albums");
 mysqli_close($conn);
} 
} else {
	header("Location: albums?msgDeleteAlbum");
	}

?>