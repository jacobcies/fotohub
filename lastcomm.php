<?php 
$site = 'lastcomm';
include('header.php');
include_once("db_connect.php");
include('container.php');
function get_time_ago( $time )
{
    $time_difference = time() - $time;

    if( $time_difference < 1 ) { return 'less than 1 second ago'; }
    $condition = array( 12 * 30 * 24 * 60 * 60 =>  'year',
                30 * 24 * 60 * 60       =>  'month',
                24 * 60 * 60            =>  'day',
                60 * 60                 =>  'hour',
                60                      =>  'minute',
                1                       =>  'second'
    );

    foreach( $condition as $secs => $str )
    {
        $d = $time_difference / $secs;

        if( $d >= 1 )
        {
            $t = round( $d );
            return $t . ' ' . $str . ( $t > 1 ? 's' : '' ) . ' ago';
        }
    }
}
?>

<div class="d-flex" id="wrapper">
<div class="bg-white" id="sidebar-wrapper" style="min-width: 240px;">
<?php include 'sidebar.php'; ?>
</div>

<style>
.card-img-top {
    height: 5vw;
    width: 5vw;
    }
@media (max-width: 575.98px) {
	 .card-img-top {
    height: 15vw;
    width: 15vw;
    }
}
.table > tbody > tr > td {
     vertical-align: middle;
  border-bottom:1px dotted #ccc;
}
.com-frame {
	position: relative;
	
    
}
.img-corner {
	position: absolute;
	top: 0;
	left: 0;
	bottom: 0;
	
}
.ms-20 {
	margin-left: 80px;
}
h6 {
  font-size: 1rem;
  font-weight: 600;
}
.text-muted {
	color: #9ca3af !important;
}
img, svg {
  vertical-align: middle;
}
</style>

<?php
$sql = "SELECT *,COUNT(comment_id) AS comtotal FROM tbl_comment";
$result = mysqli_query($conn, $sql);
while($row = mysqli_fetch_assoc($result)) {
	$comtotal = $row['comtotal'];
}
	?> 

<div id="page-content-wrapper">
<div class="container mt-4">
<section class="Latest Video">
<nav aria-label="breadcrumb">
  <ol class="breadcrumb">
    <li class="breadcrumb-item"><a href="/"><?php echo $lang['home']; ?></a></li>
    <li class="breadcrumb-item active" aria-current="page"><?php echo $lang['latestcom']; ?> (<?php echo $comtotal; ?>)</li>
    
   
  </ol>
</nav>





<ul class="list-unstyled mb-7 px-2">

<?php
$sql = "SELECT * FROM images,album,tbl_comment,users WHERE images.albumId=album.albumId AND tbl_comment.comment_sender_name=users.usemail AND images.id=tbl_comment.comImgid ORDER BY tbl_comment.date DESC";
$result = mysqli_query($conn, $sql);
while($row = mysqli_fetch_assoc($result)) {
	?> 
                                <li class="mb-3">
                                 <div class="px-4 py-2 com-frame">
                                    <a href="comments?id=<?php echo $row['id']; ?>" >
<img src="<?php echo $row['albumUrl']; ?>/<?php echo $row['file_name']; ?>" class="card-img-top img-corner">
</a>
                                        <div class="d-flex ms-20 mb-2 justify-content-between">
                                            <div class="d-flex align-items-center">
                                                <h6 class="mb-0 me-3"><?php echo $row['userName']; ?> <?php echo $row['userSurname']; ?></h6>
                                                <small class="text-muted"><?php $comDate=$row['date']; echo get_time_ago( strtotime($comDate) ); ?></small>
                                            </div>
                                            
                                        </div>
                                        <p class="mb-0 ms-20">
                                            <?php echo $row['comment']; ?>
                                        </p>
                                    </div>
                                </li>
   <?php } ?>                            
                            </ul>






    
       
   
  </div>
</div>
</div>

<?php include('footer.php');?>