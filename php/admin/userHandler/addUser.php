<?php 
session_start();
include "../adminServer.php";
?>

<!doctype html>
<html lang="en">
  <head>
    <head>
    <?php include "../../imports.php" ?>
    </head>
  </head>
  <body>
    
    <?php include "../../navbar.php"; ?>
    <div class="container">
    <h3>Enter new user details:</h3>
    <form action="addUser.php" method="post">
    <?php include "../../errors.php"; ?>
    <div class="form-group">
        <label for="username">Username:</label>
        <input type="text" name="username" id="username" class="form-control" placeholder="" aria-describedby="helpId">
        <small id="helpId" class="text-muted">username must be unique</small>
      </div>
      <div class="form-group">
        <label for="email">Email:</label>
        <input type="text" name="email" id="email" class="form-control" placeholder="" aria-describedby="helpId">
        <small id="helpId" class="text-muted">email must be unique</small>
      </div>
      <div class="form-group">
        <label for="password">Password:</label>
        <input type="password" name="password" id="password" class="form-control" placeholder="" aria-describedby="helpId">
        <small id="helpId" class="text-muted">password should be at least six characters, must contain at least one uppercase letter, one lowercase letter, one number and one special character(ex:!?\/)</small>
      </div>
      <div class="form-group">
        <label for="confirmPassword">Confirm Password:</label>
        <input type="password" name="confirmPassword" id="confirmPassword" class="form-control" placeholder="" aria-describedby="helpId">
        <small id="helpId" class="text-muted">passwords must match</small>
      </div>
      <div class="form-group">
        <label for="userType">Select User Type:</label>
        <select class="form-control" name="userType" id="userType">
          <option value="undergrad">Undergrad Student</option>
          <option value="grad">Grad Student</option>
          <option value="professor">Professor</option>
        </select>
      </div>
      <button type="submit" class="btn btn-primary" name="add_new_user">Submit</button>
    </form>
    </div>
  </body>
</html>