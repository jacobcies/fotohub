<?php 
//download as a zip php

 if(isset($_POST['createAlbum']))  
 {  
 
      $post = $_POST;   
      $file_folder = ""; // folder to load files  
      if(extension_loaded('zip'))  
      {   
           // Checking ZIP extension is available  
           if(isset($post['files']) and count($post['files']) > 0)  
           {   
           
                // Checking files are selected  
                $zip = new ZipArchive(); // Load zip library   
                $zip_name = "photohub.zip";           // Zip name  
                if($zip->open($zip_name, ZipArchive::CREATE)!==TRUE)  
                {   
                     // Opening zip file to load files  
                     $error .= "* Sorry ZIP creation failed at this time";  
                }  
                foreach($post['files'] as $file)  
                {   
                   $zip->addFile($file_folder.$file); // Adding files into zip  
                }  
                $zip->close();  
                if(file_exists($zip_name))  
                {  
                     // push to download the zip  
                     header('Content-type: application/zip');  
                     header('Content-Disposition: attachment; filename="'.$zip_name.'"');  
                     readfile($zip_name);  
                     // remove zip file is exists in temp path  
                     unlink($zip_name);  
                }  
           }  
           else  
           {  
                $error .= "* Please select file to zip ";  
           }  
      }  
      else  
      {  
           $error .= "* You dont have ZIP extension";  
      }  
 }

$site = 'photo';
$albumNumber = $_GET['albumNumber'];
$albumDate = $_GET['albumDate'];
include('header.php');
include_once("db_connect.php");
include('container.php');
?>

<a href="#" class="scrollToTop">
<svg xmlns="http://www.w3.org/2000/svg" width="50" height="50" fill="currentColor" class="bi bi-arrow-up-square" viewBox="0 0 16 16">
  <path fill-rule="evenodd" d="M15 2a1 1 0 0 0-1-1H2a1 1 0 0 0-1 1v12a1 1 0 0 0 1 1h12a1 1 0 0 0 1-1V2zM0 2a2 2 0 0 1 2-2h12a2 2 0 0 1 2 2v12a2 2 0 0 1-2 2H2a2 2 0 0 1-2-2V2zm8.5 9.5a.5.5 0 0 1-1 0V5.707L5.354 7.854a.5.5 0 1 1-.708-.708l3-3a.5.5 0 0 1 .708 0l3 3a.5.5 0 0 1-.708.708L8.5 5.707V11.5z"/>
</svg>
</a>
<script>
$(document).ready(function(){
    
    //Check to see if the window is top if not then display button
    $(window).scroll(function(){
        if ($(this).scrollTop() > 100) {
            $('.scrollToTop').fadeIn();
        } else {
            $('.scrollToTop').fadeOut();
        }
    });
    
    //Click event to scroll to top
    $('.scrollToTop').click(function(){
        $('html, body').animate({scrollTop : 0},800);
        return false;
    });
    
});
</script>

<div class="container-fluid mt-4" style="min-height: 500px;">

<section class="photos">
<div class="col-lg-12"> 
<?php
$sql = "SELECT * FROM album WHERE albumNumber='$albumNumber'";
$result = mysqli_query($conn, $sql);
$row = mysqli_fetch_assoc($result);
	$albumId = $row['albumId'];
	$albumName = $row['albumName'];
	$albumDesc = $row['albumDesc'];
	$albumNumber = $row['albumNumber'];
	$albumDate = $row['albumDate'];
	$albumTags = $row['albumTags'];
	$albumLat = $row['albumLat'];
	$albumLng = $row['albumLng'];
	$albumZoom = $row['albumZoom'];
	$albumBlog = $row['albumBlog'];
	
	$post_date = $row['albumDate'];
$a = strtotime($post_date);
$day = date("l", $a);
$date = date("d", $a);
$month = date("F Y", $a);
$year = date("Y", $a);
	?>
	
<div class="row pb-4 mb-3 border-bottom">
<div class="col-lg-2 text-center border-end">
<?php
echo '<small>'.$day.'</small>';
echo '<br>';
echo '<h1 class="mb-0 pb-0" style="font-weight:900;">'.$date.'</h1>';
echo $month;
?>
</div>
<div class="col-lg-6 ps-5">
<h1 class="pt-2" style="font-weight: 700;"><?php echo $row['albumName']; ?></h1>
<div style="display: inline;"> 
<?php echo $row['albumDesc']; ?> 
<?php if(!empty($albumLat)) { ?>
&bull; 
<a href="#" class="link-dark" style="text-decoration: none;" data-bs-toggle="offcanvas" data-bs-target="#offcanvasBottom" aria-controls="offcanvasBottom"><?php echo $lang['map']; ?></a>
<?php } ?>  
<?php if(!empty($albumBlog)) { ?>      
        &bull; 
<a class="link-dark" style="text-decoration: none;" href="<?php echo $row['albumBlog']; ?>">Blog</a>
<?php } ?>
</div>
</div>
</div>	

<nav aria-label="breadcrumb" class="pb-2 ps-5 pt-1">
  <ol class="breadcrumb">
    <li class="breadcrumb-item"><a href="/"><?php echo $lang['home']; ?></a></li>
    <li class="breadcrumb-item"><a href="albums?all"><?php echo $lang['allalbums']; ?></a></li>
    <li class="breadcrumb-item"><a href="albums-albumDate-<?php echo $year; ?>"><?php echo $lang['albums']; ?> <?php echo $year; ?></a></li>
    <li class="breadcrumb-item active" aria-current="page"><?php echo $albumName; ?></li>
  </ol>
</nav>
</div>
</section>

<!-- Modal Map -->
<div class="offcanvas offcanvas-top h-90" tabindex="-1" id="offcanvasBottom" aria-labelledby="offcanvasBottomLabel">
  <div class="offcanvas-header">
    <h5 class="offcanvas-title" id="offcanvasBottomLabel"><?php echo $lang['map']; ?> </h5>
    <button type="button" class="btn-close text-reset" data-bs-dismiss="offcanvas" aria-label="Close"></button>
  </div>
  <div class="offcanvas-body small">
     
       <div id="map" style="width: 100%;height: 500px;"></div>
<script>
	mapboxgl.accessToken = '<?php echo $mapbox; ?>';

const map = new mapboxgl.Map({
container: 'map', // container ID
style: 'mapbox://styles/mapbox/streets-v11', // style URL
center: [<?php echo $albumLng; ?>, <?php echo $albumLat; ?>], // starting position
zoom: <?php echo $albumZoom; ?> // starting zoom
});

const marker = new mapboxgl.Marker() // Initialize a new marker
.setLngLat([<?php echo $albumLng; ?>, <?php echo $albumLat; ?>]) // Marker [lng, lat] coordinates
.addTo(map); // Add the marker to the map
 
// Add zoom and rotation controls to the map.
map.addControl(new mapboxgl.NavigationControl());
</script>
      </div>
      
    </div>
  
<section class="photoalbum" style="position: relative;">
<div class="row"> 
<?php
$rows = array();
$sql = "SELECT * FROM album
INNER JOIN images ON images.albumId=album.albumId 
WHERE images.albumId='$albumId' ORDER BY images.photo_date ASC";
$result = mysqli_query($conn, $sql);
while($row = mysqli_fetch_assoc($result)) {
$post_date = $row['albumDate'];
$a = strtotime($post_date);
$year = date("Y", $a);
	?>
		<div class="col-lg-4 col-6 p-1 foto-box" style="position: relative;"> 
<a class="spotlight" data-src-1200="<?php echo $row['albumUrl']; ?>/<?php echo $row['file_name']; ?>" data-title="<?php echo $row['photo_note']; ?>" data-download="true" data-description="<?php echo $row['photo_date']; ?>" data-play="true" data-preload="true">
  <img src="<?php echo $row['albumUrl']; ?>/<?php echo $row['file_name']; ?>" class="card-img-top" alt="" loading="lazy">
</a>
<?php $id = $row['id']; ?>
<div class="result<?php echo $id; ?> bg-warning text-light m-3" style="position: absolute;bottom: 15px;right:50px;"></div>

<div class="foto-side">
<!-- img to basket -->
<div class="foto-btn"> 
<form method="post" action="" id="contactform">
<input type="hidden" name="basketimgOwner" id="basketimgOwner<?php echo $id; ?>" value="<?php echo $_COOKIE['photouser']; ?>">
<input type="hidden" name="basketimgItem" id="basketimgItem<?php echo $id; ?>" value="<?php echo $id; ?>">
<input type="hidden" name="basketimgDate" id="basketimgDate<?php echo $id; ?>" value="<?php echo date('Y-m-d H:i:s'); ?>">
<button type="submit" class="btn btn-link shadow-none add-basket<?php echo $id; ?> link-light" title="Add image to the basket.">
<i class="fa-solid fa-cart-shopping"></i> 
</button>
</form>

<script>
  $(document).ready(function () {
    $('.add-basket<?php echo $id; ?>').click(function (e) {
      e.preventDefault();
      var basketimgOwner = $('#basketimgOwner<?php echo $id; ?>').val();
      var basketimgItem = $('#basketimgItem<?php echo $id; ?>').val();
      var basketimgDate = $('#basketimgDate<?php echo $id; ?>').val();
      $.ajax
        ({
          type: "POST",
          url: "basketimg.php",
          data: { "basketimgOwner": basketimgOwner, "basketimgItem": basketimgItem, "basketimgDate": basketimgDate },
          success: function (data) {
            $('.result<?php echo $id; ?>').html("&nbsp;&nbsp;Added to the basket&nbsp;&nbsp;");
            $('#contactform')[0].reset();
          }
        });
    });
  });
</script> 
</div>

<!-- img comments -->

<div class="foto-btn"> 
<a href="comments?id=<?php echo $row['id']; ?>" class="btn btn-link shadow-none" style="color: #fff;line-height: 16px;" title="Add new comment">
 <div class="position-relative">   
  <i class="fa-solid fa-comment"></i>
  <span class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-danger">
    <?php echo $row['comCount']; ?>
    </span>
  </div>
</a>
</div>

<?php
$userlevel = $_COOKIE['userlevel'];
if($userlevel == 5) { ?>

<div class="foto-btn"> 
<a href="" data-bs-toggle="modal" class="btn btn-link shadow-none" data-bs-target="#PhotoAction<?php echo $row['id']; ?>" title="Photo Action" 
style="line-height: 16px;text-decoration: none;">
<i class="fa-solid fa-gear pt-1"></i>
</a>
</div>
<div class="foto-btn">
<a href="" data-bs-toggle="modal" class="btn btn-link shadow-none" data-bs-target="#DeletePhoto<?php echo $row['id']; ?>" title="Photo Action" 
style="line-height: 16px;text-decoration: none;">
<i class="fa-solid fa-trash pt-2"></i>
</a>
</div>
<?php } ?>
</ul>
</div>

</div>


<!-- Delete from image -->
<div class="modal fade" id="DeletePhoto<?php echo $row['id']; ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
   <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
       <h5 class="modal-title text-center" id="exampleModalLabel">Delete Photo</h5>    
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">X</button>
      </div>
      
<form action="delete_photo.php" method="POST">
		<input type="hidden" name="id" value="<?php echo $row['id'];?>">
		<input type="hidden" name="albumNumber" value="<?php echo $row['albumNumber']; ?>">
        <input type="hidden" name="albumDate" value="<?php echo $year; ?>">
		<input type="hidden" name="delete" value="del1975">
		
		<div class="modal-footer px-5">
		<input type="submit" name="submit" class="btn btn-danger" value="Delete Photo" />    
    </form>
    </div>
    </div> 
    </div>
    </div>
   

<!-- Modal Action Photo-->
<div class="modal fade" id="PhotoAction<?php echo $row['id']; ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header border-0">
        <h5 class="modal-title text-center" id="exampleModalLabel">Take an Action</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">X</button>
      </div>
      <div class="modal-body">
      
      <div class="row m-action pb-5"> 
      <p id="msg"></p>
      <div class="col-lg-6 offset-lg-1 border-end pe-5">
      <img src="<?php echo $row['albumUrl']; ?>/<?php echo $row['file_name']; ?>" class="img-fluid" alt="">
      
      <p class="mt-3 pb-0 mb-0">Image Name</p>
      <small><?php echo $row['file_name']; ?></small>
      
      
      <p class="pt-3 pb-0 mb-0">Album Name</p>
      <small><?php echo $row['albumName']; ?></small>
     
      
      <p class="pt-3 pb-0 mb-0">Album URL</p>
      <small><?php echo $row['albumUrl']; ?>/<?php echo $row['file_name']; ?></small>
      
      
      <p class="pt-3 pb-0 mb-0">Image Made</p>
      <small><?php echo $row['photo_date']; ?></small>
      
      </div>
      <div class="col-lg-4 ps-4 pe-4"> 
      
<div class="row pt-3 mb-5">
    <div class="col-lg-12">
    <p class="mt-1 m-link pb-1">Photo description</p>
    <form method="POST" action="update_note.php">
    <input type="hidden" name="id" value="<?php echo $row['id'];?>" />
    <input type="hidden" name="albumNumber" value="<?php echo $row['albumNumber'];?>" />
    <input type="hidden" name="albumDate" value="<?php echo $year; ?>">
    <input type="text" name="photo_note" class="form-control" value="<?php echo $row['photo_note'];?>" placeholder="eg.Edinburgh Castle" />
    <input type="submit" name="update_note" value="Submit" class="btn btn-sm btn-primary mt-3" style="background-color: #999;color: #fff;" />
    </form>
    </div>
    </div>   
    
    <div class="row">
    <div class="col-lg-12">
    <form action="update_cover.php" method="POST">
		<input type="hidden" name="albumId" value="<?php echo $row['albumId']; ?>">
		<input type="hidden" name="albumUrl" value="<?php echo $row['albumUrl']; ?>">
		<input type="hidden" name="file_name" value="<?php echo $row['file_name']; ?>">
        <input type="hidden" name="albumDate" value="<?php echo $year; ?>">
		<input type="hidden" name="albumNumber" value="<?php echo $row['albumNumber']; ?>">
		<input type="submit" name="submit" 
		style="border:0;background: none;padding: 0;text-decoration: none;color: #222;font-size: 14px;" 
		value="Use as album cover" />    
    </form>
    
    </div>
    </div>
   
    <div class="row mt-3">
    <div class="col-lg-12">
    
    <form action="delete_photo.php" method="POST">
		<input type="hidden" name="id" value="<?php echo $row['id'];?>">
		<input type="hidden" name="albumNumber" value="<?php echo $row['albumNumber']; ?>">
        <input type="hidden" name="albumDate" value="<?php echo $year; ?>">
		<input type="hidden" name="delete" value="del1975">
		<input type="submit" name="submit" 
		style="border:0;background: none;padding: 0;text-decoration: none;color: #222;font-size: 14px;" 
		value="Delete Photo" />    
    </form>
    
    </div>
    </div> 
    </div>
    </div>
    </div>
    </div>
  </div>
</div>




<!-- Share Album Modal -->
<div class="modal fade" id="sharePhotoToAlbum" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" style="border:0;">
    <div class="modal-content">
    <div class="modal-header border-0">
         <h5>Share Album</h5>    
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">X</button>
      </div>
    <div class="modal-body p-5">
 
 <form action="email.php" method="POST">       

<input type="email" name="emailaddr" class="form-control" placeholder="myfriend@email.com">
<input type="hidden" name="albumNumber" value="<?php echo $row['albumNumber']; ?>">
<input type="hidden" name="albumName" value="<?php echo $row['albumName']; ?>">
<input type="hidden" name="albumDesc" value="<?php echo $row['albumDesc']; ?>">
<input type="hidden" name="albumCover" value="<?php echo $row['albumCover']; ?>">
<input type="hidden" name="albumDate" value="<?php echo $row['albumDate']; ?>">
</div>
<div class="modal-footer px-5">
<input type="submit" name="sendaddr" class="btn btn-secondary mt-3" value="Send to Friend">
</form>
      </div>
      <div class="mt-3 text-center"> 
        <p>Enter the email of the person you want to send the photo album to.<br>The password to the album is <?php echo $sharepasswd; ?>. </p>
      </div>
    </div>
  </div>
</div>






<!-- end of database -->
<?php 
$albumName = $row['albumName'];
} ?>
</div>
</section>

<!-- Download full album as ZIP -->
<div class="modal fade" id="downloadPhotoToAlbum" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" style="border:0;">
    <div class="modal-content">
    <div class="modal-header border-0">
         <h5>Download Album</h5>    
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">X</button>
      </div>
    <div class="modal-body p-5">
 <div class="mt-3 text-center"> 
        <p class="text-muted m-0 p-0">Download album</p><h1 class="m-0 p-0" style="font-weight: 700;"><?php echo $albumName; ?></h1> 
        
      </div>
 <form name="zips" action="" method="post" enctype="multipart/form-data"> 
 <?php
$sql = "SELECT * FROM album
INNER JOIN images ON images.albumId=album.albumId 
WHERE images.albumId='$albumId' ORDER BY images.photo_date ASC";
$result = mysqli_query($conn, $sql);
while($row = mysqli_fetch_assoc($result)) {
?> 
<input type="hidden" checked name="files[]" value="<?php echo $row['albumUrl']; ?>/<?php echo $row['file_name']; ?>" /> 
<?php } ?> 
</div>
<div class="modal-footer px-5">
<input type="submit" class="btn btn-secondary mt-3" name="createAlbum" value="Download Album" />
</div>
</form> 
      </div>
      
    </div>
  </div>


<!-- Upload Modal -->
<script src="https://unpkg.com/dropzone@5/dist/min/dropzone.min.js"></script>
<link rel="stylesheet" href="https://unpkg.com/dropzone@5/dist/min/dropzone.min.css" type="text/css" />

<div class="modal fade" id="uploadPhotoToAlbum" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-xl">
    <div class="modal-content" style="border:0;background-color: #ffffff;">
      <div class="modal-header" style="border:0;">
         <h5><?php echo $lang['uploadphotos']; ?></h5>      
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">X</button>
      </div>
      <div class="modal-body mb-5 pb-5">
      <div class="container">
  <div class="row">
    <div class="col-md-12">
      
      <form enctype="multipart/form-data" class="dropzone" style="border:0;" id="image-upload">
      <input type="hidden" name="albumId" value="<?php echo $albumId; ?>">
      <div class="dz-message">
      <h1 style="color: #a5b1b8 !important;font-size: 60px;"><i class="fa-solid fa-cloud-arrow-up"></i></h1>
        <h3>Drop images to upload</h3>
        <p style="color: #a5b1b8 !important;">or click to pick manually</p>
    </div>
        <div></div>
        
      </form>
      <!-- <button class="btn btn-success mt-3" id="uploadFile">Upload Files</button> -->
    </div>
  </div>
</div>
   
<script type="text/javascript">
   
    Dropzone.autoDiscover = false;
   
    var myDropzone = new Dropzone(".dropzone", { 
    	 url: 'upload.php',
       autoProcessQueue: true,
       parallelUploads: 1,
       maxFilesize: 5,
       acceptedFiles: "image/*",
       init: function () {
        	this.on('queuecomplete', function () {
        	location.reload();
        }, 30000);
    }       
    });
   
    $('#uploadFile').click(function(){
       myDropzone.processQueue();
    });
       
</script>
      
      

      </div>
  </div>
</div>
</div>



<!-- Update Album Modal -->
<div class="modal fade" id="updatePhotoToAlbum" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header border-0">
         <h5>Update Album Info</h5>      
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">X</button>
      </div>
      <div class="modal-body p-5">
        

<form method="POST" action="update_album.php"> 
<div class="mb-3"> 
<input type="hidden" name="albumId" value="<?php echo $albumId; ?>">
<input type="hidden" name="albumNumber" value="<?php echo $albumNumber; ?>">
<label>Album Name</label>
<input name="albumName" class="form-control" style="width:100%" type="text" value="<?php echo $albumName; ?>">
</div>
<div class="mb-3"> 
<label>Album Description</label>
<input name="albumDesc" class="form-control" style="width:100%" type="text" value="<?php echo $albumDesc; ?>">
</div>
<div class="mb-3"> 
<label>Album Date</label>
<input type="date" name="albumDate" class="form-control" style="width:100%" type="text" value="<?php echo $albumDate; ?>">
</div>
<div class="row mb-3"> 
<div class="col-lg-4"> 
<label>Album Latitude</label>
<input name="albumLat" class="form-control" style="width:100%" type="text" value="<?php echo $albumLat; ?>">
</div>
<div class="col-lg-4"> 
<label>Album Longitude</label>
<input name="albumLng" class="form-control" style="width:100%" type="text" value="<?php echo $albumLng; ?>">
</div>
<div class="col-lg-4">
<label>Album Zoom</label> 
<input name="albumZoom" class="form-control" style="width:100%" type="text" value="<?php echo $albumZoom; ?>">
</div>
</div>
<div class="mb-3"> 
<label>Album Tags</label>
<input name="albumTags" class="form-control" style="width:100%" placeholder="album tags" type="text" value="<?php echo $albumTags; ?>">
</div>
<div class="mb-3"> 
<label>Album Blog URL</label>
<input name="albumBlog" class="form-control" style="width:100%" placeholder="album blog" type="text" value="<?php echo $albumBlog; ?>">
</div>
</div>
<div class="modal-footer px-5">
<button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
<input type="submit" name="updateAlbum" value="Update" class="btn btn-primary">
</form>
      </div>
      
    
    </div>
  </div>
</div>

<!-- Delete Album Modal -->
<div class="modal fade" id="deletePhotoToAlbum" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
     <div class="modal-header">
         <h5>Delete Album</h5>      
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">X</button>
      </div> 
      <div class="modal-body p-5">
   

<form method="POST" action="delete_album.php" autocomplete="off">
<div class="mt-3"> 
<input type="text" name="deleteCode" class="form-control" placeholder="DELETE ALBUM">
</div>
<input type="hidden" name="albumId" value="<?php echo $albumId; ?>">
</div>
<div class="modal-footer px-5">
<button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
<input type="submit" class="btn btn-danger" value="Delete" name="deleteAlbum"> 
</div>

<div class="mt-3 text-center"> 
<p>To delete album please enter text DELETE ALBUM. All photos from album will be deleted.</p>
</div>
</form>

      </div>
      
    
    </div>
  </div>
</div>
<script>
function myFunction() {
  /* Get the text field */
  var copyText = document.getElementById("myInput");

  /* Select the text field */
  copyText.select();
  copyText.setSelectionRange(0, 99999); /* For mobile devices */

   /* Copy the text inside the text field */
  navigator.clipboard.writeText(copyText.value);

  /* Alert the copied text */
  alert("Copied the text: " + copyText.value);
} 
</script>

<?php include('footer.php');?>


