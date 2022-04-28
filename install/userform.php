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
  
    <title>User Form | PhotoHub</title>
  </head>
  <body>
  <div class="container mt-5 mb-5"> 
  
  
    <form method="POST" action="install-user.php" class="g-3 needs-validation" novalidate> 
    <div class="col-md-4 offset-md-4">
    <img src="https://ptest.fotohub.co.uk/assets/img/logo-new.webp" alt="PhotoHub Logo" class="img-flex"> 
    <div class="text-center"> 
    <small>Step 3/3</small>
    </div>
  <h5 class="mt-1 mb-3 text-center pb-2">User Details</h5>
   <div class="mb-3">
    <label for="inputusemail" class="form-label">Admin Email Address</label>
    <input type="email" name="usemail" class="form-control" id="inputusemail" aria-describedby="usemailHelp" placeholder="admin@email.com" required>
  <div class="valid-feedback">Valid.</div>
      <div class="invalid-feedback">Please fill out this field.</div>
  </div>
  <div class="mb-3">
    <label for="inputuspass" class="form-label">Admin Password</label>
    <input type="text" name="uspasswd" class="form-control" id="inputuspass" aria-describedby="uspassHelp" placeholder="admin password" required>
  <div class="valid-feedback">Valid.</div>
      <div class="invalid-feedback">Please fill out this field.</div>
  </div>
  <div class="mb-3">
    <label for="inputusemail" class="form-label">First Name</label>
    <input type="text" name="userName" class="form-control" id="inputusemail" aria-describedby="usemailHelp" placeholder="First Name" required>
  <div class="valid-feedback">Valid.</div>
      <div class="invalid-feedback">Please fill out this field.</div>
  </div>
  <div class="mb-3">
    <label for="inputusemail" class="form-label">Last Name</label>
    <input type="text" name="userSurname" class="form-control" id="inputusemail" aria-describedby="usemailHelp" placeholder="Last Name" required>
  <div class="valid-feedback">Valid.</div>
      <div class="invalid-feedback">Please fill out this field.</div>
  </div>
 
  
<div class="col-12">
    <div class="form-check">
      <input class="form-check-input" type="checkbox" value="" id="invalidCheck" required>
      <label class="form-check-label" for="invalidCheck">
        Agree to terms and conditions
      </label>
      <div class="invalid-feedback">
        You must agree before submitting.
      </div>
    </div>
  </div>  
  
  <div class="mt-4"> 
   <input type="submit" name="adduser" class="btn btn-primary float-end me-5" value="Submit">
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
