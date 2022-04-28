<?php 
   $site = 'home';
   include('header.php');
   include('container.php');?>
   <style>
		.custom-tooltip.tooltip > .tooltip-inner
{
    text-align: center;
    width: 200px;
    position: absolute;
    bottom: 20px;
    left: -100px;
    background-color: none;
    background-color: transparent;
    }
   .tooltip-arrow {
  display: none;
  visibility: hidden;
}
.custom-tooltip.tooltip > .tooltip-inner span
{ font-weight: 700;
font-size: 16px;
}
.imghover {
  position: relative;
  }

.overlay {
  position: absolute;
  top: 0;
  bottom: 0;
  left: 0;
  right: 0;
  height: 100%;
  width: 100%;
  opacity: 0;
  transition: .5s ease;
  background-color: rgba(0,0,0,0.5);
  border-radius: 10px;
}

.imghover:hover .overlay {
  opacity: 1;
}

.text {
  color: white;
  font-size: 20px;
  position: absolute;
  top: 50%;
  left: 50%;
  -webkit-transform: translate(-50%, -50%);
  -ms-transform: translate(-50%, -50%);
  transform: translate(-50%, -50%);
  text-align: center;
}


.section-title, .section-title2 {
  margin-bottom: 28px;
}
.section-title h5 {
	font-size: 16px;
	color: #9ca3af !important
}
.link-hover-underline {
	text-decoration: none;
	display: inline-block;
color: #fb2905;

}
i {
	color: #fb2905;
	transition: .5s;
}
.link-hover-underline:hover {
	color: #fb2905;
}
.link-hover-underline:hover i {
	transform: translateX(.5rem);
	color: #fb2905;
}
</style>
 
<div class="d-flex" id="wrapper">
   <div class="bg-white" id="sidebar-wrapper" style="min-width: 240px;">
      <?php include 'sidebar.php'; ?>
   </div>
   <div id="page-content-wrapper">
      <div class="container-fluid mt-4">
		<div class="col-12" style="position: relative;">
		<?php
		if(file_exists("install/db-install.php")) { ?>
	<div class="alert alert-warning alert-dismissible fade show" role="alert">
  <strong>Warning!</strong> Please delete /install folder.
  <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
</div>
<?php } ?>
	
		<div class="section-title">
      <h5 class="text-uppercase font-weight-bold position-relative float-start pb-2" style="font-weight:700;">
         <?php echo $lang['latestalbums']; ?></h5>
        <p><a style="float:right; color: #555;text-decoration: none;font-size: 13px;" href="albums"><?php echo $lang['more']; ?> >></a></p>
      </div>
		<div class="clearfix"></div>
		
            <a class="btn mb-3 mr-1"
               style="position: absolute;top: 35%;left:0;z-index: 9999;color: rgba(255,255,255,0.5);font-size: 50px;"
               data-bs-target="#carouselExampleIndicators2" data-bs-slide="prev">
               <svg xmlns="http://www.w3.org/2000/svg" width="50" height="50" fill="currentColor" class="bi bi-chevron-compact-left" viewBox="0 0 16 16">
                  <path fill-rule="evenodd" d="M9.224 1.553a.5.5 0 0 1 .223.67L6.56 8l2.888 5.776a.5.5 0 1 1-.894.448l-3-6a.5.5 0 0 1 0-.448l3-6a.5.5 0 0 1 .67-.223z"/>
               </svg>
            </a>
            <a class="btn mb-3"
               style="position: absolute;top: 35%;right:0;z-index: 9999;color: rgba(255,255,255,0.5);font-size: 50px;"            
               data-bs-target="#carouselExampleIndicators2" data-bs-slide="next">
               <svg xmlns="http://www.w3.org/2000/svg" width="50" height="50" fill="currentColor" class="bi bi-chevron-compact-right" viewBox="0 0 16 16">
                  <path fill-rule="evenodd" d="M6.776 1.553a.5.5 0 0 1 .671.223l3 6a.5.5 0 0 1 0 .448l-3 6a.5.5 0 1 1-.894-.448L9.44 8 6.553 2.224a.5.5 0 0 1 .223-.671z"/>
               </svg>
            </a>
            <div id="carouselExampleIndicators2" class="carousel slide" data-bs-interval="10000" data-bs-ride="carousel">
               <div class="carousel-inner">
                  <div class="carousel-item active">
                     <div class="row">
                        <?php
                           $sql = "SELECT *,COUNT(id) AS total FROM album,images WHERE album.albumId=images.albumId GROUP BY album.albumId ORDER BY upload_time DESC LIMIT 4";
                           $result = mysqli_query($conn, $sql);
                           if (mysqli_num_rows($result) > 0) {
                           while($row = mysqli_fetch_assoc($result)) {
                           $post_date = $row['albumDate'];
                           $a = strtotime($post_date);
                           $new = date("l, d F Y", $a);
                           $year = date('Y', $a);   
                           $short = date('M Y',$a);  
                           	?>
                        <div class="col-lg-3 col-6">
                           <div class="card">
                              <a href="photo-albumNumber-<?php echo $row['albumNumber']; ?>-albumDate-<?php echo $year; ?>">
                              <img src="<?php echo $row['albumCover']; ?>" class="card-img-top" alt="">
                              </a>
                              <div class="card-body mt-1">
                              <span class="badge bg-danger float-end mt-1"><?php echo $short; ?></span>
                                 <p style="font-size: 15px;margin-bottom: 0;" class="card-title pt-1"><?php echo $row['albumName']; ?></p>
                                 <p style="font-size: 13px;margin-top: 0;color: #a1a1a1;" class="card-text"><?php echo $row['total']; ?> <?php echo $lang['items']; ?></p>
                              </div>
                           </div>
                        </div>
                        <?php    
                           }
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
                           <?php }
                           ?>
                     </div>
                  </div>
 <?php                 
$sql = "SELECT *,COUNT(albumId) AS total FROM album";
$result = mysqli_query($conn, $sql);
if (mysqli_num_rows($result) < 5) {} else {
?>
                  <div class="carousel-item">
                     <div class="row">
                        <?php
                           $sql = "SELECT *,COUNT(id) AS total FROM album,images WHERE album.albumId=images.albumId GROUP BY album.albumId ORDER BY upload_time DESC LIMIT 4 OFFSET 4";
                           $result = mysqli_query($conn, $sql);
                           if (mysqli_num_rows($result) > 0) {
                           while($row = mysqli_fetch_assoc($result)) {
                           $post_date = $row['albumDate'];
                           $a = strtotime($post_date);
                           $new = date("l, d F Y", $a);
                           $year = date('Y', $a); 
                           $short = date('M Y',$a);                           
                           	?>
                        <div class="col-lg-3 col-6">
                           <div class="card">
                              <a href="photo-albumNumber-<?php echo $row['albumNumber']; ?>-albumDate-<?php echo $year; ?>">
                              <img src="<?php echo $row['albumCover']; ?>" class="card-img-top" alt="">
                              </a>
                              <div class="card-body mt-1">
                               <span class="badge bg-danger float-end mt-1"><?php echo $short; ?></span>
                                 <p style="font-size: 15px;margin-bottom: 0;" class="card-title pt-1"><?php echo $row['albumName']; ?></p>
                                 <p style="font-size: 13px;margin-top: 0;color: #a1a1a1;" class="card-text"><?php echo $row['total']; ?> <?php echo $lang['items']; ?></p>
                              </div>
                           </div>
                        </div>
                        <?php    
                           }
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
                           <?php }
                           ?>
                     </div>
                  </div>
                  <?php } ?>
               </div>
            </div>
         </div>
 
<!-- photo instruction --> 

<?php if($_COOKIE['userlevel'] <> 5) {} else { ?>
<div class="row justify-content-around mt-5 mb-5">
            <!--Feature column-->
            <div class="col-12 col-md-6 col-xl-3 mb-7 mb-xl-0" data-aos="fade-up" data-aos-delay="100">
              <div class="text-center">
              <div
                  class="mb-4 position-relative display-3 fw-normal text-primary">
                  <i class="fa-solid fa-images"></i>
                </div>
                <h5 class="mb-3"><?php echo $lang['createphotoalbum']; ?></h5>
                <p class="mb-3 px-lg-2">
                  Lorem ipsum is placeholder text commonly used in the graphic, print, and publishing
                  industries for layouts and visual mockups.
                </p>
                <a href="" data-bs-toggle="modal" data-bs-target="#newPhotoAlbum" class="link-hover-underline small fw-semibold">
                  <?php echo $lang['newalbum']; ?><i class="fa-solid fa-arrow-right ms-2"></i>
                </a>
                
              </div>
            </div>

            <!--Feature column-->
            <div class="col-12 col-md-6 col-xl-3 mb-7 mb-xl-0" data-aos="fade-up" data-aos-delay="150">
              <div class="text-center">
                <div
                  class="mb-4 position-relative display-3 fw-normal text-primary">
                  <i class="fa-solid fa-upload"></i>
                </div>
                <h5 class="mb-3"><?php echo $lang['uploadphotos']; ?></h5>
                <p class="mb-3 px-lg-2">
                  Lorem ipsum is placeholder text commonly used in the graphic, print, and publishing
                  industries for layouts and visual mockups.
                </p>
                <a href="albums?all" class="link-hover-underline small fw-semibold">
                  <?php echo $lang['gotoalbums']; ?><i class="fa-solid fa-arrow-right ms-2"></i>
                </a>
              </div>
            </div>

            <!--Feature column-->
            <div class="col-12 col-md-6 col-xl-3 mb-7 mb-md-0" data-aos="fade-up" data-aos-delay="200">
              <div class="text-center">
                <div
                  class="mb-4 position-relative display-3 fw-normal text-primary">
                  <i class="fa-solid fa-bars-progress"></i>
                </div>
                <h5 class="mb-3"><?php echo $lang['managephotos']; ?></h5>
                <p class="mb-3 px-lg-2">
                  Lorem ipsum is placeholder text commonly used in the graphic, print, and publishing
                  industries for layouts and visual mockups.
                </p>
                <a href="#!" class="link-hover-underline small fw-semibold">
                  <?php echo $lang['gotoalbums']; ?><i class="fa-solid fa-arrow-right ms-2"></i>
                </a>
              </div>
            </div>
            <!--Feature column-->
            <div class="col-12 col-md-6 col-xl-3" data-aos="fade-up" data-aos-delay="250">
              <div class="text-center">
                <div
                  class="mb-4 position-relative display-3 fw-normal text-primary">
                  <i class="fa-solid fa-share-nodes"></i>
                </div>
                <h5 class="mb-3"><?php echo $lang['sharephotos']; ?></h5>
                <p class="mb-3 px-lg-2">
                  Lorem ipsum is placeholder text commonly used in the graphic, print, and publishing
                  industries for layouts and visual mockups.
                </p>
                <a href="#!" class="link-hover-underline small fw-semibold">
                  <?php echo $lang['gotoalbums']; ?><i class="fa-solid fa-arrow-right ms-2"></i>
                </a>
              </div>
            </div>
          </div>
       <?php } ?>
         
    
  <!-- end of photo instruction -->   
  <?php if($switchvideo == 1) {} else { ?>	    
<section class="photos">
         
         <div class="section-title">
      <h5 class="text-uppercase font-weight-bold position-relative float-start" style="font-weight:700;">
           <?php echo $lang['latestvideos']; ?>
       </h5>
       <p style="float:right;"><a style="color: #555;text-decoration: none;font-size: 13px;" href="video?all"><?php echo $lang['more']; ?> >></a></p>
        
      
    </div>
        
         <div class="clearfix"></div>

            <div class="row">
               <?php
                  $sql = "SELECT * FROM video ORDER BY videoDate DESC LIMIT 4";
                  $result = mysqli_query($conn, $sql);
                  if (mysqli_num_rows($result) > 0) {
                  while($row = mysqli_fetch_assoc($result)) {
                  	$imagedate = $row['videoDate'];
                           $a = strtotime($imagedate);
                           $tooldate = date('d F Y', $a);
                           $year = date('Y', $a);
                  	?>
               <div class="col-lg-3 mb-4 col-6"> 
       <a class="spotlight" data-src-mp4="videos/<?php echo $row['videoUrl']; ?>" data-poster="videos/thumb/<?php echo $row['videoThumb']; ?>" data-preload="true" data-title="<?php echo $row['videoName']; ?>" data-media="video" data-description="<?php echo $new; ?>" data-play="true" data-preload="true">
  <img src="videos/thumb/<?php echo $row['videoThumb']; ?>" class="card-img-top" alt="" loading="lazy">
</a>        
      
    <p style="font-size: 15px;margin-bottom: 0;" class="card-title pt-2"><?php echo $row['videoName']; ?></p>
    <p style="font-size: 13px;margin-top: 0;color: #a1a1a1;" class="card-text"><?php echo $tooldate; ?></p>
                
                  
  </div>
             <?php    
                  }
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
                           <?php }
                 
                  ?>
                  </div>
      
            </div>
         </section>         
         <?php } ?>
         
         
         
         <section class="photos ps-3 pe-3">
         
         
         <div class="section-title">
      <h5 class="text-uppercase font-weight-bold position-relative pb-0" style="font-weight:700;">
        <?php echo $lang['random']; ?>
       </h5>
      </div>
         
            <div class="row">
               <?php
                  $sql = "SELECT *,COUNT(id) AS total FROM images,album WHERE images.albumId=album.albumId GROUP BY album.albumId ORDER BY RAND() LIMIT 8";
                  $result = mysqli_query($conn, $sql);
                  if (mysqli_num_rows($result) > 0) {
                  while($row = mysqli_fetch_assoc($result)) {
                  	$image_date = $row['albumDate'];
                           $a = strtotime($image_date);
                           $tooldate = date('d F Y', $a);
                           $year = date('Y', $a);
                  	?>
               <div class="col-lg-3 mb-4 col-6"> 
               <a href="photo-albumNumber-<?php echo $row['albumNumber']; ?>-albumDate-<?php echo $year; ?>">
               <div class="imghover"> 
                  <img src="<?php echo $row['albumUrl']; ?>/<?php echo $row['file_name']; ?>" class="card-img-top image">
                  <div class="overlay">
    <div class="text">
    <h4><?php echo $row['albumName']; ?></h4>
    <span style="font-size: 16px;"><?php echo $tooldate; ?></span><br>
    <span style="font-size: 14px;"><?php echo $row['total']; ?> <?php echo $lang['items']; ?></span>
    </div>
  </div>
  </div>
                  </a>
               </div>
               <script>
			
    var tooltipTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="tooltip"]'))
var tooltipList = tooltipTriggerList.map(function (tooltipTriggerEl) {
  return new bootstrap.Tooltip(tooltipTriggerEl, {
  	'customClass': 'custom-tooltip'
  })
})
 

</script>               
               </script>
               <!-- Modal -->
               <div class="modal fade" id="photo<?php echo $row['id']; ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                  <div class="modal-dialog">
                     <div class="modal-content">
                        <div class="modal-body">
                           <img class="img-fluid" src="<?php echo $row['albumUrl']; ?>/<?php echo $row['file_name']; ?>">
                        </div>
                     </div>
                  </div>
               </div>
               <?php    
                  }
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
                           <?php }
                  mysqli_close($conn);
                  ?>
            </div>
            
         </section>
         
<!-- photo resize info --> 
<?php if($_COOKIE['userlevel'] <> 5) {} else { ?>
<div class="container py-9 py-lg-11 position-relative mt-5">
          <div class="row position-relative">
            <div class="col-12 col-md-10 col-lg-10 mx-auto text-center">
              <h2 class="mb-4 display-4 fw-lighter" data-aos="fade-down">
                <?php echo $lang['footermain']; ?>
              </h2>
              <p class="mb-5 px-lg-7 lead" data-aos="zoom-in" data-aos-delay="100">
               <?php echo $lang['footerbody']; ?> 
                   </p>
              
            </div>
          </div>
          </div>         
         <?php } ?>
      </div>
   </div>
</div>
<?php include('footer.php');?>
