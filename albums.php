<?php 
$site = 'album';
include('header.php');
include_once("db_connect.php");
$year = $_GET['albumDate'];
include('container.php');?>
<div class="d-flex" id="wrapper">
<div class="bg-white" id="sidebar-wrapper" style="min-width: 240px;">
<?php include 'sidebar.php'; ?>
</div>
<div id="page-content-wrapper">

<?php if(isset($_GET['msgDeleteAlbum'])) { ?>
	<script>
		window.onload = (event) => {
  let myAlert = document.querySelectorAll('.toast')[0];
  if (myAlert) {
    let bsAlert = new bootstrap.Toast(myAlert);
    bsAlert.show();
  }
};	
	</script>
	<div class="toast" role="alert" aria-live="assertive" aria-atomic="true"
	 style="position: absolute;bottom: 40px;right: 40px;z-index: 9999;" >
  <div class="toast-header">
    
    <strong class="me-auto">Delete Album</strong>
    
    <button type="button" class="btn-close" data-bs-dismiss="toast" aria-label="Close"></button>
  </div>
  <div class="toast-body" style="background-color: #fff;">
    No permission to delete album.
  </div>
</div>
	
<?php }
?>

<div class="container-fluid mt-4">
<section class="Latest Albums">
<nav aria-label="breadcrumb">
  <ol class="breadcrumb">
    <li class="breadcrumb-item"><a href="/"><?php echo $lang['home']; ?></a></li>
    <?php if(isset($_GET['albumDate'])) { ?>
    <li class="breadcrumb-item"><a href="albums?all"><?php echo $lang['allalbums']; ?></a></li>
    <li class="breadcrumb-item active" aria-current="page"><?php echo $lang['albums']; ?> <?php echo $year; ?></li>
    <?php } else { ?>
    <li class="breadcrumb-item active" aria-current="page"><a href="albums?all"><?php echo $lang['allalbums']; ?></a></li>
    <?php } ?>
  </ol>
</nav>
<div class="row">

<?php
$albumDate = $_GET['albumDate'];
if(isset($albumDate)) {
$sql = "SELECT *,COUNT(id) AS total FROM album LEFT JOIN images ON images.albumId=album.albumId WHERE YEAR(albumDate)='$albumDate' GROUP BY album.albumId ORDER BY album.albumDate DESC";
} else {
$sql = "SELECT *,COUNT(id) AS total FROM album LEFT JOIN images ON images.albumId=album.albumId GROUP BY album.albumId ORDER BY album.albumDate DESC";
}
$result = mysqli_query($conn, $sql);
if ($result->num_rows > 0) {
while($row = mysqli_fetch_assoc($result)) {
$post_date = $row['albumDate'];
$a = strtotime($post_date);
$new = date("l, d F Y", $a);
$year = date("Y", $a);
$month = date("F",$a);
$short = date("M Y",$a);
?>
<div class="col-lg-3 col-6 mb-4">
<div class="card">

<a href="photo-albumNumber-<?php echo $row['albumNumber']; ?>-albumDate-<?php echo $year; ?>">
<div class="img-album"> 
  <img src="<?php echo $row['albumCover']; ?>" class="card-img-top" alt="">
   </div></a>
  <div class="card-body mt-1">
  <span class="badge bg-danger float-end mt-1"><?php echo $short; ?></span>
    <p style="font-size: 15px;margin-bottom: 0;" class="card-title pt-1"><?php echo $row['albumName']; ?></p>
    
    <p style="font-size: 13px;margin-top: 0;color: #a1a1a1;" class="card-text"><?php echo $row['total']; ?> <?php echo $lang['items']; ?>
    </p>
    
  </div>
</div>
</div>
<?php }
} else { ?>
  <div class="d-flex justify-content-center align-items-center">
	<svg xmlns="http://www.w3.org/2000/svg" width="36" height="36" fill="currentColor" class="bi bi-journal-album" viewBox="0 0 16 16">
  <path d="M5.5 4a.5.5 0 0 0-.5.5v5a.5.5 0 0 0 .5.5h5a.5.5 0 0 0 .5-.5v-5a.5.5 0 0 0-.5-.5h-5zm1 7a.5.5 0 0 0 0 1h3a.5.5 0 0 0 0-1h-3z"/>
  <path d="M3 0h10a2 2 0 0 1 2 2v12a2 2 0 0 1-2 2H3a2 2 0 0 1-2-2v-1h1v1a1 1 0 0 0 1 1h10a1 1 0 0 0 1-1V2a1 1 0 0 0-1-1H3a1 1 0 0 0-1 1v1H1V2a2 2 0 0 1 2-2z"/>
  <path d="M1 5v-.5a.5.5 0 0 1 1 0V5h.5a.5.5 0 0 1 0 1h-2a.5.5 0 0 1 0-1H1zm0 3v-.5a.5.5 0 0 1 1 0V8h.5a.5.5 0 0 1 0 1h-2a.5.5 0 0 1 0-1H1zm0 3v-.5a.5.5 0 0 1 1 0v.5h.5a.5.5 0 0 1 0 1h-2a.5.5 0 0 1 0-1H1z"/>
</svg>
</div>
<div class="d-flex justify-content-center align-items-center mt-5">
  <p>There are no albums to show</p></div>
<?php
}
$conn->close(); ?>
</div>
</section>	
</div>
</div>
</div>
<?php include('footer.php');?>
