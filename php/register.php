<?php include("server.php"); ?>

<!DOCTYPE html>
<html>
<head>
    <style>
    <?php include "../css/form.css"?>
    </style>
</head>
<body>
    <?php include "./navbar.php" ?>
    <div class="header">
        <h2>Register</h2>
    </div>

    <form action="register.php" method="post" id="post">
        <?php include "errors.php"; ?>
        <div class="input-group">
            <label for="username">Username: </label>
            <input type="text" name="username" value"<?php echo $username; ?>">
        </div>
        <div class="input-group">
            <label for="email">Email: </label>
            <input type="text" name="email" value="<?php echo $email; ?>">
        </div>
        <div class="input-group">
            <label for="password">Password: </label>
            <input type="password" name="password">
        </div>
        <div class="input-group">
            <label for="confirmPassword">Confirm Password: </label>
            <input type="password" name="confirmPassword">
        </div>
        <div class="input-group">
            <label for="userCode">Current Status:</label>
            <select name="userCode" value="<?php echo $userCode; ?>" form="post">Current Status: 
                <option name="undergrad" value="undergrad">Undergrad Student</option>
                <option name="grad" value="grad">Grad Student</option>
                <option name="prof" value="professor">Professor</option>
            </select>
        </div>
        <div class="input-group" >
            <button type="submit" class="btn" name="new_user">Register</button>
        </div>
       
        <p>
            Already a member? <a href="login.php">Sign in</a>
        </p>
    </form>

</body>
</html>