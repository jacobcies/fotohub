<?php 
$site = 'userbasket';
include('header.php');
include_once("db_connect.php");
?>
<style>
.img-album {
min-height: 120px;
background-color: transparent;
border-radius: 5px;
}
@media (max-width: 575.98px) {
	
    .card-img-top {
    height: 45vw;
    }
}
.fullscreen {
    background:transparent;
    border:0;
    width: 100% !important;
    height: 100% !important;
    margin: 0;
    top: 0;
    left: 0;
}
</style>

<?php include('container.php');?>

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
    <li class="breadcrumb-item"><a href="albums?all"><?php echo $lang['allalbums']; ?></a></li>
    <li class="breadcrumb-item"><a href="video?all"><?php echo $lang['allvideos']; ?></a></li>
    <li class="breadcrumb-item"><a href="basket?flush">Flush Basket</a></li>
   
   
  </ol>
</nav>
<form action="basketimg.php" method="POST">
<label>Zapisz koszyk</label>
<input type="text" name="basketimgName" class="form-control">
<input type="submit" name="updateName" value="Update">
</form>


<div class="row"> 

<?php
$videoDate = $_GET['videoDate'];
$photouser = $_COOKIE['photouser'];

$sql = "SELECT * FROM video,basket WHERE videoid=basketItem AND basketOwner='$photouser' ORDER BY videoDate DESC";
$result = mysqli_query($conn, $sql);
if ($result->num_rows > 0) {
while($row = mysqli_fetch_assoc($result)) {
	$post_date = $row['videoDate'];
$a = strtotime($post_date);
$new = date("d F Y", $a);
$year = date("Y",$a);
	?>

<div class="col-lg-3 col-6 mb-4">
<div class="card">


<div class="img-album"> 
<a class="spotlight" data-src-mp4="videos/<?php echo $row['videoUrl']; ?>" data-poster="videos/thumb/<?php echo $row['videoThumb']; ?>" data-preload="true" data-title="<?php echo $row['videoName']; ?>" data-media="video" data-description="<?php echo $new; ?>" data-play="true" data-preload="true">
  <img src="videos/thumb/<?php echo $row['videoThumb']; ?>" class="card-img-top" alt="" loading="lazy">
</a>
<div style="position: absolute;top: 3px; right: 0px;width: 40px; height: 40px;">
<form action="basket.php" method="POST">
<input type="hidden" name="basketid" value="<?php echo $row['basketid']; ?>">
<button class="btn btn-link link-light" type="submit" name="submit">
<svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-trash" viewBox="0 0 16 16">
  <path d="M5.5 5.5A.5.5 0 0 1 6 6v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5zm2.5 0a.5.5 0 0 1 .5.5v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5zm3 .5a.5.5 0 0 0-1 0v6a.5.5 0 0 0 1 0V6z"/>
  <path fill-rule="evenodd" d="M14.5 3a1 1 0 0 1-1 1H13v9a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V4h-.5a1 1 0 0 1-1-1V2a1 1 0 0 1 1-1H6a1 1 0 0 1 1-1h2a1 1 0 0 1 1 1h3.5a1 1 0 0 1 1 1v1zM4.118 4 4 4.059V13a1 1 0 0 0 1 1h6a1 1 0 0 0 1-1V4.059L11.882 4H4.118zM2.5 3V2h11v1h-11z"/>
</svg>
</button>
</form>
</div>

<?php
$userlevel = $_COOKIE['userlevel'];
if($userlevel == 5) { ?>
<div style="position: absolute;top: 15px; left: 15px;width: 40px; height: 40px;">
<a href="" data-bs-toggle="modal" data-bs-target="#VideoAction<?php echo $row['videoid']; ?>" title="Video Action"
style="padding: 6px 10px;font-weight: bold;background:rgba(0,0,0,0.5);color:#aaa;
border-radius: 50%;text-decoration: none;">
A
</a>
</div>
<?php } ?>
</div>
   
  <div class="card-body mt-1">
  <span class="badge bg-secondary float-end mt-1"><?php echo $year; ?></span>
    <p style="font-size: 15px;margin-bottom: 0;" class="card-title pt-1"><?php echo $row['videoName']; ?></p>
    <p style="font-size: 13px;margin-top: 0;color: #a1a1a1;" class="card-text"><?php echo $new; ?></p>
    
  </div>
</div>
</div>

<div class="modal fade" id="VideoAction<?php echo $row['videoid']; ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      
      <div class="modal-body p-5">
      <form action="basket.php" method="POST">
<input type="hidden" name="basketOwner" value="<?php echo $_COOKIE['photouser']; ?>">
<input type="hidden" name="basketItem" value="<?php echo $row['videoid']; ?>">
<input type="hidden" name="basketDate" value="<?php echo date('Y-m-d H:i:s'); ?>">
<input type="submit" class="btn btn-success" name="add_to_basket" value="Add to Basket">

      <h5 class="mt-3">Upload Thumbnail</h5>
      <form method="post" action="video_thumb_add.php" enctype="multipart/form-data"> 
      <input type="hidden" name="videoid" value="<?php echo $row['videoid']; ?>" >
<input class="form-control mt-5" type="file" name="image_upload[]" id="image_upload" >
<div class="mt-3"> 
<button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
        <input class="btn btn-primary" id="start" type="submit" name="upload" value="Upload">
        </div>
        </form>
        
        <div class="mt-3 border-top pt-3">
        <h5>Update Video</h5>
        <form method="post" action="video_update.php"> 
      <input type="hidden" name="videoid" value="<?php echo $row['videoid']; ?>" >
<input type="text" class="form-control mt-3" name="videoName" value="<?php echo $row['videoName']; ?>">
<input type="text" class="form-control mt-3" name="videoDate" value="<?php echo $row['videoDate']; ?>">
<label class="mt-3">Video Tags</label>
<input type="text" class="form-control" name="videoTags" value="<?php echo $row['videoTags']; ?>">
<div class="mt-3"> 

        <input class="btn btn-primary mt-3" id="start" type="submit" name="updateVideo" value="Update">
        </div>
        </form>
        </div>
        <div class="mt-4 border-top pt-5">
        
        <form action="delete_video.php" method="POST">
		<input type="hidden" name="videoid" value="<?php echo $row['videoid'];?>">
		<input type="submit" name="DeleteVideo" value="DeleteVideo" class="btn btn-danger" />    
    </form>
    </div>
      </div> 
      </div>
      
     </div>
    </div>

<?php }} else {
	echo '<div class="alert alert-warning alert-dismissible fade show me-5" role="alert">
  <strong>Upss...</strong> No any videos in the basket
  <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
</div>';
	} ?>

</div>

<!-- ------------------------images basket--------------------------- -->

<div class="row"> 

<?php
$photouser = $_COOKIE['photouser'];

$sql = "SELECT * FROM images,album,basketimg WHERE images.albumId=album.albumId AND images.id=basketimg.basketimgItem AND basketimg.basketimgOwner='$photouser' AND basketimg.basketimgName IS NULL ORDER BY images.photo_date ASC";
$result = mysqli_query($conn, $sql);
if (mysqli_num_rows($result) > 0) {
while($row = mysqli_fetch_assoc($result)) {
$post_date = $row['albumDate'];
$a = strtotime($post_date);
$year = date("Y", $a);
	?>
	
<div class="col-lg-3 col-6 mb-4">
<div class="card">


<div class="img-album"> 
<a class="spotlight" data-src-1200="<?php echo $row['albumUrl']; ?>/<?php echo $row['file_name']; ?>" data-title="<?php echo $row['photo_note']; ?>" data-download="true" data-description="<?php echo $row['photo_date']; ?>" data-play="true" data-preload="true">
  <img src="<?php echo $row['albumUrl']; ?>/<?php echo $row['file_name']; ?>" class="card-img-top" alt="" loading="lazy">
</a>
<div style="position: absolute;top: 3px; right: 0px;width: 40px; height: 40px;">
<form action="basketimg.php" method="POST">
<input type="hidden" name="basketimgid" value="<?php echo $row['basketimgid']; ?>">
<button class="btn btn-link link-light" type="submit" name="submit">
<svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-trash" viewBox="0 0 16 16">
  <path d="M5.5 5.5A.5.5 0 0 1 6 6v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5zm2.5 0a.5.5 0 0 1 .5.5v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5zm3 .5a.5.5 0 0 0-1 0v6a.5.5 0 0 0 1 0V6z"/>
  <path fill-rule="evenodd" d="M14.5 3a1 1 0 0 1-1 1H13v9a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V4h-.5a1 1 0 0 1-1-1V2a1 1 0 0 1 1-1H6a1 1 0 0 1 1-1h2a1 1 0 0 1 1 1h3.5a1 1 0 0 1 1 1v1zM4.118 4 4 4.059V13a1 1 0 0 0 1 1h6a1 1 0 0 0 1-1V4.059L11.882 4H4.118zM2.5 3V2h11v1h-11z"/>
</svg>
</button>
</form>
</div>

<?php
$userlevel = $_COOKIE['userlevel'];
if($userlevel == 5) { ?>
<div style="position: absolute;top: 15px; left: 15px;width: 40px; height: 40px;">
<a href="" data-bs-toggle="modal" data-bs-target="#VideoAction<?php echo $row['videoid']; ?>" title="Video Action"
style="padding: 6px 10px;font-weight: bold;background:rgba(0,0,0,0.5);color:#aaa;
border-radius: 50%;text-decoration: none;">
A
</a>
</div>
<?php } ?>
</div>
   
  <div class="card-body mt-1">
  <span class="badge bg-secondary float-end mt-1"><?php echo $year; ?></span>
  <a style="color: inherit;text-decoration: none;" href="photo-albumNumber-<?php echo $row['albumNumber']; ?>-albumDate-<?php echo $year; ?>">
    <p style="font-size: 15px;margin-bottom: 0;" class="card-title pt-1"><?php echo $row['albumName']; ?></p>
    </a>
    <p style="font-size: 13px;margin-top: 0;color: #a1a1a1;" class="card-text"><?php echo $new; ?></p>
    
  </div>
</div>
</div>

<div class="modal fade" id="VideoAction<?php echo $row['videoid']; ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      
      <div class="modal-body p-5">
      <form action="basket.php" method="POST">
<input type="hidden" name="basketOwner" value="<?php echo $_COOKIE['photouser']; ?>">
<input type="hidden" name="basketItem" value="<?php echo $row['videoid']; ?>">
<input type="hidden" name="basketDate" value="<?php echo date('Y-m-d H:i:s'); ?>">
<input type="submit" class="btn btn-success" name="add_to_basket" value="Add to Basket">

      <h5 class="mt-3">Upload Thumbnail</h5>
      <form method="post" action="video_thumb_add.php" enctype="multipart/form-data"> 
      <input type="hidden" name="videoid" value="<?php echo $row['videoid']; ?>" >
<input class="form-control mt-5" type="file" name="image_upload[]" id="image_upload" >
<div class="mt-3"> 
<button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
        <input class="btn btn-primary" id="start" type="submit" name="upload" value="Upload">
        </div>
        </form>
        
        <div class="mt-3 border-top pt-3">
        <h5>Update Video</h5>
        <form method="post" action="video_update.php"> 
      <input type="hidden" name="videoid" value="<?php echo $row['videoid']; ?>" >
<input type="text" class="form-control mt-3" name="videoName" value="<?php echo $row['videoName']; ?>">
<input type="text" class="form-control mt-3" name="videoDate" value="<?php echo $row['videoDate']; ?>">
<label class="mt-3">Video Tags</label>
<input type="text" class="form-control" name="videoTags" value="<?php echo $row['videoTags']; ?>">
<div class="mt-3"> 

        <input class="btn btn-primary mt-3" id="start" type="submit" name="updateVideo" value="Update">
        </div>
        </form>
        </div>
        <div class="mt-4 border-top pt-5">
        
        <form action="delete_video.php" method="POST">
		<input type="hidden" name="videoid" value="<?php echo $row['videoid'];?>">
		<input type="submit" name="DeleteVideo" value="DeleteVideo" class="btn btn-danger" />    
    </form>
    </div>
      </div> 
      </div>
      
     </div>
    </div>

<?php }} else {
	echo '<div class="alert alert-warning alert-dismissible fade show" role="alert">
  <strong>Upss...</strong> No any images in the basket
  <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
</div>';
	} ?>

</div>


</section>	
</div>
</div>
</div>

<?php include('footer.php');?>