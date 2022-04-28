<?php 
session_start();
include 'settings.php';
$albumNumber = $_GET['albumNumber'];
if(isset($_POST['submitpasswd'])) {
	$albumNumber = $_POST['albumNumber'];
   
   if($_POST['guestpasswd'] == $sharepasswd) {
   $_SESSION['valid'] = true;
   $_SESSION['timeout'] = time();
   $_SESSION['photoguest'] = 'guest';
header('Refresh: 0; URL = shared-albumNumber-'.$albumNumber);
} else {
	header('Location: ' . $_SERVER['HTTP_REFERER']);
	}	
} 



$site = 'shared';

include_once("db_connect.php");
?>
<!DOCTYPE html>
<html>
<head>
<meta name=robots content=noindex>
<meta name=viewport content="width=device-width, initial-scale=1">
<meta http-equiv=Content-Type content="text/html; charset=utf-8" />
<title>Photo Album</title>
<link rel="shortcut icon" href=assets/img/ico.png />
<link href=https://api.mapbox.com/mapbox-gl-js/v2.6.1/mapbox-gl.css rel=stylesheet>
<script src=https://api.mapbox.com/mapbox-gl-js/v2.6.1/mapbox-gl.js></script>
<link rel=stylesheet href=https://api.mapbox.com/mapbox-gl-js/plugins/mapbox-gl-geocoder/v4.7.0/mapbox-gl-geocoder.css type=text/css />
<link href=https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css rel=stylesheet integrity=sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC crossorigin=anonymous>
<script src=https://ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js></script>
<script src=https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js integrity=sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM crossorigin=anonymous></script>
<script src=http://malsup.github.com/jquery.form.js></script>
<script type=text/javascript src=scripts/jquery_upload.js></script>
<script src=assets/spotlight.bundle.js></script>
<link type=text/css rel=stylesheet href=sidebar.css />
<link rel=preconnect href=https://fonts.googleapis.com>
<link rel=preconnect href=https://fonts.gstatic.com crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Raleway:wght@500&display=swap" rel=stylesheet>
<style>.bd-placeholder-img{font-size:1.125rem;text-anchor:middle;-webkit-user-select:none;-moz-user-select:none;user-select:none}.card-img-top{width:100%;height:22vw;object-fit:cover;border-radius:0}@media(min-width:768px){.bd-placeholder-img-lg{font-size:3.5rem}}.modal-dialog{max-width:800px}body{margin:0;padding:0}.h-90{height:80%!important}@media(max-width:575.98px){.card-img-top{height:85vw}.albumname{width:100%;text-align:center;padding:0}.albumdesc{width:100%;text-align:center;margin:0 auto;padding:0}}h4.enter{font-family:'Raleway',sans-serif;font-size:25px;line-height:40px}</style>
<script type=text/javascript src=http://ajax.googleapis.com/ajax/libs/jquery/1.7.2/jquery.min.js></script>
<script type=text/javascript>$(document).ready(function(){$("body").on("contextmenu",function(a){return false});$("#id").on("contextmenu",function(a){return false})});</script>
<div class="container-fluid mt-4" style=min-height:500px>
<section class=photos>
<?php if(!isset($_SESSION["photoguest"])){ ?>
<div class="container d-flex align-items-center justify-content-center">
<div class="col-lg-3 text-center">
<div class=mt-5>
<h4 class=enter>Witaj, podaj hasło</h4>
</div>
<form action=shared method=POST autocomplete=off>
<div class="mb-3 mt-5">
<input type=hidden name=albumNumber value=<?php echo $albumNumber; ?>>
<input type=password class=form-control name=guestpasswd />
</div>
<div class=mb-3>
<input type=submit name=submitpasswd class="btn btn-secondary w-100" value=Login>
</div>
</form>

</div>
</div>
<?php } else { ?>
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
	?>
<div class="row pb-4 mb-3">
<div class="col-lg-2 text-center border-end">
<?php $post_date = $row['albumDate'];
$a = strtotime($post_date);
$day = date("l", $a);
$date = date("d", $a);
$month = date("F Y", $a);
echo '<small style="color:#555;">'.$day.'</small>';
echo '<br>';
echo '<h1 class="mb-0 pb-0">'.$date.'</h1>';
echo $month;
?>
</div>
<div class="col-lg-6 ps-lg-5">
<h1 class="pt-2 albumname"><?php echo $row['albumName']; ?></h1>
<span class=albumdesc><?php echo $row['albumDesc']; ?>
<?php if(!empty($albumLat)) { ?>
&nbsp;&bull;
<a href=# class=link-dark style=text-decoration:none data-bs-toggle=offcanvas data-bs-target=#offcanvasBottom aria-controls=offcanvasBottom>Map</a>
<?php } ?></span>
</div>
</div>
</section>
<div class="offcanvas offcanvas-top h-90" tabindex=-1 id=offcanvasBottom aria-labelledby=offcanvasBottomLabel>
<div class=offcanvas-header>
<h5 class=offcanvas-title id=offcanvasBottomLabel>Map</h5>
<button type=button class="btn-close text-reset" data-bs-dismiss=offcanvas aria-label=Close></button>
</div>
<div class="offcanvas-body small">
<div id=map style=width:100%;height:500px></div>
<script>mapboxgl.accessToken="<?php echo $mapbox; ?>";const map=new mapboxgl.Map({container:"map",style:"mapbox://styles/mapbox/streets-v11",center:[<?php echo $albumLng; ?>,<?php echo $albumLat; ?>],zoom:<?php echo $albumZoom; ?>});const marker=new mapboxgl.Marker().setLngLat([<?php echo $albumLng; ?>,<?php echo $albumLat; ?>]).addTo(map);map.addControl(new mapboxgl.NavigationControl());</script>
</div>
</div>
<section style=position:relative>
<div class="row">
<?php
$sql = "SELECT * FROM album
INNER JOIN images ON images.albumId=album.albumId 
WHERE images.albumId='$albumId' ORDER BY images.photo_date ASC";
$result = mysqli_query($conn, $sql);
if (mysqli_num_rows($result) > 0) {
while($row = mysqli_fetch_assoc($result)) {
$post_date = $row['albumDate'];
$a = strtotime($post_date);
$year = date("Y", $a);
	?>
<div class="col-lg-4 m-0 p-1" style="position:relative">
<a class="spotlight" href=<?php echo $row['albumUrl']; ?>/<?php echo $row['file_name']; ?> data-play="true" data-preload="true" data-download="true">
<img src=<?php echo $row['albumUrl']; ?>/<?php echo $row['file_name']; ?> alt class=card-img-top>
</a>
</div>
<?php    
  }
} else {
  echo "Can't find any photos.";
}
mysqli_close($conn);
?>
</div>
</section>
<div class=insert-post-ads1 style=padding-top:20px;padding-bottom:20px>
</div>
</div>
<?php } ?>
<?php include('footer.php');?>
