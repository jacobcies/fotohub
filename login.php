<?php
ob_start();
session_start();
include 'settings.php';
//random code for authentication

$n=6;
function getRandomString($n) {
    $characters = '0123456789';
    $randomString = '';
  
    for ($i = 0; $i < $n; $i++) {
        $index = rand(0, strlen($characters) - 1);
        $randomString .= $characters[$index];
    }
  
    return $randomString;
}

//function for check user details

function getUserIpAddr(){
    if(!empty($_SERVER['HTTP_CLIENT_IP'])){
        //ip from share internet
        $ip = $_SERVER['HTTP_CLIENT_IP'];
    }elseif(!empty($_SERVER['HTTP_X_FORWARDED_FOR'])){
        //ip pass from proxy
        $ip = $_SERVER['HTTP_X_FORWARDED_FOR'];
    }else{
        $ip = $_SERVER['REMOTE_ADDR'];
    }
    return $ip;
}

//google recaptcha


//login



if (isset($_POST['login']) && !empty($_POST['user']) 
               && !empty($_POST['password'])) {
               	
               	$user = $_POST['user'];
               	
          include_once("db_connect.php");
          $sql = "SELECT * FROM users WHERE usemail='$user'";
		    $result = $conn->query($sql);
          while($row = $result->fetch_assoc()) { 
          	$usemail = $row['usemail'];
          	$uspasswd = $row['uspasswd'];
				$userlevel = $row['userlevel'];
				$userLang = $row['userLang'];
           }   
           				
               if ($_POST['user'] == $usemail && $_POST['password'] == $uspasswd) {
                  $_SESSION['valid'] = true;
                  $_SESSION['timeout'] = time();
                  $_SESSION['photouser'] = $usemail;
                  
                  $chk = $_POST['chk'];
                  if(isset($chk)) {
                  setcookie("photouser", "$usemail", time()+3600*24*30);
                  setcookie("userlevel", "$userlevel", time()+3600*24*30);
                  setcookie("userLang", "$userLang", time()+3600*24*30);
                  } else {
                  setcookie("photouser", "$usemail");	
                  setcookie("userlevel", "$userlevel");
                  setcookie("userLang", "$userLang");	
                                    
               }
               
               $randomUser = getRandomString($n);
                 
					$to = $usemail;
					$subject = "FotoHub Activation Code";
					$txt = "This is your activation key from FotoHub.
					\nUser: ".$usemail." want to login.
					\nHe/She is comming from IP ".getUserIpAddr()."\n\n
					\nCode is: ".$randomUser."
					\nThank You\nPhotoHub";
					$headers = $usemail;
					mail($to,$subject,$txt,$headers);
                              
               $sql = "UPDATE users SET userLoged=1,userCode='$randomUser' WHERE usemail='$user'";
					if (mysqli_query($conn, $sql)) {}
                  
                  header('Refresh: 0; URL = loginCode');
                                  
               } else {
               $to = $usemail;
					$subject = "Photo Album";
					$txt = "Someone try to use your email to login to FotoHub.";
					$headers = $usemail;
					mail($to,$subject,$txt,$headers); 
	
            $msg['login'] = 'Upss, something went wrong. Please try again.';	
	}
            
            
            } 
        
         	
         
            
            ?>
<!doctype html>
<html lang="en">
<head> 
  <meta name="robots" content="noindex">
<meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="shortcut icon" href="assets/img/ico.png" />
    <title>Login</title>
    <script src="https://kit.fontawesome.com/d30718abd4.js" crossorigin="anonymous">
    </script>
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.11.0/umd/popper.min.js"></script>
<link href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" rel="stylesheet">
<link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&family=Roboto:wght@100;300;400;500;700;900&display=swap" rel="stylesheet"> 
<style type="text/css">
html, body { 
  background: url(<?php echo $setlogwallpaper; ?>) no-repeat center center fixed; 
  -webkit-background-size: cover;
  -moz-background-size: cover;
  -o-background-size: cover;
  background-size: cover;
  height: 100%;
  overflow-x: hidden;
      font-family: 'Poppins', sans-serif;
    font-family: 'Roboto', sans-serif;
}

.card {
	background-color: #fff;
	border-radius: 0;
	box-shadow: rgba(60, 78, 91, 0.3 ) 5px 5px 50px 50px;
	}

.card0 {
    
    border-radius: 0px
}

.card2 {
    margin: 0px 40px;
    padding:0 100px;
}
.border-line {
    border-right: 1px solid #EEEEEE
}

.line {
    height: 1px;
    width: 40%;
    background-color: #E0E0E0;
    margin-top: 10px
}

.or {
    width: 20%;
    font-weight: bold
}

.text-sm {
    font-size: 14px !important
}
.text-icon {
	font-size: 18px !important;
	color: #ccc;
}

::placeholder {
    color: #BDBDBD;
    opacity: 1;
    font-weight: 300
}

:-ms-input-placeholder {
    color: #BDBDBD;
    font-weight: 300
}

::-ms-input-placeholder {
    color: #BDBDBD;
    font-weight: 300
}

input,
textarea {
    padding: 10px 12px 10px 12px;
    border: 1px solid lightgrey;
    border-radius: 2px;
    margin-bottom: 5px;
    margin-top: 2px;
    width: 100%;
    box-sizing: border-box;
    color: #2C3E50;
    font-size: 14px;
    letter-spacing: 1px
}

input:focus,
textarea:focus {
    -moz-box-shadow: none !important;
    -webkit-box-shadow: none !important;
    box-shadow: none !important;
    border: 1px solid #304FFE;
    outline-width: 0
}

button:focus {
    -moz-box-shadow: none !important;
    -webkit-box-shadow: none !important;
    box-shadow: none !important;
    outline-width: 0
}

a {
    color: inherit;
    cursor: pointer
}

.btn-blue {
    background-color: #1A237E;
    width: 150px;
    color: #fff;
    border-radius: 2px;
    font-weight: 700;
}

.btn-blue:hover {
    background-color: #000;
    cursor: pointer;
    color: #fff;
    
}

.bg-blue {
    color: #fff;
    background-color: #1A237E
}
.lighthouse {
	position: absolute;
	bottom: 0px;
	right: 100px;
	height: 100px;
	padding-left: 20px;
}
.lighthouse p {
	color: #fff;
	padding-bottom: 0;
	margin-bottom: 0;
	font-weight: bold;
	font-size: 14px;
}
.lighthouse span {
	color: #fff;
	font-size: 12px;
}
@media screen and (max-width: 991px) {
    .logo {
        margin-left: 0px
    }

    .image {
        width: 300px;
        height: 220px
    }

    .border-line {
        border-right: none
    }

    .card2 {
        border-top: 1px solid #EEEEEE !important;
        margin: 0px;
        padding: 0 25px;
    }
    .line {
    display: none;
}

.or {
    width: 100%;
    font-weight: bold
}
.findus {
	display: none;
}
}


</style>  
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bulma/0.7.2/css/bulma.min.css">
     
</head>
<body> 

<div class="px-1 px-md-5 px-lg-2 px-xl-5 mx-auto">
    <div class="border-0">
        
 
 <?php echo $message; ?>            
            
            <form action="login" method="POST">
            
<div class="col-lg-6">

                <div class="card2 card border-0 vh-100">
                    <div class="row mb-4 px-3 mt-5 mt-xl-1 pt-5" style="margin:0 auto;">
                    <p class="mb-3"><?php echo $msg['login']; ?></p>
                     <img src="assets/img/logo-new.png" style="margin:0 auto;" alt="">
                    </div>
                    <div class="row px-5 mb-4">
                        <div class="line"></div> <small class="or text-center">Sign In</small>
                        <div class="line"></div>
                    </div>
                    <div class="row px-3"> <label class="mb-1">
                            <h6 class="mb-0 text-sm">Email Address</h6>
                        </label> <input class="mb-4" type="text" name="user" placeholder="Enter a valid email address"> </div>
                    <div class="row px-3 mb-3"> <label class="mb-1">
                            <h6 class="mb-0 text-sm">Password</h6>
                        </label> <input type="password" name="password" placeholder="Enter password"> </div>
                    <div class="row px-3 mb-4">
                        <div class="custom-control custom-checkbox custom-control-inline"> <input id="chk1" type="checkbox" name="chk" class="custom-control-input"> <label for="chk1" class="custom-control-label text-sm">Remember me</label> </div> <a href="#" class="ml-auto mb-0 text-sm">Forgot Password?</a>
                    </div>
                    <input type="hidden" name="recaptcha_response" id="recaptchaResponse">
                    <div class="row mb-3 px-3"> 
                    <input type="submit" name="login" class="btn btn-blue text-center w-100" value="Login">
                    
                    </div>
                    
                
                	</div>
            </div>   
                
            </form>
            
	

</div> 
</div>

<script type="text/javascript">

	$(document).ready(function() {
    $("#show_hide_password a").on('click', function(event) {
        event.preventDefault();
        if($('#show_hide_password input').attr("type") == "text"){
            $('#show_hide_password input').attr('type', 'password');
            $('#show_hide_password i').addClass( "fa-eye-slash" );
            $('#show_hide_password i').removeClass( "fa-eye" );
        }else if($('#show_hide_password input').attr("type") == "password"){
            $('#show_hide_password input').attr('type', 'text');
            $('#show_hide_password i').removeClass( "fa-eye-slash" );
            $('#show_hide_password i').addClass( "fa-eye" );
        }
    });
});

</script>
</body>
</html>