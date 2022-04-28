<?php 
include_once("db_connect.php");
if(isset($_POST['updatePost'],$_COOKIE['photouser'])) {

$post_id = $_POST['post_id'];
$post_title = $_POST['post_title'];
$post_body = addslashes($_POST['post_body']);
$post_photo = $_POST['post_photo'];
$post_date = $_POST['post_date'];
$post_front = $_POST['post_front'];

$sql = "UPDATE post SET post_title='$post_title', post_body='$post_body',post_date='$post_date',post_photo='$post_photo',post_front='$post_front' WHERE post_id=$post_id";

if (mysqli_query($conn, $sql)) {
  header("Location: card-post_id-".$post_id);
} else {
  echo "Error updating record: " . mysqli_error($conn);
}

mysqli_close($conn);
} 
?>