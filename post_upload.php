<?php
include_once("db_connect.php");
if(isset($_POST['post_body'],$_COOKIE['photouser'])) {

$post_title = $_POST['post_title'];
$post_body = $_POST['post_body'];
$post_photo = $_POST['post_photo'];
$post_date = date('Y-m-d H:i:s');

$sql = "INSERT INTO post (post_title, post_body, post_date, post_photo)
VALUES ('$post_title', '$post_body','$post_date','$post_photo')";

if (mysqli_query($conn, $sql)) {
  header("Location: post");
} else {
  echo "Error: " . $sql . "<br>" . mysqli_error($conn);
}
mysqli_close($conn);

}