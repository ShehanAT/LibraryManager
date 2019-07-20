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
        if($_POST["deleteUser"] == "invalid"){
            array_push($errors, "Please pick a valid user");
        }
        if(count($errors) === 0){
            $user_id = $_POST["deleteUser"];
            // echo "The user id is: " . $user_id;
            $query = "DELETE FROM users WHERE user_id='$user_id'";
            mysqli_query($db, $query);
            header("Location: http://localhost:8888/php/admin/overview.php");
        }
    }


    // Update User Section, make server side code

    if(isset($_POST["adminUpdateUser"])){
        //values are valid 
        $userId = $_POST["selectUpdateUser"];
        $updateRow = $_POST["selectUpdateRow"];
        $updateValue = $_POST["updateValue"];

        //update info validations
        if(empty($updateValue)){
            array_push($errors, "New Value is required");
        }
        if($updateRow === "username" || $updateRow === "email"){
            //check if new username, email is unique
           
            $query = "SELECT * FROM users WHERE username='$updateValue' OR email='$updateValue' LIMIT 1";
            $result = mysqli_query($db, $query);
            $user = mysqli_fetch_assoc($result);
            if($user){
                
                switch($updateRow){
                    case "username":
                        if($user["username"] === $updateValue){
                            array_push($errors, "Username already taken");
                        }
                        break;
                    case "email":
                        if($user["email"] === $updateValue){
                            array_push($errors, "Email already taken");
                        }
                        break;
                    default:
                        break;
                }
            }
        }
        if($updateRow === "email"){
            if(!filter_var($updateValue, FILTER_VALIDATE_EMAIL)){
                //check if email is in valid format
                array_push($errors, "Please enter a valid email address");
            }
          }
        if($updateRow === "userType"){
            //check if new userType is undergrad, grad or professor, and not anything else or admin
             $updateValue = strtolower($updateValue);

            if(strcmp($updateValue, "undergrad") == 0 || strcmp($updateValue, "grad") == 0  || strcmp($updateValue, "professor") == 0 ){
              
            }else{
                echo $updateValue . " is invalid";
                array_push($errors, "User Type must be either: undergrad, grad or professor");
            }
            
        }
        
        if($updateRow === "user_id"){
            //check if new userId is unique
            $query = "SELECT * FROM users WHERE user_id='$updateValue' LIMIT 1";
            $result = mysqli_query($db, $query);
            $user = mysqli_fetch_assoc($result);
            if($user){
                if($user["user_id"] == $updateValue){
                    array_push($errors, "User Id already taken");
                }
            }
        }

        if(count($errors) == 0){
            //passed validations, now update user info
            $update_query = "UPDATE users 
            SET $updateRow='$updateValue'
            WHERE user_id='$userId'";
            mysqli_query($db, $update_query);
            header("Location: http://localhost:8888/php/admin/overview.php");
        }


        echo "user id is" . $userId . " row to update: " . $updateRow . " new value: " . $updateValue;
    }

?>










?>