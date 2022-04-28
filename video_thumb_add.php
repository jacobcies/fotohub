<?php 
ob_start();

if(isset($_POST['upload'],$_COOKIE['photouser'])) {

include_once("db_connect.php");
		
//------------Upload images--------------------	

$upload_videos = array();
   $upload_dir = "videos/thumb/";
   
   foreach($_FILES['image_upload']['name'] as $key=>$val){ 
   
   	  
        $videoid = $_POST['videoid']; 
                
        $file_path = $upload_dir.$_FILES['image_upload']['name'][$key];
		  $filename = $_FILES['image_upload']['name'][$key];
		  
		  	 								  
		if(is_uploaded_file($_FILES['image_upload']['tmp_name'][$key])) {
						
			if(move_uploaded_file($_FILES['image_upload']['tmp_name'][$key],$file_path)){
				
				$upload_videos[] = $file_path;
								
				$sql = "UPDATE video SET videoThumb='$filename' WHERE videoid='$videoid'";
				if (mysqli_query($conn, $sql)) {
				
				}
			} 
		}
		header("Location: video?all");
    }

   
   
}
