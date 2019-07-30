<?php 
session_start();
include "../server.php"; 
?>

<!DOCTYPE html>
<html>
<head>
    <title>Library Manager</title>
    <?php include "../imports.php" ?>
</head>
<body>
    
    <?php include "../navbar.php" ?>
    <div class="container">
    <div class="header">
        <h2>Register</h2>
    </div>

    <form action="register.php" method="post" >
        <?php include "errors.php"; ?>
        <div class="form-group">
            <label for="username">Username: </label>
            <input type="text" class="form-control" name="username" value"<?php echo $username; ?>">
        </div>
        <div class="form-group">
            <label for="email">Email: </label>
            <input type="text" name="email" class="form-control" value="<?php echo $email; ?>">
        </div>
        <div class="form-group">
            <label for="password">Password: </label>
            <input type="password" class="form-control" name="password">
        </div>
        <div class="form-group">
            <label for="confirmPassword">Confirm Password: </label>
            <input type="password" class="form-control" name="confirmPassword">
        </div>
        <div class="form-group">
            <label for="userCode">Current Status:</label>
            <select name="userCode" class="form-control" value="<?php echo $userCode; ?>" form="post">Current Status: 
                <option name="undergrad" value="undergrad">Undergrad Student</option>
                <option name="grad" value="grad">Grad Student</option>
                <option name="prof" value="professor">Professor</option>
            </select>
        </div>
        <div class="form-group" >
            <button type="submit" class="btn btn-primary" name="new_user">Register</button>
        </div>
       
        <p>
            Already a member? <a href="login.php">Sign in</a>
        </p>
    </form>
  </div>
</body>
</html>