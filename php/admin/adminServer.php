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


    // Book Section

    // Add Book Section

    if(isset($_POST["adminAddBook"])){
        //get new book information
        $author = $_POST["author"];
        $title = $_POST["title"];
        $category = $_POST["category"];
        $year = $_POST["year"];
        $isbn = $_POST["isbn"];

        //do validations 

        if(empty($author)){
            array_push($errors, "Author is required");
        }
        if(empty($title)){
            array_push($errors, "Title is required");
        }
        if(empty($category)){
            array_push($errors, "Category is required");
        }
        if(empty($year)){
            array_push($errors, "Year is required");
        }
        if(empty($isbn)){
            array_push($errors, "ISBN is required");
        }

        //check is year and ISBN are numbers 
        if(!is_numeric($year)){
            array_push($errors, "Year must be a number");
        }
        if(!is_numeric($isbn)){
            array_push($errors, "ISBN must be a number");
        }


        //check if ISBN is unique 
        $isbn_query = "SELECT * FROM books WHERE isbn='$isbn' LIMIT 1";
        $isbn_result = mysqli_query($db, $isbn_query);
        $isbn_book = mysqli_fetch_assoc($isbn_result);
        if($isbn_book){
            if($isbn_book["isbn"] === $isbn){
                array_push($errors, "ISBN is already taken");
            }
        }

        //check if title AND author is unique
        $title_query = "SELECT * FROM books WHERE title='$title' AND author='$author'LIMIT 1";
        $title_result = mysqli_query($db, $title_query);
        $title_book = mysqli_fetch_assoc($title_result);
        if($title_book){
            echo "title: " . $title_book["title"] . "author " . $title_book["author"] . "category" . $title_book["category"] . "year " . $title_book["year"] . "isbn: " . $title_book["isbn"];
            if($title_book["title"] === $title && $title_book["author"] === $author){
                array_push($errors, "A book with the same title and author already exists");
            }
        }

        if(count($errors) === 0){
            $query = "INSERT INTO books(author, title, category, year, isbn)
            VALUES ('$author', '$title', '$category', '$year', '$isbn')";
            mysqli_query($db, $query);
            header("Location: http://localhost:8888/php/admin/overview.php");
        }



<<<<<<< HEAD
    }

    // Admin Delete User Section

    if(isset($_POST["adminDeleteBook"])){
        if($_POST["deleteBook"] == "invalid"){
            //cannot delete default value
            array_push($errors, "Please pick a valid user");
        }
        if(count($errors) === 0){
            $isbn = $_POST["deleteBook"];
            // echo "The user id is: " . $user_id;
            $query = "DELETE FROM books WHERE isbn='$isbn'";
            mysqli_query($db, $query);
            header("Location: http://localhost:8888/php/admin/overview.php");
        }
=======
>>>>>>> c1eb3f8e5aedaa8f7dc8c6af6f2e0da2b135a408
    }

?>










?>