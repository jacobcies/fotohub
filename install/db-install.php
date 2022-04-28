<?php


$sql = "CREATE TABLE album (
  albumId int(11) NOT NULL AUTO_INCREMENT,
  albumName varchar(255) NOT NULL,
  albumDesc varchar(255) NOT NULL,
  albumDate date NOT NULL,
  albumUrl varchar(255) NOT NULL,
  albumTumb varchar(255) NOT NULL,
  albumNumber varchar(255) NOT NULL,
  albumCover varchar(250) DEFAULT NULL,
  albumTags varchar(255) DEFAULT NULL,
  albumLat varchar(50) DEFAULT NULL,
  albumLng varchar(50) DEFAULT NULL,
  albumZoom int(2) DEFAULT NULL,
  albumBlog varchar(100) DEFAULT NULL,
  PRIMARY KEY (albumId)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;";
if ($conn->query($sql) === TRUE) {
  echo "Table album created successfully";
} else {
  echo "Error creating table: " . $conn->error;
}
//----------------------------------------------------

$sql = "INSERT INTO album (albumId, albumName, albumDesc, albumDate, albumUrl, albumTumb, albumNumber, albumCover, albumTags, albumLat, albumLng, albumZoom, albumBlog) VALUES
(1, 'Forest', 'Forest Photos', '2022-03-25', 'album/Forest', 'album/Forest/tumb', '815539', 'album/Forest/scott-walsh-CQl3Y5bV6FA-unsplash.jpg', '', NULL, NULL, NULL, NULL),
(2, 'Cars', 'Photos of cars', '2022-03-25', 'album/Cars', 'album/Cars/tumb', '597261', 'album/Cars/alex-suprun-A53o1drQS2k-unsplash.jpg', '', NULL, NULL, NULL, NULL),
(3, 'City', 'City Photos', '2021-03-25', 'album/City', 'album/City/tumb', '393127', 'album/City/andrea-cau-nV7GJmSq3zc-unsplash.jpg', '', '', '', 0, ''),
(4, 'Lake', 'Pictures of Lakes', '2022-03-25', 'album/Lake', 'album/Lake/tumb', '879292', 'album/Lake/aaron-burden-aRya3uMiNIA-unsplash.jpg', 'lake,march', '-3.126806001402366', ' -60.03553600344806', 5, '');";
if ($conn->query($sql) === TRUE) {
  echo "entered to album successfully";
} else {
  echo "Error creating table: " . $conn->error;
}
//----------------------------------------------------------
$sql = "CREATE TABLE basket (
  basketid int(11) NOT NULL AUTO_INCREMENT,
  basketOwner varchar(200) NOT NULL,
  basketItem int(11) NOT NULL,
  basketDate datetime NOT NULL,
  PRIMARY KEY (basketid)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;";
if ($conn->query($sql) === TRUE) {
  echo "Created basket successfully";
} else {
  echo "Error creating table: " . $conn->error;
}
//---------------------------------------------------------------

$sql = "CREATE TABLE basketimg (
  basketimgid int(11) NOT NULL AUTO_INCREMENT,
  basketimgOwner varchar(200) NOT NULL,
  basketimgItem int(10) NOT NULL,
  basketimgDate datetime NOT NULL,
  basketimgName varchar(200) DEFAULT NULL,
  PRIMARY KEY (basketimgid)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;";
if ($conn->query($sql) === TRUE) {
  echo "Created basketimg successfully";
} else {
  echo "Error creating table: " . $conn->error;
}
//----------------------------------------------------------------

$sql = "CREATE TABLE images (
  id int(11) NOT NULL AUTO_INCREMENT,
  albumId int(11) NOT NULL,
  file_name varchar(255) NOT NULL,
  upload_time timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  photo_date varchar(200) NOT NULL,
  photo_note varchar(250) DEFAULT NULL,
  photo_fav int(11) NOT NULL,
  comCount int(11) DEFAULT 0,
  PRIMARY KEY (id)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;";
if ($conn->query($sql) === TRUE) {
  echo "Created images successfully";
} else {
  echo "Error creating table: " . $conn->error;
}
//------------------------------------------------------------------------

$sql = "INSERT INTO images (id, albumId, file_name, upload_time, photo_date, photo_note, photo_fav, comCount) VALUES
(1, 1, 'scott-walsh-CQl3Y5bV6FA-unsplash.jpg', '2022-03-25 13:53:11', '', '', 0, 0),
(2, 1, 'luca-bravo-ESkw2ayO2As-unsplash.jpg', '2022-03-25 13:53:13', '', '', 0, 0),
(3, 2, 'tyler-clemmensen-4gSavS9pe1s-unsplash.jpg', '2022-03-25 13:55:58', '', '', 0, 0),
(4, 2, 'hakon-sataoen-qyfco1nfMtg-unsplash.jpg', '2022-03-25 13:56:00', '', '', 0, 0),
(5, 2, 'alex-suprun-A53o1drQS2k-unsplash.jpg', '2022-03-25 13:56:02', '', '', 0, 0),
(6, 3, 'ryoji-iwata-n31JPLu8_Pw-unsplash.jpg', '2022-03-25 13:57:21', '', '', 0, 0),
(7, 3, 'denys-nevozhai-7nrsVjvALnA-unsplash.jpg', '2022-03-25 13:57:24', '', '', 0, 0),
(8, 3, 'andrea-cau-nV7GJmSq3zc-unsplash.jpg', '2022-03-25 13:57:25', '', '', 0, 0),
(9, 4, 'timothy-meinberg-phx4UXMQRTg-unsplash.jpg', '2022-03-25 13:58:56', '', '', 0, 0),
(10, 4, 'luca-bravo-ESkw2ayO2As-unsplash.jpg', '2022-03-25 13:58:58', '', '', 0, 0),
(11, 4, 'garrett-sears-rXVFCA3fQ4I-unsplash.jpg', '2022-03-25 13:58:59', '', '', 0, 0),
(12, 4, 'aaron-burden-aRya3uMiNIA-unsplash.jpg', '2022-03-25 13:59:00', '', '', 0, 0)";
if ($conn->query($sql) === TRUE) {
  echo "Entered to images successfully";
} else {
  echo "Error creating table: " . $conn->error;
}
//-----------------------------------------------------------------------------

$sql = "CREATE TABLE post (
  post_id int(11) NOT NULL AUTO_INCREMENT,
  post_title varchar(255) NOT NULL,
  post_body text NOT NULL,
  post_date datetime NOT NULL,
  post_photo varchar(200) DEFAULT NULL,
  post_front text DEFAULT NULL,
  PRIMARY KEY (post_id)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;";
if ($conn->query($sql) === TRUE) {
  echo "Entered to images successfully";
} else {
  echo "Error creating table: " . $conn->error;
}
//------------------------------------------------------------------------------



$sql = "CREATE TABLE settings (
  setid int(11) NOT NULL AUTO_INCREMENT,
  setlogwallpaper varchar(255) NOT NULL,
  switchvideo int(1) NOT NULL,
  switchblog int(1) NOT NULL,
  sharepasswd varchar(100) NOT NULL,
  weburl varchar(100) NOT NULL,
  mapbox varchar(255) NOT NULL,
  PRIMARY KEY (setid)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;";
if ($conn->query($sql) === TRUE) {
  echo "Table settings created successfully";
} else {
  echo "Error creating table: " . $conn->error;
}
//----------------------------------------------------------------------------------

$sql = "INSERT INTO settings (setid, setlogwallpaper, switchvideo, switchblog, sharepasswd, weburl, mapbox) VALUES
(1, 'assets/img/wallpaper/toa-heftiba-5WbYFH0kf_8-unsplash.jpg', 1, 1, 'password', 'https://site.com', 'insert token')";
if ($conn->query($sql) === TRUE) {
  echo "Inserted to settings successfully";
} else {
  echo "Error creating table: " . $conn->error;
}
//------------------------------------------------------------------------------------

$sql = "CREATE TABLE tbl_comment (
  comment_id int(11) NOT NULL AUTO_INCREMENT,
  parent_comment_id int(11) NOT NULL,
  comment varchar(200) NOT NULL,
  comment_sender_name varchar(40) NOT NULL,
  date timestamp NOT NULL DEFAULT current_timestamp(),
  comImgid int(11) NOT NULL,
  PRIMARY KEY (comment_id)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;";
if ($conn->query($sql) === TRUE) {
  echo "Creating tbl_comment successfully";
} else {
  echo "Error creating table: " . $conn->error;
}
//-------------------------------------------------------------------------------------------

$sql = "CREATE TABLE users (
  usid int(11) NOT NULL AUTO_INCREMENT,
  usemail varchar(100) NOT NULL,
  uspasswd varchar(100) NOT NULL,
  userName varchar(50) NOT NULL,
  userSurname varchar(50) NOT NULL,
  userPhoto varchar(200) NOT NULL,
  usdate timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  userlevel int(11) NOT NULL,
  userLang varchar(100) NOT NULL,
  userLoged int(1) DEFAULT NULL,
  userCode varchar(6) DEFAULT NULL,
  PRIMARY KEY (usid)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;";
if ($conn->query($sql) === TRUE) {
  echo "Creating users successfully";
} else {
  echo "Error creating table: " . $conn->error;
}
//----------------------------------------------------------------------------------------

$sql = "CREATE TABLE video (
  videoid int(11) NOT NULL AUTO_INCREMENT,
  videoName varchar(100) NOT NULL,
  videoUrl varchar(255) NOT NULL,
  videoThumb varchar(255) DEFAULT NULL,
  videoDate date NOT NULL,
  videoTags varchar(255) DEFAULT NULL,
  PRIMARY KEY (videoid)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;";
if ($conn->query($sql) === TRUE) {
  echo "Creating video successfully";
} else {
  echo "Error creating table: " . $conn->error;
}


