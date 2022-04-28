<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
<style type="text/css">
.fs-7 {
	font-size: 13px;
}
</style>

<?php
$id=$_GET['id'];
if(isset($_COOKIE['userLang'])) {include $_COOKIE['userLang'];} 
date_default_timezone_set('Europe/London');
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
//fetch_comment.php
include_once("db_connect.php");
$query = "
SELECT * FROM tbl_comment,users 
WHERE tbl_comment.comment_sender_name=users.usemail
AND tbl_comment.parent_comment_id = '0' 
AND tbl_comment.comImgid='$id'
ORDER BY tbl_comment.comment_id DESC
";

$statement = $connect->prepare($query);

$statement->execute();

$result = $statement->fetchAll();
$output = '';
foreach($result as $row)
{
	$date=$row['date'];
	$sender = $row["comment_sender_name"];
  $user = $_COOKIE["photouser"];
 if($sender == $user) {
 
 $output .= '
 <div class="panel panel-default pb-3 pt-3">
  <div class="panel-heading mb-2"><b>'.$row["userName"].' '.$row["userSurname"].'</b>  <i>'.get_time_ago( strtotime($date)).'</i>
  </div>
  <div class="panel-body">'.$row["comment"].'</div>
  <div class="panel-footer bg-light py-2">
  <form action="addcomment.php" method="POST">
  <input type="hidden" name="comment_id" value="'.$row["comment_id"].'">
  <input type="hidden" name="id" value="'.$id.'">
  <input type="submit" class="btn btn-default p-0 m-0 ps-3 fs-7" name="deletecom" value="'.$lang['delete'].'">
  </form>
  </div>
 </div>
 ';
} else {
	$output .= '
 <div class="panel panel-default pb-3 pt-3">
  <div class="panel-heading mb-2"><b>'.$row["userName"].' '.$row["userSurname"].'</b>  <i>'.get_time_ago( strtotime($date)).'</i>
  </div>
  <div class="panel-body">'.$row["comment"].'</div>
  <div class="panel-footer bg-light py-2">
  </div>
 </div>
 ';} 
 
 
 
 $output .= get_reply_comment($connect, $row["comment_id"]);
}

echo $output;

function get_reply_comment($connect, $parent_id = 0, $marginleft = 0)
{
	$id=$_GET['id'];
 $query = "
 SELECT * FROM tbl_comment,users WHERE tbl_comment.comment_sender_name=users.usemail AND tbl_comment.parent_comment_id = '".$parent_id."'
 ";
 $output = '';
 $statement = $connect->prepare($query);
 $statement->execute();
 $result = $statement->fetchAll();
 $count = $statement->rowCount();
 if($parent_id == 0)
 {
  $marginleft = 0;
 }
 else
 {
  $marginleft = $marginleft + 48;
 }
 if($count > 0)
 {
  foreach($result as $row)
  {
  	$date=$row['date'];
   $output .= '
   <div class="panel panel-default" style="margin-left:'.$marginleft.'px">
    <div class="panel-heading"><b>'.$row["userName"].' '.$row["userSurname"].'</b> <i>'.get_time_ago( strtotime($date)).'</i></div>
    <div class="panel-body">'.$row["comment"].'</div>
    <div class="panel-footer bg-light py-2">
    <button type="button" class="btn btn-default reply float-start p-0 m-0 ps-3 fs-7" id="'.$row["comment_id"].'">Reply</button>
    <form action="addcomment.php" method="POST">
  <input type="hidden" name="comment_id" value="'.$row["comment_id"].'">
  <input type="hidden" name="id" value="'.$id.'">
  <input type="submit" class="btn btn-default p-0 m-0 ps-3 fs-7" name="deletecom" value="Delete">
  </form> 
    </div>
   </div>
   ';
   $output .= get_reply_comment($connect, $row["comment_id"], $marginleft);
  }
 }
 return $output;
}

?>