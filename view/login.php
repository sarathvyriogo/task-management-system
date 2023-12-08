<!DOCTYPE html>
<html lang="en">
<?php 
session_start();
require('../config/db_connect.php');
?>
<?php 
if(isset($_SESSION['login_id']))
header("location:/view/index.php?page=home");

?>
<?php include_once 'include/header.php'; ?>
<body class="hold-transition login-page bg-black">
<div class="login-box">
  <div class="login-logo">
    <a href="#" class="text-white"><b>Task Management System</b></a>
  </div>
  <!-- /.login-logo -->
  <div class="card">
    <div class="card-body login-card-body">
      <form action="" id="login-form">
        <div class="input-group mb-3">
          <input type="email" class="form-control" name="email" required placeholder="Email">
          <div class="input-group-append">
            <div class="input-group-text">
              <span class="fas fa-envelope"></span>
            </div>
          </div>
        </div>
        <div class="input-group mb-3">
          <input type="password" class="form-control" name="password" required placeholder="Password">
          <div class="input-group-append">
            <div class="input-group-text">
              <span class="fas fa-lock"></span>
            </div>
          </div>
        </div>
        <div class="row">
          <!-- /.col -->
          <div class="col-4">
            <button type="submit" class="btn btn-primary btn-block">Sign In</button>
          </div>
          <!-- /.col -->
        </div>
      </form>
    </div>
    <!-- /.login-card-body -->
  </div>
</div>
<!-- /.login-box -->
<script>
$(document).ready(function(){

  // Event handler for form submission
  $('#login-form').submit(function(e){
    e.preventDefault(); // Prevents the default form submission behavior
    
    start_load(); // Function to initiate a loading indicator

    // Removes any existing error messages
    if($(this).find('.alert-danger').length > 0 )
      $(this).find('.alert-danger').remove();

    // AJAX request to handle the login process
    $.ajax({
      url: '/task-management-system/controller/ajax.php?action=login', // URL to the server-side script for handling login
      method: 'POST',
      data: $(this).serialize(), // Serializes form data for submission
      error: function(err){
        console.log(err);
        end_load(); // Function to end the loading indicator in case of an error
      },
      success: function(resp){
        // If the login is successful, redirect to the home page
        if(resp == 1){
          location.href ='index.php?page=home';
        } else {
          // If login fails, display an error message
          $('#login-form').prepend('<div class="alert alert-danger">Username or password is incorrect.</div>');
          end_load(); // Function to end the loading indicator
        }
      }
    });
  });
});
</script>
<?php include_once 'include/footer.php' ?>

</body>
</html>
