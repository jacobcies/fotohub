<?php 
include_once("db_connect.php");
if(isset($_POST['delete'],$_COOKIE['photouser'])) {

$post_id = $_POST['post_id'];
$sql = "DELETE FROM post WHERE post_id=$post_id";
if (mysqli_query($conn, $sql)) {
 header("Location: post");
} 
mysqli_close($conn);
}
?>
