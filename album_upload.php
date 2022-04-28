<?php

include_once("db_connect.php");
if(isset($_POST['newAlbum'],$_COOKIE['photouser'])) {
session_start();	
$albumName = $_POST['albumName'];
$albumDesc = $_POST['albumDesc'];
$albumNum = rand(111111,999999);
$albumNumber = md5($albumNum);
$albumDate = date('Y-m-d');
$albumCover = "assets/img/tmp-cover.jpeg";
$albumTags = "";

$str = $albumName;
$str = str_replace(' ', '', $str);
$str = str_replace('/', '-', $str);
 

$albumUrl = 'album/'.$str;
$albumTumb = 'album/'.$str.'/tumb';

$folderName = 'album/'.$str;
		$config['upload_path'] = $folderName;
		if(!is_dir($folderName))
		{
			mkdir($folderName, 0775);
		}
		
$tumbName = 'album/'.$str.'/tumb';
		$config['upload_path'] = $tumbName;
		if(!is_dir($tumbName))
		{
			mkdir($tumbName, 0775);
		}
	

$sql = "INSERT INTO album (albumName, albumDesc, albumDate, albumUrl, albumTumb,albumNumber,albumCover,albumTags)
VALUES ('$albumName', '$albumDesc', '$albumDate', '$albumUrl', '$albumTumb','$albumNumber','$albumCover','$albumTags')";

if (mysqli_query($conn, $sql)) {
	$to = $_COOKIE['photouser'];
					$subject = "PhotoHub New Album";
					$txt = "Message from PhotoHub.\nAlbum ".$albumName." has been added to PhotoHub.
					\nThank You\nPhotoHub";
					$headers = $_COOKIE['photouser'];
					mail($to,$subject,$txt,$headers);
	
					
  header("Location: albums");
} else {
  echo "Error: " . $sql . "<br>" . mysqli_error($conn);
}
mysqli_close($conn);

}