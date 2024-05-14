<?php
 
require_once("classes/database.php");
 
$con= new database();

session_start();
if(isset($_SESSION['username'])) {
  header('location: index.php');
} 
// if (empty($_SESSION["username"])) {
//   header("location: LOGIN.php");
// }    
 
if(isset($_POST['login'])){
  $username=$_POST['username'];
  $password=$_POST['pass'];
  $result=$con->check($username,$password);
 
  if($result){
  if($result['username'] == $_POST['username'] && $result['pass'] == $_POST['pass']) {
      $_SESSION['username'] = $result['username'];
      header('location:index.php');
     
  }else{
      echo "error";
  }
}
else{
  echo "error";
}
 
  }  
?>
 
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Login Page</title>
  <link rel="stylesheet" href="./bootstrap-5.3.3-dist/css/bootstrap.css">
  <!-- Bootstrap CSS -->
  <link rel="stylesheet" href="./bootstrap-4.5.3-dist/bootstrap-4.5.3-dist/css/bootstrap.css">
  <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
 <link rel="stylesheet" href="style.css">
</head>
 
 
<body>
 
 
<div class="container-fluid rounded shadow login-container">
  <h2 class="text-center mb-4">Login</h2>
 
  <form method="post">
    <div class="form-group">
      <label for="username">Username:</label>
      <input type="text" class="form-control" id="username" name="username" placeholder="Enter username">
    </div>
    <div class="form-group">
      <label for="password">Password:</label>
      <input type="password" class="form-control" id="pass" name="pass" placeholder="Enter password">
    </div>
    <div class="container">
      <div class="row gx-1">
        <div class="col">
           <input value="login" name="login" type='submit' class="btn btn-primary btn-block"></div>
        <div class="col">
          <a href="multisave.php" class="btn btn-danger btn-block">Sign Up</a>

          <!-- Delete Button -->
          

          
        </div>
      </div>
    </div>
    
   
  </form>
  
</div>
 
<!-- Bootstrap JS and dependencies -->
<link rel="stylesheet" href="bootstrap-4.5.3-dist/bootstrap-4.5.3-dist/js/bootstrap.js">
<link rel="stylesheet" href="bootstrap-5.3.3-dist/bootstrap-5.3.3-dist/js/">
<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
<script src="./bootstrap-5.3.3-dist/js/bootstrap.js"></script>
</body>