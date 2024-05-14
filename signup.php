<?php
require_once('classes/database.php');
 
$con = new database();
 
if(isset($_POST['signup'])) {
    $firstname = $_POST['FirstName'];
    $lastname = $_POST['LastName'];
    $birthday = $_POST['Birthday'];
    $gender = $_POST['Gender'];
    $username = $_POST['username'];
    $password = $_POST['pass'];
    $confirm = $_POST['confirm_pass'];
 
   if($password == $confirm) {
    if ($con->signup($firstname,$lastname,$birthday,$gender,$username,$password)){
        header('location: login.php');
    } else {
        $error_message = "Username already exists. Please choose a different username";
}
 
} else {
        $error_message = "Password did not match";
}
}
 
?>
 
 <!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>SignUp Page</title>
  <link rel="stylesheet" href="./bootstrap-5.3.3-dist/css/bootstrap.css">
  <link rel="stylesheet" href="style.css">
  <!-- Bootstrap CSS -->
  <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
  <style>
    .login-container {
      max-width: 400px;
      margin: 0 auto;
      margin-top: 100px;
    }
  </style>
</head>
<body>
 
<div class="container-fluid login-container rounded shadow">
  <h2 class="text-center mb-4">Sign Up</h2>
  <form method="post">
  <div class="form-group">
      <label for="firstname">First Name:</label>
      <input type="text" class="form-control" name="FirstName" placeholder="Your First Name">
    </div>
    <div class="form-group">
      <label for="lastname">Last Name:</label>
      <input type="text" class="form-control" name="LastName" placeholder="Your Last Name">
    </div>
    <div class="mb-3">
      <label for="birthday" class="form-label">Birthday:</label>
      <input type="date" class="form-control" name="Birthday">
    </div>
    <div class="mb-3">
      <select class="form-select" aria-label="Default select example" name="Gender">
        <option selected>Gender</option>
        <option value="Male">Male</option>
        <option value="Female">Female</option>
        <option value="Choose not to Indicate">Choose not to Indicate</option>
      </select>
    </div>
    <div class="form-group">
      <label for="username">Username:</label>
      <input type="text" class="form-control"  name = 'username' placeholder="Enter Username">
    </div>
    <div class="form-group">
      <label for="password">Password:</label>
      <input type="password" class="form-control"  name = 'pass' placeholder="Enter Password">
    </div>
    <div class="form-group">
      <label for="password">Confirm Password:</label>
      <input type="password" class="form-control"  name = 'confirm_pass' placeholder="Confirm Password">
    </div>
    <div class="container">
      <div class="row gx-1">
        <div class="col">
            <input type="submit" value="Sign Up" class = "btn btn-danger btn-block" name = "signup">
        </div>
      </div>
    </div>
  </form>
</div>
 
<!-- Bootstrap JS and dependencies -->
<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
<script src="./bootstrap-5.3.3-dist/js/bootstrap.js"></script>
</body>
</html>