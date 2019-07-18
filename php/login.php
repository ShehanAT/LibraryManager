<?php include "server.php"; ?>
<!DOCTYPE html>
<html>
<head>
    <title>Library Manager</title>
    <?php include "imports.php"; ?>
</head>
<body>
<?php include "navbar.php"; ?>
<div class="header">
    <h2>Login</h2>
</div>
    
<form action="login.php" method="post">
    <?php include "errors.php"; ?>
    <div class="input-group">
        <label for="username">Username:</label>
        <input type="text" name="username">
    </div>
    <div class="input-group">
        <label for="password">Password:</label>
        <input type="password" name="password">
    </div>
    <div class="input-group">
        <button class="btn btn-primary" name="login_user" type="submit">Login</button>
    </div>
    <p>
    Not a member? <a href="register.php">Sign up</a>
    </p>





</form>
</body>
</html>