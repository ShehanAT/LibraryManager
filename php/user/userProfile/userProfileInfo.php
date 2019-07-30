<?php 
session_start();
?>
<!DOCTYPE html>
<html>
<head>
    <?php include "../../imports.php" ?>
</head>
<body>
    <?php include "../../navbar.php" ?>
    <div class="container">
    <div class="heading">
        <h2>Profile Info</h2>
    </div>
   <div class="info">
    <?php
        $db = mysqli_connect("localhost", "root", "root", "atukoran_db");
        $user_id = $_SESSION["user_id"];
        $query = "SELECT * FROM users WHERE user_id='$user_id' LIMIT 1";
        //selecting the user based on stored login session data
        $result = mysqli_query($db, $query);
        $row = mysqli_fetch_assoc($result);
        $username = $row["username"];
        $email = $row["email"];
        $userType = $row["userType"];
        $user_id = $row["user_id"];
        echo "
        <div>
        <strong>Username: </strong><span>$username</span>
        </div>
        <div>
        <strong>Email: </strong><span>$email</span>
        </div>
        <div>
        <strong>User Type: </strong><span>$userType</span>
        </div>
        <div>
        <strong>User Id: </strong><span>$user_id</span>
        </div>
        ";
    ?>
   </div>
   <div class="editProfile">
      <button class="btn btn-primary" onClick="javascript: window.location.href= 'http://localhost:8888/php/user/userProfile/userEditProfile.php'">Edit Profile Info</button>
   </div>
  </div>


</body>

</html>