<?php 
session_start();
include "server.php"; 
?>
<!DOCTYPE html>
<html>
<head>
    
    <?php include "imports.php"; ?>
</head>
<body>
<?php include "navbar.php"; ?>
<div class="header">
    <h2>Login</h2>
</div>
    
<form action="login.php" method="post">
    <?php include "errors.php"; ?>
    <div class="form-group">
        <label for="username">Username:</label>
        <input type="text" name="username" class="form-control">
    </div>
    <div class="form-group">
        <label for="password">Password:</label>
        <input type="password" name="password" class="form-control">
    </div>
    <div class="form-group">
        <button class="btn btn-primary" name="login_user" type="submit">Login</button>
    </div>
    <p>
    Not a member? <a href="register.php">Sign up</a>
    </p>
 




</form>
</body>
</html>