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
  <div class="deleteUser container">
      <form action="deleteUser.php" method="post">
      <h3>Delete User: </h3>
        <div class="form-group">
        <label for="deleteUser">Select user to be deleted:</label>
        <?php include "../../errors.php"; ?>
        <select class="form-control" name="deleteUser" >
        <option value="invalid" default>select user</option>
        <?php 
            $db = mysqli_connect("localhost", "root", "root", "atukoran_db");
            $query = "SELECT * FROM users";
            $results = mysqli_query($db, $query);
            while($row = mysqli_fetch_assoc($results)){
                $username = $row["username"];
                $email = $row["email"];
                $userId = $row["user_id"];
                $userType = $row["userType"];
                echo "
                    <option value='$userId'>Username: $username | Email: $email | User Type: $userId | User Id: $userId</option>
                ";
            }

            ?>
        </select>
        </div>
        <!--  -->
         <button type="submit" onClick="javascript: return confirm('Are you sure you want to delete this user?')" class="btn btn-danger" name="adminDeleteUser">Delete User</button>
     </form>
    </div>
    

    <script src="http://localhost:8888/php/admin/js/eventHandlers.js"></script>

  </body>
</html>