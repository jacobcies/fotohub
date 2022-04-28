<?php 
   $site = 'post';
   include('header.php');
   include_once("db_connect.php");
   include('container.php');?>
<div class="d-flex" id="wrapper">
   <div class="bg-white" id="sidebar-wrapper" style="min-width: 240px;">
      <?php include 'sidebar.php'; ?>
   </div>
   <div id="page-content-wrapper">
      <div class="container-fluid mt-3">
         <div class="col-lg-12">
            <section class="post">
            <nav aria-label="breadcrumb">
  <ol class="breadcrumb">
    <li class="breadcrumb-item"><a href="/"><?php echo $lang['home']; ?></a></li>
    <li class="breadcrumb-item active" aria-current="page">Blog</li>
    
  </ol>
</nav>
               <div class="row">
                  <?php
                     $sql = "SELECT * FROM post ORDER BY post_date DESC";
                     $result = mysqli_query($conn, $sql);
                     if (mysqli_num_rows($result) > 0) {
                     while($row = mysqli_fetch_assoc($result)) {
                     ?>
  <?php $post_date = $row['post_date'];
                           $a = strtotime($post_date);
                           $new = date("l, d F Y", $a);
                           ?>                   
                     
   <div class="col-lg-3">
   <div class="card">
   <a href="card-post_id-<?php echo $row['post_id']; ?>">
   <?php $post_photo = $row['post_photo']; if(!empty($post_photo)) { ?>
<img src="<?php echo $row['post_photo']; ?>" class="card-img-top" alt="Post Photo">
<?php } else { ?>
	<img src="assets/img/logo-new-big.png" class="card-img-top" alt="Post Photo">
<?php } ?>
</a>
  <div class="card-body mt-1">
    
    
   <p style="font-size: 15px;margin-bottom: 0;" class="card-title pt-1"><?php echo $row['post_title']; ?></p>
    <?php echo '<small style="color:#aaaaaa;font-weight:normal;font-size:13px;">'.$new.'</small>'; ?>
    
    
  </div>
</div>
   </div>
                     
                     
                  
                  <?php    
                     }
                     } else {
                     echo "Can't find any posts.";
                     }
                     mysqli_close($conn);
                     ?>
               </div>
            </section>
         </div>
      </div>
   </div>
</div>

<?php include('footer.php');?>
