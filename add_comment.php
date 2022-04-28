<?php
$id = $_GET['id'];
//add_comment.php
include_once("db_connect.php");
$sql = "UPDATE images SET comCount=comCount+1 WHERE id='$id'";
if ($conn->query($sql) === TRUE) {}

 //$connect = new PDO('mysql:host=db5006450826.hosting-data.io;dbname=dbs5367714', 'dbu693343', 'Dd0758238@010101');

$error = '';
$comment_name = '';
$comment_content = '';

if(empty($_POST["comment_name"]))
{
 $error .= '<p class="text-danger">Name is required</p>';
}
else
{
 $comment_name = $_POST["comment_name"];
}

if(empty($_POST["comment_content"]))
{
 $error .= '<p class="text-danger">Comment is required</p>';
}
else
{
 $comment_content = $_POST["comment_content"];
 $comImgid = $_POST["comImgid"];
 date_default_timezone_set('Europe/London');
 $date = date("Y-m-d H:i:s");
}

if($error == '')
{
 $query = "
 INSERT INTO tbl_comment 
 (parent_comment_id, comment, comment_sender_name, date, comImgid) 
 VALUES (:parent_comment_id, :comment, :comment_sender_name, :date, :comImgid)
 ";
 
 $statement = $connect->prepare($query);
 $statement->execute(
  array(
   ':parent_comment_id' => $_POST["comment_id"],
   ':comment'    => $comment_content,
   ':comment_sender_name' => $comment_name,
   ':date' => $date,
   ':comImgid' => $comImgid
  )
 );
 $error = '<label class="text-success">Comment Added</label>';
}

$data = array(
 'error'  => $error
);

echo json_encode($data);

?>