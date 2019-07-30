<?php 
session_start();
include "../adminServer.php";
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
      <form action="updateUser.php" method="post">
      <h3>Update User: </h3>
        <?php include "../../errors.php"; ?>
        <div class="form-group" id="user">
        <label for="selectUpdateUser">Select user to update:</label>
        <select class="form-control" name="userVal" id="userVal">
            <option value="invalid" default>Pick user</option>
        <?php 
            $db = mysqli_connect("localhost", "root", "root", "atukoran_db");
            $query = "SELECT * FROM users";
            $results = mysqli_query($db, $query);
            $userTypesArr = array(
            "undergrad" => "Undergrad Student", 
            "grad" => "Grad Student", 
            "professor" => "Professor");
            while($row = mysqli_fetch_assoc($results)){
                if($row["userType"] != "admin"){
                  $username = $row["username"];
                  $email = $row["email"];
                  $userId = $row["user_id"];
                  $userType = $row["userType"];
                  echo "
                      <option value='$userId'>Username: $username | Email: $email | User Type: $userTypesArr[$userType] | User Id: $userId</option>
                  ";
                }
             
            }
            ?>
        </select>
        </div>
        <div class="form-group"  id="userColumn">
        <label for="selectUpdateUser" >Select category to update:</label>
        <select class="form-control" name="userColumnVal" id="userColumnVal" onchange="showNewValueField(this)">
            <option value="invalid" default>Pick column</option>
            <option value="username">Username</option>
            <option value="email">Email</option>
            <option value="userType">User Type</option>
            <option value="user_id">User Id</option>
        </select>
        </div>
        <div class="form-group" style="display: none;" id="userText">
          <label for="updateValue">Enter new value:</label>
          <input type="text"
            class="form-control" name="userTextVal" id="userTextVal" aria-describedby="helpId">
          <small id="helpId" class="form-text text-muted">New values must be valid.</small>
        </div>
        <!-- if userType is selected select field will be shown    -->
        <div class="form-group" style="display: none;" id="userOption">
        <label for="updateUserTypeValue" id="selectUserTypeLabel">Select new user type:</label>
        <select class="form-control" name="userOptionVal" id="userOptionVal" >
            <option value="invalid" default>Pick user type</option>
            <option value="undergrad">Undergrad</option>
            <option value="grad">Grad</option>
            <option value="professor">Professor</option>
        </select>
        </div>
         <button type="submit" onClick="javascript: return confirm('Are you sure you want to update this user?')" class="btn btn-primary" name="adminUpdateUser">Update User</button>
     </form>
      </div>
    <script src="http://localhost:8888/php/admin/js/eventHandlers.js"></script>
  </body>
</html>