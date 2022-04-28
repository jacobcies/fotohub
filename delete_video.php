<?php 
include_once("db_connect.php");

if(isset($_POST['DeleteVideo'],$_COOKIE['photouser'])) {

$videoid = $_POST['videoid'];

$sql = "SELECT * FROM video WHERE videoid=$videoid";
$result = mysqli_query($conn, $sql);
while($row = mysqli_fetch_assoc($result)) {
   $videoUrl = $row['videoUrl'];
   $videoThumb = $row['videoThumb']; 
   }

$vfile = 'videos/'.$videoUrl;
unlink($vfile);
$vtumb = 'videos/thumb/'.$videoThumb;
unlink($vtumb);


$sql = "DELETE FROM video WHERE videoid=$videoid";

if (mysqli_query($conn, $sql)) {
 header("Location: video?all");
 
} 
} else {
	echo 'Fuck off';
}

?>