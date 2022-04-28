<?php 
$site = 'search';
include('header.php');
include_once("db_connect.php");
$search = $_GET['s'];

?>
<style>
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
.card-img-top {
	height: 5vw; width: 5vw;
}
@media (max-width: 575.98px) {
	
    .card-img-top {
    height: 15vw;
    width: 15vw;
    }
}
p.search-url {
	padding-bottom: 0;
	margin-bottom: 0;
}
p.search-url a{
	font-size: 14px;
	line-height: 1.3;
	color: #202124;
	
}
p.search-title {
	font-size: 18px;
	font-weight: 500;
	line-height: 1.3;
	margin-bottom: 0;
	padding-bottom: 0;
	padding-top: 0;
	margin-top: 0;
}
p.search-title a {
	color: #1a0dab;
	text-decoration: none;
	}
p.search-body {
	font-size: 14px;
	line-height: 1.58;
}
td {
	border-bottom:1px dotted #ccc;
}
</style>
<?php include('container.php');?>

<div class="d-flex" id="wrapper">
<div class="bg-white" id="sidebar-wrapper" style="min-width: 240px;">
<?php include 'sidebar.php'; ?>
</div>
<div id="page-content-wrapper">
      <div class="container mt-4">
		
		<div class="section-title mb-4">
      <p>
         Results for <?php echo $_GET['s']; ?>
       </p>
      </div>
		
<div class="col-lg-12 mb-3"> 
<table class="table"> 
<?php
if(isset($_GET['s'])) {
$sql = "SELECT *,COUNT(id) AS total FROM images,album WHERE images.albumId=album.albumId AND albumTags LIKE '%$search%' GROUP BY album.albumId ORDER BY albumDate DESC";
$result = mysqli_query($conn, $sql);
if (mysqli_num_rows($result) > 0) {
while($row = mysqli_fetch_assoc($result)) {
	$albumDate = $row['albumDate'];
$a = strtotime($albumDate);
$new = date("l, d F Y", $a);
$year = date("Y", $a);
$tooldate = date('d F Y', $a);
	?>
	
	<tr> 
	<td style="width: 8%;"> 
	<a href="photo-albumNumber-<?php echo $row['albumNumber']; ?>-albumDate-<?php echo $year; ?>">
   <img src="<?php echo $row['albumCover']; ?>" class="card-img-top">
   </a>
   </td>
   <td>                
    <p class="search-title">
    <a href="photo-albumNumber-<?php echo $row['albumNumber']; ?>-albumDate-<?php echo $year; ?>">
     <?php echo $row['albumName']; ?> &#8226; Album 
	</a>  
    </p>
    <p class="search-body"> 
    <?php echo $tooldate; ?> &#8226; 
    <?php echo $row['total']; ?> <?php echo $lang['items']; ?>
    </p>
    </td>
    </tr>
                 
         

<?php    
  }
} else { ?>
  
<? }}	?>

<!-- Video search -->


<?php
if(isset($_GET['s'])) {
$sql = "SELECT * FROM video WHERE videoTags LIKE '%$search%' ORDER BY videoDate DESC";
$result = mysqli_query($conn, $sql);
if (mysqli_num_rows($result) > 0) {
while($row = mysqli_fetch_assoc($result)) {
	$videoDate = $row['videoDate'];
$a = strtotime($videoDate);
$vnew = date("l, d F Y", $a);
$vyear = date("Y", $a);
$vtooldate = date('d F Y', $a);
?>
<tr> 
	<td style="width: 8%;"> 
	<a class="spotlight" href="videos/<?php echo $row['videoUrl']; ?>" data-poster="videos/thumb/<?php echo $row['videoThumb']; ?>" data-preload="true" data-title="<?php echo $row['videoName']; ?>" data-media="video" data-download="true" data-description="<?php echo $new; ?>" data-play="true" data-preload="true">
 
   <img src="videos/thumb/<?php echo $row['videoThumb']; ?>" class="card-img-top">
   </a>
   </td>
   <td>                
   
    <p class="search-title">
    <a class="spotlight" href="videos/<?php echo $row['videoUrl']; ?>" data-poster="videos/thumb/<?php echo $row['videoThumb']; ?>" data-preload="true" data-title="<?php echo $row['videoName']; ?>" data-media="video" data-download="true" data-description="<?php echo $new; ?>" data-play="true" data-preload="true">
 
     <?php echo $row['videoName']; ?> &#8226; Video 
	</a>  
    </p>
    <p class="search-body"> 
    <?php echo $vtooldate; ?> 
    </p>
    </td>
    </tr>
</div>
<?php
}
} else { ?>
<?php }} ?>


<!-- Blog search -->

<?php
if(isset($_GET['s'])) {
$sql = "SELECT * FROM post WHERE post_body LIKE '%$search%' OR post_title LIKE '%$search%' ORDER BY post_date DESC";
$result = mysqli_query($conn, $sql);
if (mysqli_num_rows($result) > 0) {
while($row = mysqli_fetch_assoc($result)) {
	$post_date = $row['post_date'];
$a = strtotime($post_date);
$pnew = date("l, d F Y", $a);
$pyear = date("Y", $a);
$ptooldate = date('d F Y', $a);
?>
<tr>
<td style="width: 0;"> 
	
   </td> 
	<td>                
   
    <p class="search-title">
    <a href="card-post_id-<?php echo $row['post_id']; ?>">
     <?php echo $row['post_title']; ?> &#8226; Blog 
	</a>  
    </p>
    <p class="search-body"> 
    <?php echo $ptooldate; ?> 
    </p>
    </td>
    </tr>
</div>
<?php
}
} else { ?>
<?php }} ?>

</table>
</div>
</div>
</div>
</div>
</div>
</div>
</div>
<?php include('footer.php');?>
