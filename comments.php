<?php 
$site = 'comments';
$id = $_GET['id'];
include('header.php');
include_once("db_connect.php");
include('container.php');
?>

<div class="d-flex" id="wrapper">
<div class="bg-white" id="sidebar-wrapper" style="min-width: 240px;">
<?php include 'sidebar.php'; ?>
</div>

<style>
.img-album {
min-height: 120px;
background-color: transparent;
border-radius: 5px;
}
@media (max-width: 575.98px) {
	
    .card-img-top {
    height: 45vw;
    }
}
.fullscreen {
    background:transparent;
    border:0;
    width: 100% !important;
    height: 100% !important;
    margin: 0;
    top: 0;
    left: 0;
}
.comdiv .card {
    background-color: #fff;
    border: none
}

.comdiv .form-color {
    background-color: #fafafa
}

.comdiv .form-control {
    height: 48px;
    border-radius: 25px
}

.comdiv .form-control:focus {
    color: #495057;
    background-color: #fff;
    border-color: #35b69f;
    outline: 0;
    box-shadow: none;
    text-indent: 10px
}

.comdiv .c-badge {
    background-color: #35b69f;
    color: white;
    height: 20px;
    font-size: 11px;
    width: 92px;
    border-radius: 5px;
    display: flex;
    justify-content: center;
    align-items: center;
    margin-top: 2px
}

.comdiv .comment-text {
    font-size: 13px
}

.comdiv .wish {
    color: #35b69f
}

.comdiv .user-feed {
    font-size: 14px;
    margin-top: 12px
}
.btn-delcom {
	display: inline-block;
padding: .25em .4em;
  padding-right: 0.4em;
  padding-left: 0.4em;
font-size: 75%;
font-weight: 700;
line-height: 1;
text-align: center;
white-space: nowrap;
vertical-align: baseline;
color: #fff;
background-color: #007bff;
}
</style>

<?php
$sql = "SELECT *,COUNT(comment_id) AS comtotal FROM tbl_comment WHERE comImgid='$id'";
$result = mysqli_query($conn, $sql);
while($row = mysqli_fetch_assoc($result)) {
	$comtotal = $row['comtotal'];
}
	?> 

<div id="page-content-wrapper">
<div class="container-fluid mt-4">
<section class="Latest Video">
<nav aria-label="breadcrumb">
  <ol class="breadcrumb">
    <li class="breadcrumb-item"><a href="/"><?php echo $lang['home']; ?></a></li>
    <li class="breadcrumb-item"><a href="#" onclick="history.back()" >Album</a></li>
    <li class="breadcrumb-item active" aria-current="page"><?php echo $lang['comment']; ?> [<?php echo $comtotal; ?>]</li>
  </ol>
</nav>


<div class="row comdiv"> 
<div class="col-lg-3"> 
<?php
$usemail = $_COOKIE['photouser'];
$sql = "SELECT * FROM images,album,users WHERE images.albumId=album.albumId AND users.usemail='$usemail' AND images.id='$id' GROUP BY images.id";
$result = mysqli_query($conn, $sql);
$row = mysqli_fetch_assoc($result);
	?>
<img class="mt-3 img-album img-fluid pb-3" src="<?php echo $row['albumUrl']; ?>/<?php echo $row['file_name']; ?>" alt="">

</div>

<div class="col-lg-6 offset-lg-1"> 

<div class="row height d-flex align-items-center">
        <form method="POST" id="comment_form">
      <input type="hidden" name="comImgid" id="comImgid" value="<?php echo $id; ?>">
    <div class="form-group">
     <input type="hidden" name="comment_name" id="comment_name" value="<?php echo $_COOKIE['photouser']; ?>" />
    </div>
    <div class="form-group">
     <input name="comment_content" id="comment_content" class="form-control" placeholder="<?php echo $lang['entercomment']; ?>">
    </div>
    <div class="form-group">
     <input type="hidden" name="comment_id" id="comment_id" value="0" />
     <input type="submit" name="submit" id="submit" class="btn btn-info" value="Submit" style="visibility: hidden;" />
    </div>
   </form>
   <p id="comment_message"></p>
   
   <div id="display_comment"></div>
    </div>
</div>
</div>
</div>
</section>	
</div>
</div>
</div>

<script>
$(document).ready(function(){
 
 $('#comment_form').on('submit', function(event){
  event.preventDefault();
  var form_data = $(this).serialize();
  $.ajax({
   url:"add_comment.php?id=<?php echo $id; ?>",
   method:"POST",
   data:form_data,
   dataType:"JSON",
   success:function(data)
   {
    if(data.error != '')
    {
     $('#comment_form')[0].reset();
     $('#comment_message').html(data.error);
     $('#comment_id').val('0');
     load_comment();
    }
   }
  })
 });

 load_comment();

 function load_comment()
 {
  $.ajax({
   url:"fetch_comment.php?id=<?php echo $id; ?>",
   method:"POST",
   success:function(data)
   {
    $('#display_comment').html(data);
   }
  })
 }

 $(document).on('click', '.reply', function(){
  var comment_id = $(this).attr("id");
  $('#comment_id').val(comment_id);
  $('#comment_name').focus();
 });
 
});
</script>

<?php include('footer.php');?>