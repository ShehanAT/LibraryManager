<?php 
session_start();
// *** loans table MUST contain at least one record for the issueBook functionality to work
// echo $_SESSION["username"];

$username = "";
$email = "";
$userCode = "";
$errors = array();

$db = mysqli_connect("localhost", "root", "root", "atukoran_db");
if(isset($_POST['new_user'])){
    $username = mysqli_real_escape_string($db, $_POST["username"]);
    $email = mysqli_real_escape_string($db, $_POST["email"]);
    $password = mysqli_real_escape_string($db, $_POST["password"]);
    $confirmPassword = mysqli_real_escape_string($db, $_POST["confirmPassword"]);
    $userCode = mysqli_real_escape_string($db, $_POST["userCode"]);

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
        array_push($errors, "Confirm password is required");
    }
    if($password != $confirmPassword){
        array_push($errors, "Passwords do not match");
    }
    if(empty($userCode)){
        array_push($errors, "Current Status is required");
    }

    $user_check_query = "SELECT * FROM users WHERE username='$username' OR email='$email' LIMIT 1";
    $result = mysqli_query($db, $user_check_query);
    $user = mysqli_fetch_assoc($result);

    if($user){
        if($user["username"] === $username){
            array_push($errors, "Username already exists");
        }
        if($user["email"] === $email){
            array_push($errors, "Email already exists");
        }
    }
    //finally register the user if there are no errors in the form 
    if(count($errors) == 0){
        $password = md5($password);//encrypting the password before saving it to the database
        $query = "INSERT INTO users (username, email, password)
                  VALUES('$username', '$email', '$password')";
        mysqli_query($db, $query);
        $_SESSION["username"] = $username;
        $_SESSION["success"] = "You are now logged in";
        header("location: index.php");
    }
}

if(isset($_POST["login_user"])){
    $username = mysqli_real_escape_string($db, $_POST["username"]);
    $password = mysqli_real_escape_string($db, $_POST["password"]);
    if(empty($username)){
        array_push($errors, "Username is required");
    }
    if(empty($password)){
        array_push($errors, "Password is required");
    }
    if(count($errors) == 0){
        $password = md5($password);//encrypting password
        $query = "SELECT * FROM users WHERE username='$username' AND password='$password'";
        $results = mysqli_query($db, $query);
        if(mysqli_num_rows($results) == 1){
            
            $_SESSION["username"] = $username;
    
            $row = mysqli_fetch_assoc($results);
            
            $_SESSION["user_id"] = $row["user_id"];
        
            $_SESSION["success"] = "You are now logged in.";
            $_SESSION["loggedIn"] = true;
            header("location: homeAuth.php");
        }else{
            array_push($errors, "Wrong username and/or password");
        }
    }
}
if(isset($_POST["add_book"])){
    $author = mysqli_real_escape_string($db, $_POST["author"]);
    $title = mysqli_real_escape_string($db, $_POST["title"]);
    $category = mysqli_real_escape_string($db, $_POST["category"]);
    $year = mysqli_real_escape_string($db, $_POST["year"]);
    $isbn = mysqli_real_escape_string($db, $_POST["isbn"]);
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
        array_push($errors, "ISBN number is required");
    }
    if(count($errors) == 0){
        $query = "INSERT INTO books(author, title, category, year, isbn) VALUES ('$author', '$title', '$category', '$year', '$isbn');";
        $results = mysqli_query($db, $query);
        if(!$results){
            array_push($errors, mysqli_error($db));
        }else{
            $_SESSION["success"] = "Added new book.";
        }
    }
}
if(isset($_POST["issueBook"])){

    $book_id = $_POST["book_id"];
    $username = $_SESSION["username"];
    $user_query = "SELECT * FROM users WHERE username='$username' LIMIT 1";
    $result = mysqli_query($db, $user_query);
    $row = mysqli_fetch_assoc($result);
    $user_id = $row["user_id"];
    
    //check if book is available



    //check if current user already loaned the book

    $loaned_on = date("Y-m-d");
    $return_by = date("Y-m-d", time() + (21 * 24 * 60 * 60));
    echo "Today is: " . $loaned_on . "Return by: " . $return_by;
    $loan_query = "INSERT INTO loans (book_id, user_id, loaned_on, return_by) 
    VALUES('$book_id', '$user_id', '$loaned_on', '$return_by')";
    $loan_results = mysqli_query($db, $loan_query);
    $row = mysqli_fetch_assoc($loan_results);
    header('Location: ./userProfile/userIssued.php');
}

// User Return book section
if(isset($_POST["returnBook"])){
    $book_id = $_POST["return_book"];
    
    //insert current time into returned_on column
    $returned_on = date("Y-m-d");
    // $query = "UPDATE"
}





?>