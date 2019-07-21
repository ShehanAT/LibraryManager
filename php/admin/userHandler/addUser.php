<?php 
session_start();
include "../adminServer.php";
?>


<!doctype html>
<html lang="en">
  <head>
    <title>Library Manager</title>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
  </head>
  <body>
    <?php include "../../navbar.php"; ?>
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
        <small id="helpId" class="text-muted">password must be at least 6 characters</small>
      </div>
      <div class="form-group">
        <label for="confirmPassword">Confirm Password:</label>
        <input type="password" name="confirmPassword" id="confirmPassword" class="form-control" placeholder="" aria-describedby="helpId">
        <small id="helpId" class="text-muted"></small>
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
    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
  </body>
</html>