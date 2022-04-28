<?php
//create dbconnection and database

if(isset($_POST['newDatabase'])) {

$server = $_POST['server'];
$serveruser = $_POST['serveruser'];
$serverpasswd = $_POST['serverpasswd'];
$serverdb = $_POST['serverdb'];

$myfile = fopen("../db_connect.php", "w") or die("Unable to open file!");
$dbconn = '
<?php
$servername = "'.$server.'";
$username = "'.$serveruser.'";
$password = "'.$serverpasswd.'";
$dbname = "'.$serverdb.'";

$conn = mysqli_connect($servername, $username, $password, $dbname) or die("Connection failed: " . mysqli_connect_error());
if (mysqli_connect_errno()) {
    printf("Connect failed: %s\n", mysqli_connect_error());
    exit();
}

$connect = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);

?>';
fwrite($myfile, $dbconn);
fclose($myfile);

include '../db_connect.php';
include 'db-install.php';

echo '<meta http-equiv="Refresh" content="0;url=userform">';
}
//end of create dbconnection and database
?>