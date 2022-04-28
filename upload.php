<?php
 
 include_once("db_connect.php");
 $albumId = $_POST['albumId']; 
$uploadDir = 'uploads';
 
 
if (!empty($_FILES) && isset($_COOKIE['photouser'])) {
	
//-----------Select album info-----------------


$sql = "SELECT * FROM album WHERE albumId = $albumId";
$result = mysqli_query($conn, $sql);
while($row = mysqli_fetch_assoc($result)) 
{
$albumUrl = $row['albumUrl'];
$albumTumb = $row['albumTumb'];	
$albumNumber = $row['albumNumber'];
}	
	
	

        $photo_note = "";
        $photo_fav = 0;	
	
 $tmpFile = $_FILES['file']['tmp_name'];
 $file_name = $_FILES['file']['name'];
 $filename = $uploadDir.'/'.$file_name;
  move_uploaded_file($tmpFile,$filename);
 
  $exif = exif_read_data($filename, 0, true);
 $photo_date = $exif["IFD0"]["DateTime"];	
 		      		      
		      $insert_sql = "INSERT INTO images(albumId,file_name,photo_date,photo_note,photo_fav) 
					VALUES('".$albumId."','".$file_name."','".$photo_date."','".$photo_note."','".$photo_fav."')";
				mysqli_query($conn, $insert_sql) or die("database error: ". mysqli_error($conn));

include 'resize.php';

//---------Delete updated original images-------------

$folder_path = "uploads";
$files = glob($folder_path.'/*'); 
foreach($files as $file) {
    if(is_file($file)) 
    unlink($file); 
}


}
 
 
?>