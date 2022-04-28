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
<div class="container mt-3">
<div class="col-lg-12"> 

<section class="post">
<div class="row"> 
<?php
$post_id = $_GET['post_id'];
$sql = "SELECT * FROM post WHERE post_id=$post_id ORDER BY post_date DESC";
$result = mysqli_query($conn, $sql);
if (mysqli_num_rows($result) > 0) {
while($row = mysqli_fetch_assoc($result)) {
	?>
<nav aria-label="breadcrumb">
  <ol class="breadcrumb">
    <li class="breadcrumb-item"><a href="/"><?php echo $lang['home']; ?></a></li>
    <li class="breadcrumb-item"><a href="post">Blog</a></li>
    <li class="breadcrumb-item active" aria-current="page"><?php echo $row['post_title']; ?></li>
    <?php $userlevel = $_COOKIE['userlevel'];
if($userlevel == 5) { ?>
    <li class="breadcrumb-item">
    <a href="#" data-bs-toggle="modal" data-bs-target="#updatePost<?php echo $row['post_id'];?>">
         Edit
        </a>
    </li>
     <?php } ?>
  </ol>
</nav>	

<div class="col-lg-8 offset-lg-2 mb-3">
<?php $post_date = $row['post_date'];
$a = strtotime($post_date);
$new = date("l, d F Y  @H:i", $a);
?>
<h4 class="mb-4"><?php echo $row['post_title']; ?>
<?php echo '<small class="float-end" style="color:#aaaaaa;font-weight:normal;font-size:13px;line-height:30px;">'.$new.'</small>'; ?>
</h4>

<?php $post_photo = $row['post_photo']; if(!empty($post_photo)) { ?>
<img src="<?php echo $row['post_photo']; ?>" class="img-fluid mb-3" style="border-radius: 10px;" alt="Post Photo">
<?php } ?>
<p style="font-size:18px;"><?php echo $row['post_body']; ?></p>

        
</div>

<!-- Update Post Modal -->
<div class="modal fade" id="updatePost<?php echo $row['post_id'];?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
   <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Update Post</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">X</button>
      </div>   
      <div class="modal-body p-5">
        

<p><?php echo $albumName; ?></p>
<form method="POST" action="update_post.php"> 
<div class="row"> 
<div class="col-lg-4">
<?php $post_photo=$row['post_photo'];if(!empty($post_photo)) { ?>
<img src="<?php echo $row['post_photo']; ?>" class="img-fluid mb-3" alt="Post Photo">
<?php } else {} ?>
<div class="mb-3">
  <label for="exampleFormControlInput1" class="form-label">Photo</label>
  <input type="text" name="post_photo" class="form-control" value="<?php echo $row['post_photo']; ?>">
</div>
</div>
<div class="col-lg-4"> 
<div class="mb-3">
  <label for="exampleFormControlInput1" class="form-label">Post Date</label>
  <input type="text" name="post_date" class="form-control" value="<?php echo $row['post_date']; ?>">
</div>
</div>
<div class="col-lg-4">
<div class="mb-3"> 
<input type="hidden" name="post_id" value="<?php echo $row['post_id']; ?>">
<label for="exampleFormControlInput1" class="form-label">Post Title</label>
<input name="post_title" class="form-control" style="width:100%" type="text" value="<?php echo $row['post_title']; ?>">
</div>
</div>
</div>


<div class="mb-3"> 
<textarea name="post_body" class="form-control" rows="10" style="width:100%"><?php echo $row['post_body']; ?></textarea>
</div>
</div>
<div class="modal-footer">
<input type="submit" name="updatePost" class="btn btn-primary float-end" value="Update Post">
</form>
</div>

<form action="delete_post.php" method="POST">
	<input type="hidden" name="post_id" value="<?php echo $row['post_id']; ?>">
	<input type="hidden" name="delete" value="del1975">

<div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>	
	
	<input type="submit" name="submit" class="btn btn-danger" value="Delete Post"> 
</form>
      </div>
      
    
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
<script>
    tinymce.init({
      selector: 'textarea.tiny',
      plugins: 'code advlist autolink lists link image charmap print preview hr anchor pagebreak',
      toolbar_mode: 'floating',
      height: 500,
       });
  </script>
<?php include('footer.php');?>
