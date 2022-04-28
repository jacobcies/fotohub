 <style>
li.nav-item i{
	font-size: 22px;
	padding-right: 10px;
} 
 </style>
 
 </head>
 <?php if(isset($_COOKIE['userLang'])) {include $_COOKIE['userLang'];} ?>
<body>

<nav class="navbar navbar-expand-lg navbar-light bg-white border-bottom">
  <div class="container-fluid">
    <a class="navbar-brand" href="/">
    <img style="max-height: 40px;" src="assets/img/logo-new.webp" alt="">
    </a>
    <?php if($site=='photo' || $site=='favourite') {} else { ?>
    <button class="btn shadow-none" id="sidebarToggle" style="overflow: hidden;">
    <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="currentColor" class="bi bi-arrow-bar-left" viewBox="0 0 16 16">
  <path fill-rule="evenodd" d="M12.5 15a.5.5 0 0 1-.5-.5v-13a.5.5 0 0 1 1 0v13a.5.5 0 0 1-.5.5zM10 8a.5.5 0 0 1-.5.5H3.707l2.147 2.146a.5.5 0 0 1-.708.708l-3-3a.5.5 0 0 1 0-.708l3-3a.5.5 0 1 1 .708.708L3.707 7.5H9.5a.5.5 0 0 1 .5.5z"/>
</svg>
    </button>
    <?php } ?>
   <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    
    <div class="collapse navbar-collapse" id="navbarNav">
      <ul class="navbar-nav">
      <?php if($site=='photo' || $site=='favourite') { ?> 
       
      <!-- <li class="nav-item">
      <?php if(!empty($_GET['albumDate'])) { ?>
      <a href="albums-albumDate-<?php echo $_GET['albumDate']; ?>" class="link-dark nav-link">	
      <?php } else { ?>
      <a href="albums" class="link-dark nav-link">
      <?php } ?>
          <?php echo $lang['albums']; ?>
        </a></li> -->
	     <?php
        if($userlevel == 5) { ?>
        <li class="nav-item"><a href="post" class="link-dark nav-link">
          Blog
        </a></li>   
        <?php }} ?>
      </ul>
      
<div class="row height w-100 d-flex justify-content-center align-items-center">
        <div class="col-lg-8">
            <div class="search"> 
            <form method="GET" action="search"> 
            <input type="text" name="s" class="form-control" placeholder="<?php echo $lang['lookingfor']; ?>"> 
            <button class="btn btn-red d-none d-sm-block"><?php echo $lang['search']; ?></button> 
            </form>
            </div>
        </div>
    </div>         
      
      <ul class="navbar-nav ms-auto mb-2 mb-lg-0">
      <?php 
      $userlevel = $_COOKIE['userlevel'];
      if($site=='photo' && $userlevel == 5) { ?>
 
      
<li class="nav-item"><a href="#" title="<?php echo $lang['uploadphotos']; ?>" data-bs-toggle="modal" data-bs-target="#uploadPhotoToAlbum" class="link-dark nav-link">
          <i class="fa-solid fa-upload"></i>
        </a></li>
        <li class="nav-item"><a href="#" title="Update Album" data-bs-toggle="modal" data-bs-target="#updatePhotoToAlbum" class="link-dark nav-link">
          <i class="fa-solid fa-pen-to-square"></i>
        </a></li>
        <?php } ?>
        <?php if($site=='photo') { ?>
        <li class="nav-item"><a href="#" title="Share Album" data-bs-toggle="modal" data-bs-target="#sharePhotoToAlbum" class="link-dark nav-link">
          <i class="fa-solid fa-share-nodes"></i>
        </a></li>
        <li class="nav-item"><a href="#" title="Download Album" data-bs-toggle="modal" data-bs-target="#downloadPhotoToAlbum" class="link-dark nav-link">
          <i class="fa-solid fa-download"></i>
        </a></li>
        <?php } ?>
        <?php if($site=='photo' && $userlevel == 5) { ?>
        <li class="nav-item"><a href="#" title="Delete Album" data-bs-toggle="modal" data-bs-target="#deletePhotoToAlbum" class="link-dark nav-link">
          <i class="fa-solid fa-trash"></i>
        </a></li>
      
      <?php } ?>
      <?php if($site=='post' && $userlevel == 5) { ?>
      <li class="nav-item"><a href="#" data-bs-toggle="modal" data-bs-target="#uploadPost" class="nav-link link-dark">
          New&nbsp;Post
        </a></li>
         <?php } ?>
         
         <?php if($site=='users' && $userlevel == 5) { ?>
      <li class="nav-item"><a href="#" data-bs-toggle="modal" data-bs-target="#newUser" class="nav-link link-dark">
          New&nbsp;User
        </a></li>
         <?php } ?>
         
         <?php if($site=='album' && $userlevel == 5) { ?>
      <li class="nav-item">
      <a href="#" data-bs-toggle="modal" data-bs-target="#newPhotoAlbum" class="nav-link link-dark">
          New&nbsp;Album
        </a></li>
         <?php } ?>
         
         <?php if($site=='video' && $userlevel == 5) { ?>
      <li class="nav-item">
      <a href="#" data-bs-toggle="modal" data-bs-target="#newVideo" class="nav-link link-dark">
          New&nbsp;Video
        </a></li>
         <?php } ?>
         </ul>
        
    </div>
  </div>
</nav>
	
	