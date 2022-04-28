<?php
include_once("db_connect.php");
if(isset($_POST['newVideo'],$_COOKIE['photouser'])) {
	
$videoName = $_POST['videoName'];
$videoDate = $_POST['videoDate'];


$sql = "INSERT INTO video (videoName, videoDate)
VALUES ('$videoName', '$videoDate')";

if (mysqli_query($conn, $sql)) {
	$to = 'jakub.cieslik@fotohub.co.uk';
					$subject = "PhotoHub New Video";
					$txt = "This is message from PhotoHub.\nNew video has been added to PhotoHub.\n
					\nThank You\nPhotoHub";
					$headers = "From: jakub.cieslik@fotohub.co.uk";
					mail($to,$subject,$txt,$headers);
  header("Location: video");
} else {
  echo "Error: " . $sql . "<br>" . mysqli_error($conn);
}
mysqli_close($conn); 

}
?>