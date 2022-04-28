<?php 
$site = 'video';
include('header.php');
include_once("db_connect.php");
$year = $_GET['videoDate'];
include('container.php');?>

<style>
.foto-side {
	height: 100%;
	top: 0px;
	right: 0px;
</style>

<div class="d-flex" id="wrapper">
<div class="bg-white" id="sidebar-wrapper" style="min-width: 240px;">
<?php include 'sidebar.php'; ?>
</div>
<div id="page-content-wrapper">
<div class="container-fluid mt-4">
<section class="Latest Video">
<nav aria-label="breadcrumb">
  <ol class="breadcrumb">
    <li class="breadcrumb-item"><a href="/"><?php echo $lang['home']; ?></a></li>
    <?php if(isset($_GET['videoDate'])) { ?>
    <li class="breadcrumb-item"><a href="video?all"><?php echo $lang['allvideos']; ?></a></li>
    <li class="breadcrumb-item active" aria-current="page"><?php echo $lang['videos']; ?> <?php echo $year; ?></li>
    <?php } else { ?>
    <li class="breadcrumb-item active" aria-current="page"><?php echo $lang['allvideos']; ?></li>
    <?php } ?>
   
  </ol>
</nav>
<section style="position: relative;">
<div class="row" > 
<?php
$videoDate = $_GET['videoDate'];
if(isset($videoDate)) {
$sql = "SELECT * FROM video WHERE YEAR(videoDate)='$videoDate' GROUP BY videoid ORDER BY videoDate DESC";	
} else {
$sql = "SELECT * FROM video ORDER BY videoDate DESC";
}
$result = mysqli_query($conn, $sql);
if ($result->num_rows > 0) {
while($row = mysqli_fetch_assoc($result)) {
	$post_date = $row['videoDate'];
$a = strtotime($post_date);
$new = date("d F Y", $a);
$year = date("Y",$a);
$month =date("F",$a);
	?>

<div class="col-lg-3 col-6 mb-4">
<div class="card">
<div class="img-album foto-box" style="position: relative;"> 
<a class="spotlight" data-src-mp4="videos/<?php echo $row['videoUrl']; ?>" data-poster="videos/thumb/<?php echo $row['videoThumb']; ?>" data-preload="true" data-title="<?php echo $row['videoName']; ?>" data-media="video" data-description="<?php echo $new; ?>" data-play="true" data-preload="true">
  <img src="videos/thumb/<?php echo $row['videoThumb']; ?>" class="card-img-top" alt="" loading="lazy">
</a>
  <?php $videoid = $row['videoid'];
$userlevel = $_COOKIE['userlevel'];
if($userlevel == 5) { ?>
<div class="foto-side">
<div class="foto-btn"> 
<a href="" data-bs-toggle="modal" data-bs-target="#VideoAction<?php echo $row['videoid']; ?>" title="Video Action"
style="line-height: 16px;text-decoration: none;">
<i class="fa-solid fa-gear pt-1"></i>
</a>
</div>
</div>
<?php } ?>
</div>
   
  <div class="card-body mt-1">
  <span class="badge bg-secondary float-end mt-1"><?php echo $month; ?></span>
    <p style="font-size: 15px;margin-bottom: 0;" class="card-title pt-1"><?php echo $row['videoName']; ?></p>
    <p style="font-size: 13px;margin-top: 0;color: #a1a1a1;" class="card-text"><?php echo $new; ?></p>
    
  </div>
</div>
</div>

<div class="modal fade" id="VideoAction<?php echo $row['videoid']; ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
     <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Update Video Info</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">X</button>
      </div> 
      <div class="modal-body p-5">
      
      <h5 class="mt-3">Upload Thumbnail</h5>
      <form method="post" action="video_thumb_add.php" enctype="multipart/form-data"> 
      <input type="hidden" name="videoid" value="<?php echo $row['videoid']; ?>" >
<input class="form-control mt-5" type="file" name="image_upload[]" id="image_upload" >
</div>
<div class="modal-header mt-3"> 
<button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
        <input class="btn btn-primary" id="start" type="submit" name="upload" value="Upload">
        </div>
        </form>
        
        <div class="modal-body p-5">
        <h5>Update Video</h5>
        <form method="post" action="video_update.php"> 
      <input type="hidden" name="videoid" value="<?php echo $row['videoid']; ?>" >
<input type="text" class="form-control mt-3" name="videoName" value="<?php echo $row['videoName']; ?>">
<input type="date" class="form-control mt-3" name="videoDate" value="<?php echo $row['videoDate']; ?>">
<label class="mt-3">Video Tags</label>
<input type="text" class="form-control" name="videoTags" value="<?php echo $row['videoTags']; ?>">
</div>
</div>
<div class="modal-header">

        <input class="btn btn-primary mt-3" id="start" type="submit" name="updateVideo" value="Update">
        
        </form>
        
       
        
        <form action="delete_video.php" method="POST">
		<input type="hidden" name="videoid" value="<?php echo $row['videoid'];?>">
		<input type="submit" name="DeleteVideo" value="DeleteVideo" class="btn btn-danger float-end" />    
    </form>
    </div>
    
      </div>
      
     </div>
    
 
<?php } ?>

<?php } else {
	echo 'No videos';
	} ?>

 
  
  
</div>
</section>	
</div>
</div>
</div>


<?php include('footer.php');?>