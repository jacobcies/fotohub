<?php 
$site = 'profile';
include('header.php');
include_once("db_connect.php");
include('container.php');

?>
<style>
.height-15x {
  height: 10rem !important;
}
.width-15x {
  width: 10rem !important;
}
.bg-contain {
  background-size: contain !important;
}
.rounded-circle {
  border-radius: 50% !important;
}
.btn-red {
  color: #fff;
  background: #fb2905;
}
</style>
<div class="d-flex" id="wrapper">
<div class="bg-white" id="sidebar-wrapper" style="min-width: 240px;">
<?php include 'sidebar.php'; ?>
</div>
<div id="page-content-wrapper">
<div class="container mt-5">
<div class="row"> 

<?php if(isset($_GET['up'])) { ?>
<div class="alert alert-warning alert-dismissible fade show" role="alert">
  <strong>Congratulations!</strong> Operation done.
  <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
</div>
<?php } ?>


<div class="col-lg-3">
<section class="upload"> 
<?php
$sql = "SELECT * FROM users WHERE usemail='$user'";
$result = mysqli_query($conn, $sql);
while($row = mysqli_fetch_assoc($result)) {
	$usid = $row['usid'];
	?>
	
<div class="card p-3" style="border-radius: 10px;">
<div class="width-15x height-15x mb-5 rounded-circle shadow bg-no-repat overflow-hidden bg-contain"
style="background-image: url(<?php echo $row['userPhoto']; ?>);">
</div>
        
            <div class="w-100">
                <h4 class="mb-0 mt-0"><?php echo $row['userName']; ?> <?php echo $row['userSurname']; ?></h4> 
                <span><?php $userlevel = $row['userlevel']; 
      if($userlevel == 5) { echo $lang['administrator']; } else { echo $lang['guest'];}
      ?></span>
                
                
            </div>
        
    </div>	


</section>

</div>

<div class="col-lg-9">
<section class="position-relative">
                <div class="container">
                    <div class="row mb-9 mb-lg-11">
                        <div class="col-lg-10 col-xl-10">
                        
                        
<div class="accordion accordion-flush" id="accordionFlushExample">
<div class="accordion-item">
    <h2 class="accordion-header" id="flush-headingZero">
      <button class="accordion-button collapsed shadow-none" type="button" data-bs-toggle="collapse" data-bs-target="#flush-collapseZero" aria-expanded="false" aria-controls="flush-collapseZero">
        <?php echo $lang['uploadphoto']; ?>
      </button>
    </h2>
    <div id="flush-collapseZero" class="accordion-collapse collapse" aria-labelledby="flush-headingZero" data-bs-parent="#accordionFlushExample">
      <div class="accordion-body">
      
<form action="up_user_photo.php" method="post" enctype="multipart/form-data">
<input type="hidden" name="guest">
<input class="form-control" type="file" name="fileToUpload" id="fileToUpload" > 
<input type="hidden" name="usid" value="<?php echo $row['usid']; ?>">
<input class="btn btn-red mt-3" type="submit" value="<?php echo $lang['uploadphoto']; ?>">
</form>      
      
      </div>
    </div>
  </div>
  <div class="accordion-item">
    <h2 class="accordion-header" id="flush-headingOne">
      <button class="accordion-button collapsed shadow-none" type="button" data-bs-toggle="collapse" data-bs-target="#flush-collapseOne" aria-expanded="false" aria-controls="flush-collapseOne">
        <?php echo $lang['changename']; ?>
      </button>
    </h2>
    <div id="flush-collapseOne" class="accordion-collapse collapse" aria-labelledby="flush-headingOne" data-bs-parent="#accordionFlushExample">
      <div class="accordion-body">
      
<form method="post" action="user_update.php">   
<input type="hidden" name="usid" value="<?php echo $row['usid']; ?>" />
<input type="hidden" name="usemail" value="<?php echo $_COOKIE['photouser']; ?>">
<div class="row"> 
<div class="col-lg-6"> 
<label for="exampleFormControlInput1" class="form-label"><?php echo $lang['fname']; ?></label>
<input type="text" name="userName" class="form-control" value="<?php echo $row['userName']; ?>" id="exampleFormControlInput1" placeholder="First Name">
</div>
<div class="col-lg-6"> 
<label for="exampleFormControlInput1" class="form-label"><?php echo $lang['sname']; ?></label>
<input type="text" name="userSurname" class="form-control" value="<?php echo $row['userSurname']; ?>" id="exampleFormControlInput1" placeholder="Second Name">
</div>
</div>
<input type="hidden" name="userlevel" value="<?php echo $row['userlevel']; ?>">
<input type="hidden" name="guest">
<input type="hidden" name="uspasswd" value="<?php echo $row['uspasswd']; ?>">
<input type="hidden" name="userLang" value="<?php echo $row['userLang']; ?>">
<input class="btn btn-red mt-3" type="submit" name="updateUser" value="<?php echo $lang['submit']; ?>">
</form>    
      
      </div>
    </div>
  </div>
  <div class="accordion-item">
    <h2 class="accordion-header" id="flush-headingTwo">
      <button class="accordion-button collapsed shadow-none" type="button" data-bs-toggle="collapse" data-bs-target="#flush-collapseTwo" aria-expanded="false" aria-controls="flush-collapseTwo">
        <?php echo $lang['changepassword']; ?>
      </button>
    </h2>
    <div id="flush-collapseTwo" class="accordion-collapse collapse" aria-labelledby="flush-headingTwo" data-bs-parent="#accordionFlushExample">
      <div class="accordion-body">
      
<form method="post" action="user_update.php"> 
<input type="hidden" name="userName" value="<?php echo $row['userName']; ?>">
<input type="hidden" name="userSurname" value="<?php echo $row['userSurname']; ?>">
<input type="hidden" name="usid" value="<?php echo $row['usid']; ?>" />
<input type="hidden" name="usemail" value="<?php echo $_COOKIE['photouser']; ?>">
<div class="col-lg-6"> 
<input type="password" id="password" name="uspasswd" value="<?php echo $row['uspasswd']; ?>" class="form-control" data-toggle="password">
<input type="hidden" name="userlevel" value="<?php echo $row['userlevel']; ?>">
<input type="hidden" name="guest">
<input type="hidden" name="userLang" value="<?php echo $row['userLang']; ?>">
<input class="btn btn-red mt-3" type="submit" name="updateUser" value="<?php echo $lang['submit']; ?>">
</div>
</form>        
      
      </div>
    </div>
  </div>
  <div class="accordion-item">
    <h2 class="accordion-header" id="flush-headingThree">
      <button class="accordion-button collapsed shadow-none" type="button" data-bs-toggle="collapse" data-bs-target="#flush-collapseThree" aria-expanded="false" aria-controls="flush-collapseThree">
        <?php echo $lang['changelang']; ?>
      </button>
    </h2>
    <div id="flush-collapseThree" class="accordion-collapse collapse" aria-labelledby="flush-headingThree" data-bs-parent="#accordionFlushExample">
      <div class="accordion-body">
      
<form method="post" action="user_update.php">   
<input type="hidden" name="usid" value="<?php echo $row['usid']; ?>" />
<input type="hidden" name="usemail" value="<?php echo $_COOKIE['photouser']; ?>">  
<input type="hidden" name="userName" value="<?php echo $row['userName']; ?>">
<input type="hidden" name="uspasswd" value="<?php echo $row['uspasswd']; ?>">
<input type="hidden" name="userSurname" value="<?php echo $row['userSurname']; ?>"> 
<select name="userLang" class="form-select" aria-label="Default select example">
<option value="lang/lang.en.php" <?php $userLang=$row['userLang'];if($userLang=='lang/lang.en.php') {echo 'selected';} ?>>English</option>
<option value="lang/lang.pl.php" <?php if($userLang=='lang/lang.pl.php') {echo 'selected';} ?>>Polski</option>
</select>
<input type="hidden" name="userlevel" value="<?php echo $row['userlevel']; ?>">
<input type="hidden" name="guest">
<input class="btn btn-red mt-3" type="submit" name="updateUser" value="<?php echo $lang['submit']; ?>">
</form>   
      
      </div>
    </div>
  </div>
  <?php } ?>
 
 <?php 
 if($_COOKIE['userlevel'] <> 5) {} else { ?>
<div class="accordion-item">
    <h2 class="accordion-header" id="flush-headingFour">
      <button class="accordion-button collapsed shadow-none" type="button" data-bs-toggle="collapse" data-bs-target="#flush-collapseFour" aria-expanded="false" aria-controls="flush-collapseFour">
        Change Login Panel Wallpaper
      </button>
    </h2>
    <div id="flush-collapseFour" class="accordion-collapse collapse" aria-labelledby="flush-headingFour" data-bs-parent="#accordionFlushExample">
      <div class="accordion-body">
<div class="row"> 
<div class="col-lg-3"> 
<?php
$sql = "SELECT setid,setlogwallpaper FROM settings WHERE setid='1'";
$result = mysqli_query($conn, $sql);
while($row = mysqli_fetch_assoc($result)) {
	?>
<img src="<?php echo $row['setlogwallpaper']; ?>" alt="Log Wallpaper" class="img-fluid">	
	<?php } ?>
</div>
<div class="col-lg-9"> 
<form action="setsettings.php" method="post" enctype="multipart/form-data">
<input class="form-control" type="file" name="fileToUpload" id="fileToUpload" > 
<input class="btn btn-red mt-3" name="setwallpaper" type="submit" value="Set Wallpaper">
</form>   
</div>
</div>
</div>
</div>
</div>

<div class="accordion-item">
    <h2 class="accordion-header" id="flush-headingFive">
      <button class="accordion-button collapsed shadow-none" type="button" data-bs-toggle="collapse" data-bs-target="#flush-collapseFive" aria-expanded="false" aria-controls="flush-collapseFive">
        Video
      </button>
    </h2>    
<div id="flush-collapseFive" class="accordion-collapse collapse" aria-labelledby="flush-headingFive" data-bs-parent="#accordionFlushExample">
      <div class="accordion-body">
<form action="setsettings.php" method="post">
<select name="switchvideo" class="form-select w-25">
<option value="0" <?php if($switchvideo == 0){echo 'selected';} ?>>On</option>
<option value="1" <?php if($switchvideo == 1){echo 'selected';} ?>>Off</option>
</select> 
<input class="btn btn-red mt-3" name="switchvideobutton" type="submit" value="Switch">
</form>  

  

      
      </div>
    </div>
  </div> 


<div class="accordion-item">
    <h2 class="accordion-header" id="flush-headingSix">
      <button class="accordion-button collapsed shadow-none" type="button" data-bs-toggle="collapse" data-bs-target="#flush-collapseSix" aria-expanded="false" aria-controls="flush-collapseSix">
        Blog
      </button>
    </h2>    
<div id="flush-collapseSix" class="accordion-collapse collapse" aria-labelledby="flush-headingSix" data-bs-parent="#accordionFlushExample">
      <div class="accordion-body">
<form action="setsettings.php" method="post">
<select name="switchblog" class="form-select w-25">
<option value="0" <?php if($switchblog == 0){echo 'selected';} ?>>On</option>
<option value="1" <?php if($switchblog == 1){echo 'selected';} ?>>Off</option>
</select> 
<input class="btn btn-red mt-3" name="switchblogi" type="submit" value="Switch">
</form>  

  

      
      </div>
    </div>
  </div> 
  
  <div class="accordion-item">
    <h2 class="accordion-header" id="flush-headingSeven">
      <button class="accordion-button collapsed shadow-none" type="button" data-bs-toggle="collapse" data-bs-target="#flush-collapseSeven" aria-expanded="false" aria-controls="flush-collapseSeven">
        Shared password
      </button>
    </h2>    
<div id="flush-collapseSeven" class="accordion-collapse collapse" aria-labelledby="flush-headingSeven" data-bs-parent="#accordionFlushExample">
      <div class="accordion-body">
<form action="setsettings.php" method="post">
<input type="text" name="sharepasswd" class="form-control" value="<?php echo $sharepasswd; ?>">
<input class="btn btn-red mt-3" name="sharepasbutton" type="submit" value="Submit">
</form>  

  

      
      </div>
    </div>
  </div> 
  
  <div class="accordion-item">
    <h2 class="accordion-header" id="flush-headingEight">
      <button class="accordion-button collapsed shadow-none" type="button" data-bs-toggle="collapse" data-bs-target="#flush-collapseEight" aria-expanded="false" aria-controls="flush-collapseEight">
        MapBox Token
      </button>
    </h2>    
<div id="flush-collapseEight" class="accordion-collapse collapse" aria-labelledby="flush-headingSeven" data-bs-parent="#accordionFlushExample">
      <div class="accordion-body">
<form action="setsettings.php" method="post">
<input type="text" name="mapbox" class="form-control" value="<?php echo $mapbox; ?>">
<input class="btn btn-red mt-3" name="mapboxtoken" type="submit" value="Submit">
</form>  

  

      
      </div>
    </div>
  </div> 
  
  
   
  <?php } ?>
</div>                        
  
  </div>
  </div>
  </div>
  </div>                      
  </div>
                             


</div>
</div>
</div>




<?php include('footer.php');?>
