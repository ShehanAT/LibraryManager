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
    <link rel="stylesheet" href="../css/main.css" />
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
    
    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
    <script src="http://localhost:8888/php/admin/js/eventHandlers.js"></script>
    <!-- change the scr when uploading to myweb uwindsor -->
  </body>
</html>