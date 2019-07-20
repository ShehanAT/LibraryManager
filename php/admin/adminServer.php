<?php 
session_start();
// Add User section
$errors = array();
$db = mysqli_connect("localhost", "root", "root", "atukoran_db");
if(isset($_POST["add_new_user"])){
    //add user form submitted
    $username = $_POST["username"];
    $email = $_POST["email"];
    $userType = $_POST["userType"];
    $password = $_POST["password"];
    $confirmPassword = $_POST["confirmPassword"];

    //password validators
    $uppercase = preg_match('@[A-Z]@', $password);
    $lowercase = preg_match('@[a-z]@', $password);
    $number    = preg_match('@[0-9]@', $password);
    $specialChars = preg_match('@[^\w]@', $password);
    $confirmPassword = $_POST["confirmPassword"];
    if(empty($username)){
        array_push($errors, "Username is required");
    }
    if(empty($email)){
        array_push($errors, "Email is required");
    }
    if(empty($password)){
        array_push($errors, "Password is required");
    }
    if(empty($confirmPassword)){
        array_push($errors, "Confirm Password is required");
    }
    if(empty($userType)){
        array_push($errors, "User Type is required");
    }
    if($password != $confirmPassword){
        array_push($errors, "Passwords do not match");
    }
    //password validation
    if(!$uppercase || !$lowercase || !$number || !$specialChars || strlen($password) < 6){
        array_push($errors, "Password should be at least six characters, must contain at least one uppercase letter, one lowercase letter, one number and one special character(ex:!?\/) ");
    }
    //email validation
    if(!filter_var($email, FILTER_VALIDATE_EMAIL)){
        array_push($errors, "Please enter a valid email address");
    }
    
    //checking if username and/or email is unique
    $user_check_query = "SELECT * FROM users WHERE username='$username' OR email='$email' LIMIT 1";
    $user_check_result = mysqli_query($db, $user_check_query);
    $user = mysqli_fetch_assoc($user_check_result);
    if($user){
        if($user["username"] == $username){
            array_push($errors, "Username is already taken, Please pick a different one.");
        }
        if($user["email"] === $email){
            array_push($errors, "Email is already taken, Please pick a different one.");
        }

    }

    if(count($errors) === 0){
        // user has provided valid information
        // hash password and send to database
        $password = md5($password);
        $insert_user_query = "INSERT INTO users (username, email, password, userType) 
        VALUES ('$username', '$email', '$password', '$userType')";
        mysqli_query($db, $insert_user_query);
        header("location: http://localhost:8888/php/admin/overview.php");

        }
    }

    //Delete User Section

    if(isset($_POST["adminDeleteUser"])){
        $user_id = $_POST["deleteUser"];
        // echo "The user id is: " . $user_id;
        $query = "DELETE FROM users WHERE user_id='$user_id'";
        mysqli_query($db, $query);
        header("Location: http://localhost:8888/php/admin/overview.php");
    }

?>










?>