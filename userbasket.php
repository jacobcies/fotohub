<?php 
ob_start();
$error = ""; //error holder  
 if(isset($_POST['createpdf']))  
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

$site = 'userbasket';
include('header.php');
include_once("db_connect.php");
include('container.php');
$basketimgName = $_GET['basketimgName']; 
   
 ?>  


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
    <?php if(isset($basketimgName)) { ?>
    <li class="breadcrumb-item"><a href="" data-bs-toggle="modal" data-bs-target="#delete-basket" style="text-transform: capitalize;"><?php echo $lang['deletebasket']; ?> <?php echo $basketimgName; ?></a></li>
    
    <form name="zips" action="" method="post" enctype="multipart/form-data">  
<?php echo $error; 
$sql = "SELECT * FROM images,album,basketimg WHERE images.albumId=album.albumId AND images.id=basketimg.basketimgItem AND basketimg.basketimgOwner='$photouser' AND basketimg.basketimgName='$basketimgName' ORDER BY images.photo_date ASC";
$result = mysqli_query($conn, $sql);
while($row = mysqli_fetch_assoc($result)) {
?>
<input type="hidden" checked name="files[]" value="<?php echo $row['albumUrl']; ?>/<?php echo $row['file_name']; ?>" />  
<?php } ?>
<li class="breadcrumb-item">
<input type="submit" class="btn btn-link pt-0 mt-0 ps-2 shadow-none" style="line-height: 23px;font-size: .835rem;text-decoration: none;color: #408080;" name="createpdf" value="&#8226; &nbsp;<?php echo $lang['downloadbasket']; ?>" />
</li>
</form> 
    
    
    <?php } else { 
    $sql = "SELECT * FROM images,album,basketimg WHERE images.albumId=album.albumId AND images.id=basketimg.basketimgItem AND basketimg.basketimgOwner='$photouser' AND basketimg.basketimgName IS NULL ORDER BY images.photo_date ASC";
$result = $conn->query($sql);
if ($result->num_rows > 0) { ?>
    <li class="breadcrumb-item"><a href="" data-bs-toggle="modal" data-bs-target="#savebasket"><?php echo $lang['savebasket']; ?></a></li>
    <li class="breadcrumb-item"><a href="" data-bs-toggle="modal" data-bs-target="#flushbasket"><?php echo $lang['flushbasket']; ?></a></li>
    
    <?php }} ?>
  </ol>
</nav>

<!-- Modal save basket -->
<div class="modal fade" id="savebasket" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel"><?php echo $lang['savebasket']; ?></h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">X</button>
      </div>
      <div class="modal-body p-5">
        
<form action="basketimg.php" method="POST">
<label class="mb-3"><?php echo $lang['newbasket']; ?></label>
<input type="text" name="basketimgName" class="form-control">
<label class="mb-3 mt-3"><?php echo $lang['basketexist']; ?></label>
<select class="form-select" name="basketimgNameSelect">
<option value="" selected><?php echo $lang['choose']; ?></option>
<?php
$sql = "SELECT * FROM basketimg WHERE basketimgOwner='$photouser' AND basketimgName IS NOT NULL GROUP BY basketimgName ORDER BY basketimgDate DESC";
$result = mysqli_query($conn, $sql);
while($row = mysqli_fetch_assoc($result)) { ?>
	<option value="<?php echo $row['basketimgName']; ?>"><?php echo $row['basketimgName']; ?></option>
<?php } ?>
</select>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal"><?php echo $lang['close']; ?></button>
        <input type="submit" class="btn btn-success" name="updateName" value="Update">
</form>

      </div>
    </div>
  </div>
</div>

<!-- Modal delete saved basket -->

<div class="modal fade" id="delete-basket" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel"><?php echo $lang['deletebasket']; ?> <?php echo $basketimgName; ?> ?</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">X</button>
      </div>
      
        
<form action="basketimg.php" method="POST">
<input type="hidden" name="basketimgName" value="<?php echo $basketimgName; ?>">
     
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal"><?php echo $lang['donotdelete']; ?></button>
        <input type="submit" class="btn btn-success" name="deleteBasket" value="<?php echo $lang['delete']; ?>">
</form>

      </div>
    </div>
  </div>
</div>

<!-- Modal flush basket -->

<div class="modal fade" id="flushbasket" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel"><?php echo $lang['flushbasket']; ?> ?</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">X</button>
      </div>
      
        
<form action="basketimg.php" method="POST">
<input type="hidden" name="flush">
     
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal"><?php echo $lang['dontflush']; ?></button>
        <input type="submit" class="btn btn-success" name="flushBasket" value="<?php echo $lang['flushbasket']; ?>">
</form>

      </div>
    </div>
  </div>
</div>


<!-- ------------------------images basket--------------------------- -->

<div class="row"> 

<?php
$photouser = $_COOKIE['photouser'];
$files = array();
if(isset($basketimgName)) {
$sql = "SELECT * FROM images,album,basketimg WHERE images.albumId=album.albumId AND images.id=basketimg.basketimgItem AND basketimg.basketimgOwner='$photouser' AND basketimg.basketimgName='$basketimgName' ORDER BY images.photo_date ASC";
} else {
$sql = "SELECT * FROM images,album,basketimg WHERE images.albumId=album.albumId AND images.id=basketimg.basketimgItem AND basketimg.basketimgOwner='$photouser' AND basketimg.basketimgName IS NULL ORDER BY images.photo_date ASC";
}
$result = mysqli_query($conn, $sql);
if (mysqli_num_rows($result) > 0) {
while($row = mysqli_fetch_assoc($result)) {
$post_date = $row['albumDate'];
$a = strtotime($post_date);
$year = date("M Y", $a);
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
<input type="hidden" name="deleteoneItem">
<input type="hidden" name="basketimgName" value="<?php echo $row['basketimgName']; ?>">
<button class="btn btn-link link-light" type="submit" name="submit">
<svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-trash" viewBox="0 0 16 16">
  <path d="M5.5 5.5A.5.5 0 0 1 6 6v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5zm2.5 0a.5.5 0 0 1 .5.5v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5zm3 .5a.5.5 0 0 0-1 0v6a.5.5 0 0 0 1 0V6z"/>
  <path fill-rule="evenodd" d="M14.5 3a1 1 0 0 1-1 1H13v9a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V4h-.5a1 1 0 0 1-1-1V2a1 1 0 0 1 1-1H6a1 1 0 0 1 1-1h2a1 1 0 0 1 1 1h3.5a1 1 0 0 1 1 1v1zM4.118 4 4 4.059V13a1 1 0 0 0 1 1h6a1 1 0 0 0 1-1V4.059L11.882 4H4.118zM2.5 3V2h11v1h-11z"/>
</svg>
</button>
</form>
</div>


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


<?php 

}
} else {
	echo '<div class="container"><div class="alert alert-warning alert-dismissible fade show" role="alert">
  <strong>Upss...</strong> No any images in the basket
  <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
</div></div>';
	} ?>

</div>

 

</section>	
</div>
</div>
</div>

<?php include('footer.php');?>