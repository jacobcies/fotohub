 <?php 
ob_start();
session_start();
if(!isset($_COOKIE["userCode"], $_COOKIE['photouser'])){
echo "<script>window.location.href='login.php';</script>";
}
date_default_timezone_set('Europe/London');
include 'settings.php';
?>
<!DOCTYPE html>
<html>
<head>
<meta name="robots" content="noindex">
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<?php $albumDate = $_GET['albumDate']; ?>
<?php if($site=='home') {echo '<title>PhotoHub</title>';} ?>
<?php if($site=='album') {echo '<title>Albums '.$albumDate.' | PhotoHub</title>';} ?>
<?php if($site=='post') {echo '<title>Blog | PhotoHub</title>';} ?>
<?php if($site=='photo') {echo '<title>Photo | PhotoHub</title>';} ?>
<?php if($site=='search') {echo '<title>Search | PhotoHub</title>';} ?>
<?php if($site=='users') {echo '<title>Users | PhotoHub</title>';} ?>
<?php if($site=='profile') {echo '<title>Profile | PhotoHub</title>';} ?>
<?php if($site=='video') {echo '<title>Video | PhotoHub</title>';} ?>
<?php if($site=='userbasket') {echo '<title>Basket | PhotoHub</title>';} ?>
<?php if($site=='comments') {echo '<title>Comments | PhotoHub</title>';} ?>
<?php if($site=='lastcomm') {echo '<title>Latest Comments | PhotoHub</title>';} ?>

<link rel="shortcut icon" href="assets/img/ico.png" />
<link href="https://api.mapbox.com/mapbox-gl-js/v2.6.1/mapbox-gl.css" rel="stylesheet">
<script src="https://api.mapbox.com/mapbox-gl-js/v2.6.1/mapbox-gl.js"></script>
<link rel="stylesheet" href="https://api.mapbox.com/mapbox-gl-js/plugins/mapbox-gl-geocoder/v4.7.0/mapbox-gl-geocoder.css" type="text/css" />
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
<script src="https://malsup.github.io/jquery.form.js"></script>
<script src="https://kit.fontawesome.com/7782457704.js" crossorigin="anonymous"></script>
<script src="assets/spotlight.bundle.js" defer></script>
<link type="text/css" rel="stylesheet" href="assets/css/sidebar.css" />
<?php if($site=='photo') {} else { ?>
<link type="text/css" rel="stylesheet" href="assets/css/sidebar1.css" />
<?php } ?>
<link type="text/css" rel="stylesheet" href="assets/css/style.css" />
<script> 
$(document).ready(function () {
    $("body").on("contextmenu",function(e){
        return false;
    });
    $("#id").on("contextmenu",function(e){
        return false;
    });
});
</script>
<script> 
document.addEventListener("DOMContentLoaded", function(){
  document.querySelectorAll('.sidebar .nav-link').forEach(function(element){
    
    element.addEventListener('click', function (e) {

      let nextEl = element.nextElementSibling;
      let parentEl  = element.parentElement;	

        if(nextEl) {
            e.preventDefault();	
            let mycollapse = new bootstrap.Collapse(nextEl);
            
            if(nextEl.classList.contains('show')){
              mycollapse.hide();
            } else {
                mycollapse.show();
                var opened_submenu = parentEl.parentElement.querySelector('.submenu.show');
                if(opened_submenu){
                  new bootstrap.Collapse(opened_submenu);
                }
            }
        }
    }); 
  }) 
});     
</script>  

