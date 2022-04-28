<div class=" pt-4 pe-4 pb-4 bg-white sidebar">
    <ul class="nav nav-pills flex-column mb-auto">
    <li>
        <a href="/" class="nav-link link-dark <?php if($site=='home') echo 'active'; ?>">
          <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-house-door me-2" viewBox="0 0 16 16">
  <path d="M8.354 1.146a.5.5 0 0 0-.708 0l-6 6A.5.5 0 0 0 1.5 7.5v7a.5.5 0 0 0 .5.5h4.5a.5.5 0 0 0 .5-.5v-4h2v4a.5.5 0 0 0 .5.5H14a.5.5 0 0 0 .5-.5v-7a.5.5 0 0 0-.146-.354L13 5.793V2.5a.5.5 0 0 0-.5-.5h-1a.5.5 0 0 0-.5.5v1.293L8.354 1.146zM2.5 14V7.707l5.5-5.5 5.5 5.5V14H10v-4a.5.5 0 0 0-.5-.5h-3a.5.5 0 0 0-.5.5v4H2.5z"/>
</svg>
          <?php echo $lang['home']; ?>
        </a>
      </li> 
      
<li class="nav-item has-submenu">
		<a class="nav-link link-dark" href="">
		<svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-camera me-2" viewBox="0 0 16 16">
  <path d="M15 12a1 1 0 0 1-1 1H2a1 1 0 0 1-1-1V6a1 1 0 0 1 1-1h1.172a3 3 0 0 0 2.12-.879l.83-.828A1 1 0 0 1 6.827 3h2.344a1 1 0 0 1 .707.293l.828.828A3 3 0 0 0 12.828 5H14a1 1 0 0 1 1 1v6zM2 4a2 2 0 0 0-2 2v6a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V6a2 2 0 0 0-2-2h-1.172a2 2 0 0 1-1.414-.586l-.828-.828A2 2 0 0 0 9.172 2H6.828a2 2 0 0 0-1.414.586l-.828.828A2 2 0 0 1 3.172 4H2z"/>
  <path d="M8 11a2.5 2.5 0 1 1 0-5 2.5 2.5 0 0 1 0 5zm0 1a3.5 3.5 0 1 0 0-7 3.5 3.5 0 0 0 0 7zM3 6.5a.5.5 0 1 1-1 0 .5.5 0 0 1 1 0z"/>
</svg>
          <?php echo $lang['albums']; ?>
        </a>
		 
		<ul class="submenu collapse">
			<li><a class="nav-link link-dark <?php if(isset($_GET['all'])) {echo 'active';} ?>" href="albums?all">
			
			<?php echo $lang['all']; ?></a></li>
			
<?php
$sql = "SELECT albumDate,COUNT(albumId) as allAlbums FROM album GROUP BY YEAR(albumDate) ORDER BY YEAR(albumDate) DESC";
$result = mysqli_query($conn, $sql);
while($row = mysqli_fetch_assoc($result)) {
	$allAlbums = $row['allAlbums'];
$post_date = $row['albumDate'];
$a = strtotime($post_date);
$new = date("Y", $a);

	?>			
			
			<li><a class="nav-link link-dark <?php if($new==$_GET['albumDate']) {echo 'active';} ?>" href="albums-albumDate-<?php echo $new; ?>">
			
			<?php echo $new; ?> <span class="badge rounded-pill bg-secondary ms-2"><?php echo $allAlbums; ?></span></a></li>
			<?php } ?>
		</ul>
	</li>  
	
<?php if($switchvideo == 1) {} else { ?>	
	
<li class="nav-item has-submenu">
		<a class="nav-link link-dark" href="">
		<svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-camera-reels me-2" viewBox="0 0 16 16">
  <path d="M6 3a3 3 0 1 1-6 0 3 3 0 0 1 6 0zM1 3a2 2 0 1 0 4 0 2 2 0 0 0-4 0z"/>
  <path d="M9 6h.5a2 2 0 0 1 1.983 1.738l3.11-1.382A1 1 0 0 1 16 7.269v7.462a1 1 0 0 1-1.406.913l-3.111-1.382A2 2 0 0 1 9.5 16H2a2 2 0 0 1-2-2V8a2 2 0 0 1 2-2h7zm6 8.73V7.27l-3.5 1.555v4.35l3.5 1.556zM1 8v6a1 1 0 0 0 1 1h7.5a1 1 0 0 0 1-1V8a1 1 0 0 0-1-1H2a1 1 0 0 0-1 1z"/>
  <path d="M9 6a3 3 0 1 0 0-6 3 3 0 0 0 0 6zM7 3a2 2 0 1 1 4 0 2 2 0 0 1-4 0z"/>
</svg>
          <?php echo $lang['videos']; ?>
        </a>
		 
		<ul class="submenu collapse">
			<li><a class="nav-link link-dark <?php if(isset($_GET['all'])) {echo 'active';} ?>" href="video?all">
			
			<?php echo $lang['all']; ?></a></li>
			
<?php
$sql = "SELECT videoDate,COUNT(videoid) as allVideos FROM video GROUP BY YEAR(videoDate) ORDER BY YEAR(videoDate) DESC";
$result = mysqli_query($conn, $sql);
while($row = mysqli_fetch_assoc($result)) {
	$allVideos = $row['allVideos'];
$post_date = $row['videoDate'];
$a = strtotime($post_date);
$new = date("Y", $a);

	?>			
			
			<li><a class="nav-link link-dark <?php if($new==$_GET['videoDate']) {echo 'active';} ?>" href="video-videoDate-<?php echo $new; ?>">
			
			<?php echo $new; ?> <span class="badge rounded-pill bg-secondary ms-2"><?php echo $allVideos; ?></span></a></li>
			<?php } ?>
		</ul>
	</li> 
	<?php } ?>
	
<li class="nav-item has-submenu">
        <a href="userbasket" class="nav-link link-dark <?php if($site=='userbasket') echo 'active'; ?>">
          <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-cart me-2" viewBox="0 0 16 16">
  <path d="M0 1.5A.5.5 0 0 1 .5 1H2a.5.5 0 0 1 .485.379L2.89 3H14.5a.5.5 0 0 1 .491.592l-1.5 8A.5.5 0 0 1 13 12H4a.5.5 0 0 1-.491-.408L2.01 3.607 1.61 2H.5a.5.5 0 0 1-.5-.5zM3.102 4l1.313 7h8.17l1.313-7H3.102zM5 12a2 2 0 1 0 0 4 2 2 0 0 0 0-4zm7 0a2 2 0 1 0 0 4 2 2 0 0 0 0-4zm-7 1a1 1 0 1 1 0 2 1 1 0 0 1 0-2zm7 0a1 1 0 1 1 0 2 1 1 0 0 1 0-2z"/>
</svg>
          <?php echo $lang['basket']; ?>
        </a>
        <ul class="submenu collapse">
			<li><a class="nav-link link-dark <?php if(isset($_GET['all'])) {echo 'active';} ?>" href="userbasket">
			
			Not Saved</a></li>
			
<?php
$photouser = $_COOKIE['photouser'];
$sql = "SELECT * FROM basketimg WHERE basketimgOwner='$photouser' AND basketimgName IS NOT NULL GROUP BY basketimgName ORDER BY basketimgDate DESC";
$result = mysqli_query($conn, $sql);
while($row = mysqli_fetch_assoc($result)) {
?>			
			
			<li><a style="text-transform: capitalize;" class="nav-link link-dark <?php if($new==$_GET['albumDate']) {echo 'active';} ?>" 
			href="userbasket-<?php echo $row['basketimgName']; ?>">
			
			<?php echo $row['basketimgName']; ?></a></li>
			<?php } ?>
		</ul>
      </li> 	
	 	
	<!-- <?php if($userlevel == 5) { ?>  
	<li>
        <a href="favourite" class="nav-link link-dark">
          <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-heart me-2" viewBox="0 0 16 16">
  <path d="m8 2.748-.717-.737C5.6.281 2.514.878 1.4 3.053c-.523 1.023-.641 2.5.314 4.385.92 1.815 2.834 3.989 6.286 6.357 3.452-2.368 5.365-4.542 6.286-6.357.955-1.886.838-3.362.314-4.385C13.486.878 10.4.28 8.717 2.01L8 2.748zM8 15C-7.333 4.868 3.279-3.04 7.824 1.143c.06.055.119.112.176.171a3.12 3.12 0 0 1 .176-.17C12.72-3.042 23.333 4.867 8 15z"/>
</svg>
          <?php echo $lang['favourites']; ?>
        </a>
      </li>
      <?php } ?> -->
      
      <?php if($switchblog == 1) {} else { ?>
      <li>
        <a href="post" class="nav-link link-dark <?php if($site=='post') echo 'active'; ?>">
          <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-pencil-square me-2" viewBox="0 0 16 16">
  <path d="M15.502 1.94a.5.5 0 0 1 0 .706L14.459 3.69l-2-2L13.502.646a.5.5 0 0 1 .707 0l1.293 1.293zm-1.75 2.456-2-2L4.939 9.21a.5.5 0 0 0-.121.196l-.805 2.414a.25.25 0 0 0 .316.316l2.414-.805a.5.5 0 0 0 .196-.12l6.813-6.814z"/>
  <path fill-rule="evenodd" d="M1 13.5A1.5 1.5 0 0 0 2.5 15h11a1.5 1.5 0 0 0 1.5-1.5v-6a.5.5 0 0 0-1 0v6a.5.5 0 0 1-.5.5h-11a.5.5 0 0 1-.5-.5v-11a.5.5 0 0 1 .5-.5H9a.5.5 0 0 0 0-1H2.5A1.5 1.5 0 0 0 1 2.5v11z"/>
</svg>
          Blog
        </a>
      </li>  
      <?php } ?>
      <li>
        <a href="lastcomm" class="nav-link link-dark <?php if($site=='lastcomm') echo 'active'; ?>">
          <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-chat-left me-2" viewBox="0 0 16 16">
  <path d="M14 1a1 1 0 0 1 1 1v8a1 1 0 0 1-1 1H4.414A2 2 0 0 0 3 11.586l-2 2V2a1 1 0 0 1 1-1h12zM2 0a2 2 0 0 0-2 2v12.793a.5.5 0 0 0 .854.353l2.853-2.853A1 1 0 0 1 4.414 12H14a2 2 0 0 0 2-2V2a2 2 0 0 0-2-2H2z"/>
</svg>
          <?php echo $lang['comments']; ?>
        </a>
      </li>   
      
       
    <?php if($userlevel == 5) { ?>  
       <?php if($site=='album') { ?>
       <li>
        <a href="#" data-bs-toggle="modal" data-bs-target="#newPhotoAlbum" class="nav-link link-dark">
          <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-file-image me-2" viewBox="0 0 16 16">
  <path d="M8.002 5.5a1.5 1.5 0 1 1-3 0 1.5 1.5 0 0 1 3 0z"/>
  <path d="M12 0H4a2 2 0 0 0-2 2v12a2 2 0 0 0 2 2h8a2 2 0 0 0 2-2V2a2 2 0 0 0-2-2zM3 2a1 1 0 0 1 1-1h8a1 1 0 0 1 1 1v8l-2.083-2.083a.5.5 0 0 0-.76.063L8 11 5.835 9.7a.5.5 0 0 0-.611.076L3 12V2z"/>
</svg>
          New Album
        </a>
      </li>
      <?php } ?>
      
<?php if($site=='video') { ?>
       <li>
        <a href="#" data-bs-toggle="modal" data-bs-target="#newVideo" class="nav-link link-dark">
          <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-file-image me-2" viewBox="0 0 16 16">
  <path d="M8.002 5.5a1.5 1.5 0 1 1-3 0 1.5 1.5 0 0 1 3 0z"/>
  <path d="M12 0H4a2 2 0 0 0-2 2v12a2 2 0 0 0 2 2h8a2 2 0 0 0 2-2V2a2 2 0 0 0-2-2zM3 2a1 1 0 0 1 1-1h8a1 1 0 0 1 1 1v8l-2.083-2.083a.5.5 0 0 0-.76.063L8 11 5.835 9.7a.5.5 0 0 0-.611.076L3 12V2z"/>
</svg>
          New Video
        </a>
      </li>
      <?php } ?>      
      
      <?php if($site=='post') { ?>
      <li>
        <a href="#" data-bs-toggle="modal" data-bs-target="#uploadPost" class="nav-link link-dark">
          <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-sticky me-2" viewBox="0 0 16 16">
  <path d="M2.5 1A1.5 1.5 0 0 0 1 2.5v11A1.5 1.5 0 0 0 2.5 15h6.086a1.5 1.5 0 0 0 1.06-.44l4.915-4.914A1.5 1.5 0 0 0 15 8.586V2.5A1.5 1.5 0 0 0 13.5 1h-11zM2 2.5a.5.5 0 0 1 .5-.5h11a.5.5 0 0 1 .5.5V8H9.5A1.5 1.5 0 0 0 8 9.5V14H2.5a.5.5 0 0 1-.5-.5v-11zm7 11.293V9.5a.5.5 0 0 1 .5-.5h4.293L9 13.793z"/>
</svg>
          New Post
        </a>
      </li>
      <?php } }?>
      
     
      
   
    <hr>
    
    <?php
function folderSize ($dir)
{
    $size = 0;
    foreach (glob(rtrim($dir, '/').'/*', GLOB_NOSORT) as $each) {
        $size += is_file($each) ? filesize($each) : folderSize($each);
    }
    return $size;
}
function sizeFormat($bytes)
    {
        $label = array('B', 'KB', 'MB', 'GB', 'TB', 'PB');
        for ($i = 0; $bytes >= 1024 && $i < (count($label) - 1); $bytes /= 1024, $i++) ;
        return (round($bytes, 2) . " " . $label[$i]);
    }


$folder_name = "album";
$video_name = "videos";
$upchange = (folderSize($folder_name));
$vidchange = (folderSize($video_name));

$storage = ($upchange+$vidchange);
$uptotal = $storage*(0.00000001);

?>
<?php if($userlevel == 5) { ?>  
<p class="ps-3">
<svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-cloud me-2" viewBox="0 0 16 16">
  <path d="M4.406 3.342A5.53 5.53 0 0 1 8 2c2.69 0 4.923 2 5.166 4.579C14.758 6.804 16 8.137 16 9.773 16 11.569 14.502 13 12.687 13H3.781C1.708 13 0 11.366 0 9.318c0-1.763 1.266-3.223 2.942-3.593.143-.863.698-1.723 1.464-2.383zm.653.757c-.757.653-1.153 1.44-1.153 2.056v.448l-.445.049C2.064 6.805 1 7.952 1 9.318 1 10.785 2.23 12 3.781 12h8.906C13.98 12 15 10.988 15 9.773c0-1.216-1.02-2.228-2.313-2.228h-.5v-.5C12.188 4.825 10.328 3 8 3a4.53 4.53 0 0 0-2.941 1.1z"/>
</svg>
<?php echo $lang['storage']; ?></p>
<div class="progress mb-1 ms-3" style="height: 5px;">
  <div class="progress-bar" role="progressbar" style="height:5px; width: <?php echo $uptotal; ?>%" aria-valuenow="<?php echo $uptotal; ?>" aria-valuemin="0" aria-valuemax="50"></div>
</div>
<?php  
  
  echo '<small class="ms-3"><strong>'.sizeFormat(folderSize($folder_name)+folderSize($video_name)).' of 5 GB</strong></small>';
    
?><hr>
<?php } ?>

<?php 
        $user = $_COOKIE["photouser"];
        $sql = "SELECT * FROM users WHERE usemail='$user'";
		    $result = $conn->query($sql);
          while($row = $result->fetch_assoc()) { 
          	$userName = $row['userName'];
          	$userSurname = $row['userSurname'];
          	$userPhoto = $row['userPhoto'];
			}  
        ?>
        
        
<li class="nav-item has-submenu">
		<a class="nav-link link-dark" href="">
		<img src="<?php echo $userPhoto; ?>" alt="" width="32" height="32" class="rounded-circle me-2">
          <?php echo $userName; ?> <?php echo $userSurname; ?>
        </a>
		 
		<ul class="submenu collapse">
		<?php if($userlevel == 5) { ?>
		  <li><a class="nav-link link-dark" href="users">Users</a></li>
		  <?php } ?>
		  <li><a class="nav-link link-dark" href="profile"><?php echo $lang['profile']; ?></a></li>
        <li><hr class="dropdown-divider"></li>
        <li><a class="nav-link link-dark" href="logout"><?php echo $lang['signout']; ?></a></li>
       </ul>
       </li> 
        
    

 </div>
   </ul>
   
   
   <!-- Upload Modal -->



<!-- Post Modal -->
<script src="https://cdn.tiny.cloud/1/5o7ytwnt7lqr7fnypjz7z81oblxkb5t4kvohfyfiu22rakss/tinymce/5/tinymce.min.js" referrerpolicy="origin"></script>
<div class="modal fade" id="uploadPost" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">New Post</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">X</button>
      </div>
      <div class="modal-body p-5">
        <form method="post" action="post_upload.php">   
<div class="mb-3">
  <label for="exampleFormControlInput1" class="form-label">Photo</label>
  <input type="text" name="post_photo" class="form-control" id="exampleFormControlInput1" placeholder="Post Photo">
</div>
	<div class="mb-3">
  <label for="exampleFormControlInput1" class="form-label">Title</label>
  <input type="text" name="post_title" class="form-control" id="exampleFormControlInput1" placeholder="Post Title">
</div>
<div class="mb-3">
  <label for="exampleFormControlTextarea1" class="form-label">Body</label>
  <textarea class="form-control" name="post_body" id="exampleFormControlTextarea1" rows="3"></textarea>
</div>
</div>
<div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
        <input class="btn btn-primary" type="submit" value="Submit">
      </div>
      </form>
</div>
</div>
</div>


<!-- New Album Modal -->

<div class="modal fade" id="newPhotoAlbum" tabindex="-1" aria-labelledby="newPhotoAlbumLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">New Album</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">X</button>
      </div>
      <div class="modal-body p-5">
        <form method="post" action="album_upload.php">   

	<div class="mb-3">
  <label for="exampleFormControlInput1" class="form-label">Title</label>
  <input type="text" name="albumName" class="form-control" id="exampleFormControlInput1" placeholder="Album Name">
</div>
<div class="mb-3">
  <label for="exampleFormControlTextarea1" class="form-label">Description</label>
  <textarea class="form-control" name="albumDesc" id="exampleFormControlTextarea1" rows="3"></textarea>
</div>
      </div>
      <div class="modal-footer p-5">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
        <input class="btn btn-primary" type="submit" name="newAlbum" value="Submit">
      </div>
      </form>
    </div>
  </div>
</div>

<!-- New Video -->
<div class="modal fade" id="newVideo" tabindex="-1" aria-labelledby="newPhotoAlbumLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">New Video</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">X</button>
      </div>
      <div class="modal-body p-5">
      
     
      
      
        <form method="post" action="video_add.php" enctype="multipart/form-data">   
<input class="form-control mt-5" type="file" name="videos_upload[]" id="video_upload"> 
	<div class="mb-3">
  <label for="exampleFormControlInput1" class="form-label">Title</label>
  <input type="text" name="videoName" class="form-control" id="exampleFormControlInput1" placeholder="Video Name">
</div>
<div class="mb-3">
  <label for="exampleFormControlTextarea1" class="form-label">Video Date</label>
  <input type="date" name="videoDate" class="form-control" id="exampleFormControlInput1" placeholder="Video Thumb">
</div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
        <input class="btn btn-primary" id="start" type="submit" name="upload" value="Upload">
      </div>
      </form>
    
    <div class="progress" style="height: 55px;">
  <div class="progress-bar progress-bar-striped" role="progressbar" style="width: 0%;height: 55px" aria-valuenow="0" aria-valuemin="0" aria-valuemax="100"></div>
</div>
</div>
<script>
var start = document.getElementById('start'),
    reset = document.getElementById('reset'),
    stop = document.getElementById('stop'),
    current_progress = 0,
    step = 0.5; // the smaller this is the slower the progress bar

start.onclick = function(){
    interval = setInterval(function() {
        current_progress += step;
        progress = Math.round(Math.atan(current_progress) / (Math.PI / 2) * 100 * 1000) / 1000
        $(".progress-bar")
            .css("width", progress + "%")
            .attr("aria-valuenow", progress)
            .text(progress + "%");
        if (progress >= 100){
            clearInterval(interval);
        }else if(progress >= 70) {
            step = 0.1
        }
    }, 100);
}

stop.onClick = function(){
    $(".progress-bar").css("width","100%").attr("aria-valuenow", 100).text("100% Complete");
    clearInterval(interval); // Important to stop the progress bar from increasing
}
/* Stop button */
reset.onclick = function() {
    $(".progress-bar").css("width","0%").attr("aria-valuenow", 0);
    clearInterval(interval);
}

</script>
  </div>
</div>


