 <?php
 ob_start();
//create htaccess
if(isset($_POST['siteurl'])) {
$serverh = $_POST['site_address'];
setcookie("serverh", "$serverh");	
$serverhost = preg_replace( "#^[^:/.]*[:/]+#i", "", $serverh );
$myhtacc = fopen("../.htaccess", "w") or die("Unable to open file!");
$htacc = '
Options +Indexes
RewriteEngine on

RewriteBase /

ErrorDocument 404 /404

RewriteCond %{REQUEST_FILENAME}\.php -f
RewriteRule ^/?(.*)$ /$1.php [L]

RewriteRule ^photo-albumNumber-(.*)-albumDate-(.*)$ /photo.php?albumNumber=$1&albumDate=$2

RewriteRule ^shared-albumNumber-(.*)$ /shared.php?albumNumber=$1

RewriteRule ^card-post_id-(.*)$ /card.php?post_id=$1

RewriteRule ^albums-albumDate-(.*)$ /albums.php?albumDate=$1

RewriteRule ^video-videoDate-(.*)$ /video.php?videoDate=$1

RewriteRule ^userbasket-(.*)$ /userbasket.php?basketimgName=$1

RewriteCond %{HTTP_REFERER} !^$
RewriteCond %{HTTP_REFERER} !^http(s)?://(www\.)?'.$serverhost.' [NC]
RewriteRule \.(jpg|jpeg|png|gif|svg|php)$ - [NC,F,L]
';
fwrite($myhtacc, $htacc);
fclose($myhtacc);
echo '<meta http-equiv="Refresh" content="0;url=database">';
}
//end create htaccess
?>




