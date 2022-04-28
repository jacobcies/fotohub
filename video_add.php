<?php 
ob_start();

if(isset($_POST['upload'],$_COOKIE['photouser'])) {

include_once("db_connect.php");
		
//------------Upload images--------------------	

$upload_videos = array();
   $upload_dir = "videos/";
   
   foreach($_FILES['videos_upload']['name'] as $key=>$val){ 
   
   	  
        $videoName = $_POST['videoName']; 
        $videoDate = $_POST['videoDate'];
        
        $file_path = $upload_dir.$_FILES['videos_upload']['name'][$key];
		  $filename = $_FILES['videos_upload']['name'][$key];
		  
		  	 								  
		if(is_uploaded_file($_FILES['videos_upload']['tmp_name'][$key])) {
						
			if(move_uploaded_file($_FILES['videos_upload']['tmp_name'][$key],$file_path)){
				
				$upload_videos[] = $file_path;
								
				$insert_sql = "INSERT INTO video(videoName,videoUrl,videoDate) 
					VALUES('".$videoName."','".$filename."','".$videoDate."')";
				mysqli_query($conn, $insert_sql) or die("database error: ". mysqli_error($conn));
			} 
		}
		header("Location: video?all");
    }

   
   
}
