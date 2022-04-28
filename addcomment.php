<?php
include_once("db_connect.php");
if(isset($_POST['comText'],$_COOKIE['photouser'])) {
	
$comImgid = $_POST['comImgid'];
$comUser = $_POST['comUser'];
$comText = $_POST['comText'];
$comDate = $_POST['comDate'];

$sql = "INSERT INTO comment (comImgid, comUser, comText, comDate)
VALUES ('$comImgid', '$comUser', '$comText', '$comDate')";



if (mysqli_query($conn, $sql)) {
echo 'dupa';	
  
} else {
  echo "Error: " . $sql . "<br>" . mysqli_error($conn);
}
}

if(isset($_POST['deletecom'],$_COOKIE['photouser'])) {
$comment_id = $_POST['comment_id'];
$id = $_POST['id'];

$sql_1 = "UPDATE images SET comCount=comCount-1 WHERE id='$id'";
if ($conn->query($sql_1) === TRUE) {}

$sql = "DELETE FROM tbl_comment WHERE comment_id=$comment_id";
if (mysqli_query($conn, $sql)) {
 header("Location: comments?id=".$id);
} 

}