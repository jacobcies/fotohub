<?php
ob_start();
$serverhost = $_SERVER['HTTP_HOST'];
?>

<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
  
    <title>Install | PhotoHub</title>
  </head>
  <body>
  <div class="container mt-5 mb-5"> 
  
  
    <form class="g-3 needs-validation" action="install-add.php" method="POST" novalidate> 
    <div class="col-md-4 offset-md-4">
    <img src="https://ptest.fotohub.co.uk/assets/img/logo-new.webp" alt="PhotoHub Logo" class="img-flex"> 
    <div class="text-center"> 
    <small>Step 1/3</small>
    </div>
    
    <h5 class="mt-1 mb-3 text-center pb-2">Your Album Website URL</h5>
    
 <div class="mb-3">
    <input type="url" name="site_address" class="form-control" id="validationCustom00" placeholder="https://<?php echo $serverhost; ?>" required>
    <div class="valid-feedback">Valid.</div>
      <div class="invalid-feedback">Please fill out this field.</div>
  </div>
 
 <div class="mt-4"> 
   <input name="siteurl" type="submit" class="btn btn-primary float-end" value="Submit" >
  </div>
 
</div>
 </div> 
</form>

   
    <script>

// Example starter JavaScript for disabling form submissions if there are invalid fields
(function () {
  'use strict'

  // Fetch all the forms we want to apply custom Bootstrap validation styles to
  var forms = document.querySelectorAll('.needs-validation')

  // Loop over them and prevent submission
  Array.prototype.slice.call(forms)
    .forEach(function (form) {
      form.addEventListener('submit', function (event) {
        if (!form.checkValidity()) {
          event.preventDefault()
          event.stopPropagation()
        }

        form.classList.add('was-validated')
      }, false)
    })
})()
</script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js" integrity="sha384-IQsoLXl5PILFhosVNubq5LC7Qb9DXgDA9i+tQ8Zj3iwWAwPtgFTxbJ8NT4GN1R8p" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.min.js" integrity="sha384-cVKIPhGWiC2Al4u+LWgxfKTRIcfu0JTxR+EQDz/bgldoEyl4H0zUF0QKbrJ0EcQF" crossorigin="anonymous"></script>
 
    
  </body>
</html>
