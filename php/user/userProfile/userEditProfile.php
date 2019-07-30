<?php 
session_start();
include "../../server.php";
?>
<!DOCTYPE html>
<html lang="en">
  <head>
  <head>
    <?php include "../../imports.php" ?>
    </head>
  </head>
  <body>
  <?php include "../../navbar.php"; ?>
  <div class="container">
  <form action="userEditProfile.php" method="post">
    <h3>Edit User Info:</h3>
    <?php include "../../errors.php"; ?>
    <div class="form-group"  id="editColumn">
        <label for="selectUpdateUser" >Select category to edit:</label>
        <select class="form-control" name="editColumnVal" id="editColumnVal" onchange="showNewValueField(this)">
            <option value="invalid" default>Pick category</option>
            <option value="username">Username</option>
            <option value="email">Email</option>
            <option value="password">Password</option>
        </select>
    </div>
    <div class="form-group" id="editText">
          <label for="editTextVal">Enter new value:</label>
          <input type="text"
            class="form-control" name="editTextVal" id="editTextVal" aria-describedby="helpId">
          <small id="helpId" class="form-text text-muted">New values must be valid.</small>
    </div>
    <div class="form-group" style="display:none;" id="editPassword">
          <label for="editPasswordVal">Enter new password:</label>
          <input type="password"
            class="form-control" name="editPasswordVal" id="editPasswordVal" aria-describedby="helpId">
          <small id="helpId" class="form-text text-muted">Passwords must match</small>
    </div>
    <div class="form-group" style="display:none;" id="editPassword2">
          <label for="editPasswordVal2">Confirm new password:</label>
          <input type="password"
            class="form-control" name="editPasswordVal2" id="editPasswordVal2" aria-describedby="helpId">
          <small id="helpId" class="form-text text-muted">Passwords must match</small>
    </div>


        <button type="submit" onClick="javascript: return confirm('Are you sure you want to edit this info?')" class="btn btn-primary" name="userEditInfo">Save Changes</button>
      </form>
    </div>
    <script src="http://localhost:8888/php/admin/js/eventHandlers.js"></script>
  </body>
</html>