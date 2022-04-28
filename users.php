<?php 
$site = 'users';
include('header.php');
include_once("db_connect.php");
include('container.php');
if($userlevel < 5) { 
header("Location: profile");
} 
?>
<style>
td {
	line-height: 50px;
}
</style>
<div class="d-flex" id="wrapper">
<div class="bg-white" id="sidebar-wrapper" style="min-width: 240px;">
<?php include 'sidebar.php'; ?>
</div>
<div id="page-content-wrapper">
<div class="container-fluid mt-5">

<section class="statistic">
<div class="row pb-5"> 
<div class="col-lg-3 text-center"> 
<div class="card border-none p-3 bg-danger text-white" style="box-shadow: 0 1rem 3rem rgba(8,11,19,.125) !important;"> 

<p>Total Images</p>
<?php
$sql = "SELECT * from images";
if ($result = mysqli_query($conn, $sql)) {
$rowcount = mysqli_num_rows( $result );
echo '<h1>'.$rowcount.'</h1>';
 }
 ?>
 </div>
 </div>
 
 <div class="col-lg-3 text-center"> 
<div class="card border-none p-3 bg-danger text-white" style="box-shadow: 0 1rem 3rem rgba(8,11,19,.125) !important;"> 

<p>Total Videos</p>
<?php
$sql = "SELECT * from video";
if ($result = mysqli_query($conn, $sql)) {
$rowcount = mysqli_num_rows( $result );
echo '<h1>'.$rowcount.'</h1>';
 }
 ?>
 </div>
 </div>
 
 <div class="col-lg-3 text-center"> 
<div class="card border-none p-3 bg-danger text-white" style="box-shadow: 0 1rem 3rem rgba(8,11,19,.125) !important;"> 

<p>Total Albums</p>
<?php
$sql = "SELECT * from album";
if ($result = mysqli_query($conn, $sql)) {
$albumcount = mysqli_num_rows( $result );
echo '<h1>'.$albumcount.'</h1>';
 }
 ?>
 </div>
 </div>
 
 <div class="col-lg-3 text-center"> 
<div class="card border-none p-3 bg-danger text-white" style="box-shadow: 0 1rem 3rem rgba(8,11,19,.125) !important;"> 
<p>Album/Video Folder</p>
<?php
echo '<h1>'.sizeFormat(folderSize($folder_name)+folderSize($video_name)).'</h1>';
 
 ?>
 </div>
 </div>
</div>
</section>

<div class="accordion" id="accordionExample">
  <div class="accordion-item">
    <h2 class="accordion-header" id="headingOne">
      <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
        Users List
      </button>
    </h2>
    <div id="collapseOne" class="accordion-collapse collapsed border-none" aria-labelledby="headingOne" data-bs-parent="#accordionExample">
      <div class="accordion-body">
          


<section class="upload"> 
<table class="table border-none">
  
  <tbody>
 <?php
$sql = "SELECT * FROM users ORDER BY usid ASC";
$result = mysqli_query($conn, $sql);
while($row = mysqli_fetch_assoc($result)) {
	
	?>
	<tr>
      <td><img src="<?php echo $row['userPhoto']; ?>" style="max-height: 40px;border-radius:20%;"></td>
      <td><?php echo $row['userName']; ?></td>
      <td><?php echo $row['userSurname']; ?></td>
      <td><?php echo $row['usemail']; ?></td>
      <td><?php 
      $userLang = $row['userLang']; 
      if($userLang == 'lang/lang.en.php') { echo 'English';} 
      if($userLang == 'lang/lang.pl.php') { echo 'Polish';} 
      ?></td>
      <td><?php $userlevel = $row['userlevel']; 
      if($userlevel == 5) { echo 'Administrator';} else { echo 'Guest';}
      ?></td>
      <td><?php $userLoged = $row['userLoged']; 
      if($userLoged == 1) { ?>
      <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-check-square" viewBox="0 0 16 16">
  <path d="M14 1a1 1 0 0 1 1 1v12a1 1 0 0 1-1 1H2a1 1 0 0 1-1-1V2a1 1 0 0 1 1-1h12zM2 0a2 2 0 0 0-2 2v12a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V2a2 2 0 0 0-2-2H2z"/>
  <path d="M10.97 4.97a.75.75 0 0 1 1.071 1.05l-3.992 4.99a.75.75 0 0 1-1.08.02L4.324 8.384a.75.75 0 1 1 1.06-1.06l2.094 2.093 3.473-4.425a.235.235 0 0 1 .02-.022z"/>
</svg>
<?php }  else {}?>
      </td>
      <td>
			<a class="btn btn-link link-dark shadow-none" href="#" role="button" id="dropdownMenuLink" data-bs-toggle="dropdown" aria-expanded="false">
   <i class="fa-solid fa-ellipsis-vertical"></i>
  </a>
  <ul class="dropdown-menu" aria-labelledby="dropdownMenuLink">
    <li><a class="dropdown-item" href="" data-bs-toggle="modal" data-bs-target="#updateUser<?php echo $row['usid']; ?>" class="link-dark nav-link">Update User</a></li>
    <li><a class="dropdown-item" href="" data-bs-toggle="modal" data-bs-target="#userPhoto<?php echo $row['usid']; ?>" class="link-dark nav-link">Upload Photo</a></li>
    <li><a class="dropdown-item" href="#">Delete</a></li>
  </ul>      
      </td>
    </tr>
    
<!-- Modal upload user photo -->

<div class="modal fade" id="userPhoto<?php echo $row['usid']; ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Upload Photo</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">X</button>
      </div>
      <div class="modal-body p-5">
      <form action="up_user_photo.php" method="post" enctype="multipart/form-data">
        <div class="mb-3">
  
  <input class="form-control" type="file" name="fileToUpload" id="fileToUpload" > 
  <input type="hidden" name="usid" value="<?php echo $row['usid']; ?>">
</div>	

	
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
        <input class="btn btn-primary" type="submit" value="Upload">
      </div>
      </form>
    </div>
  </div>
</div>  

<!-- Update user -->

<div class="modal fade" id="updateUser<?php echo $row['usid']; ?>" tabindex="-1" aria-labelledby="newPhotoAlbumLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Update User</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">X</button>
      </div>
      <div class="modal-body p-5">
        <form method="post" action="user_update.php">   
<input type="hidden" name="usid" value="<?php echo $row['usid']; ?>" />
<input type="hidden" name="admin">
	<div class="mb-3">
  <label for="exampleFormControlInput1" class="form-label">First Name</label>
  <input type="text" name="userName" class="form-control" value="<?php echo $row['userName']; ?>" id="exampleFormControlInput1" placeholder="First Name">
</div>
<div class="mb-3">
  <label for="exampleFormControlInput1" class="form-label">Second Name</label>
  <input type="text" name="userSurname" class="form-control" value="<?php echo $row['userSurname']; ?>" id="exampleFormControlInput1" placeholder="Second Name">
</div>
<div class="mb-3">
  <label for="exampleFormControlInput1" class="form-label">Email</label>
  <input type="text" name="usemail" class="form-control" value="<?php echo $row['usemail']; ?>" id="exampleFormControlInput1" placeholder="Email address">
</div>
<div class="mb-3">
  <label for="exampleFormControlInput1" class="form-label">Password</label>
  <input type="text" name="uspasswd" class="form-control" value="<?php echo $row['uspasswd']; ?>" id="exampleFormControlInput1" placeholder="Password">
</div>

<div class="mb-3">
  <label for="exampleFormControlInput1" class="form-label">Language</label>
  <br>
  <select name="userLang" class="custom-select">
    <option value="lang/lang.en.php" <?php $userLang=$row['userLang'];if($userLang=='lang/lang.en.php') {echo 'selected';} ?>>English</option>
    <option value="lang/lang.pl.php" <?php if($userLang=='lang/lang.pl.php') {echo 'selected';} ?>>Polish</option>
    </select>
</div>

<div class="mb-3">
  <label for="exampleFormControlInput1" class="form-label">Level</label>
  <br>
  <select name="userlevel" class="custom-select">
    <option value="0" <?php $userlevel=$row['userlevel'];if($userlevel==0) {echo 'selected';} ?>>Guest</option>
    <option value="5" <?php if($userlevel==5) {echo 'selected';} ?>>Administrator</option>
    </select>
</div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
        <input class="btn btn-primary" type="submit" name="updateUser" value="Submit">
      </div>
      </form>
    </div>
  </div>
</div>
  
    
	<?php } ?> 
</tbody>
</table>

</section>
</div>
    </div>
  </div>
</div>



</div>
</div>
</div>


<!-- Modal add new user -->

<div class="modal fade" id="newUser" tabindex="-1" aria-labelledby="newPhotoAlbumLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">New User</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">X</button>
      </div>
      <div class="modal-body p-5">
        <form method="post" action="user_upload.php">   

	<div class="mb-3">
  <label for="exampleFormControlInput1" class="form-label">First Name</label>
  <input type="text" name="userName" class="form-control" id="exampleFormControlInput1" placeholder="First Name">
</div>
<div class="mb-3">
  <label for="exampleFormControlInput1" class="form-label">Second Name</label>
  <input type="text" name="userSurname" class="form-control" id="exampleFormControlInput1" placeholder="Second Name">
</div>
<div class="mb-3">
  <label for="exampleFormControlInput1" class="form-label">Email</label>
  <input type="email" name="usemail" class="form-control" id="exampleFormControlInput1" placeholder="Email address">
</div>
<div class="mb-3">
  <label for="exampleFormControlInput1" class="form-label">Password</label>
  <input type="text" name="uspasswd" class="form-control" id="exampleFormControlInput1" placeholder="Password">
</div>

<div class="mb-3">
  <label for="exampleFormControlInput1" class="form-label">Language</label>
  <br>
  <select name="userLang" class="custom-select">
    <option selected>Choose...</option>
    <option value="lang/lang.en.php">English</option>
    <option value="lang/lang.pl.php">Polish</option>
    </select>
</div>

<div class="mb-3">
  <label for="exampleFormControlInput1" class="form-label">Level</label>
  <br>
  <select name="userlevel" class="custom-select">
    <option selected>Choose...</option>
    <option value="0">Guest</option>
    <option value="5">Administrator</option>
    </select>
</div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
        <input class="btn btn-primary" type="submit" name="newUser" value="Submit">
      </div>
      </form>
    </div>
  </div>
</div>


<?php include('footer.php');?>
