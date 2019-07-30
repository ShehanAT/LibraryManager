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
        
            $query = "DELETE FROM users WHERE user_id='$user_id'";
            mysqli_query($db, $query);
            header("Location: http://localhost:8888/php/admin/overview.php");
        }
    }


    // Update User Section, make server side code

    if(isset($_POST["adminUpdateUser"])){
        //values are valid 
        $userVal = $_POST["userVal"];
        $userColumnVal = $_POST["userColumnVal"];
        $userTextVal = $_POST["userTextVal"];
        $userOptionVal = $_POST["userOptionVal"];

        //doing form validations
        if($userVal === "invalid"){
            array_push($errors, "User is required.");
        }

        if($userColumnVal === "invalid"){
            array_push($errors, "User Column is required.");
        }

        if($userColumnVal === "userType"){
            //check if userTextOption is valid
            if($userOptionVal === "invalid"){
                array_push($errors, "New user type is required");
            }
        }else{
            //check if userTextVal is not empty
            if(empty($userTextVal)){
                array_push($errors, "New user value is required");
            }
        }

        
        if($userColumnVal === "username" || $userColumnVal === "email"){
            //check if new username, email is unique
           
            $query = "SELECT * FROM users WHERE username='$userTextVal' OR email='$userTextVal' LIMIT 1";
            $result = mysqli_query($db, $query);
            $user = mysqli_fetch_assoc($result);
            if($user){
                
                switch($userColumnVal){
                    case "username":
                        if($user["username"] === $userTextVal){
                            array_push($errors, "Username already taken");
                        }
                        break;
                    case "email":
                        if($user["email"] === $userTextVal){
                            array_push($errors, "Email already taken");
                        }
                        break;
                    default:
                        break;
                }
            }
        }
        if($userColumnVal === "email"){
            if(!filter_var($userTextVal, FILTER_VALIDATE_EMAIL)){
                //check if email is in valid format
                array_push($errors, "Please enter a valid email address");
            }
          }
        
        if($userColumnVal === "user_id"){
            //check if new user_id is unique
            $query = "SELECT * FROM users WHERE user_id='$userTextVal' LIMIT 1";
            $result = mysqli_query($db, $query);
            $user = mysqli_fetch_assoc($result);
            if($user){
                if($user["user_id"] == $userTextVal){
                    array_push($errors, "User Id already taken");
                }
            }
            //check if new user_id is numeric
            if(!is_numeric($userTextVal)){
                array_push($errors, "User Id must be a number");
            }
        }

        if(count($errors) == 0){
    
            //passed validations, now update user info
            if($userColumnVal === "userType"){
                $update_query = "UPDATE users 
                SET userType='$userOptionVal'
                WHERE user_id='$userVal'";
                mysqli_query($db, $update_query);
                header("Location: http://localhost:8888/php/admin/overview.php");
            }else{
                $update_query = "UPDATE users 
                SET $userColumnVal='$userTextVal'
                WHERE user_id='$userVal'";
                mysqli_query($db, $update_query);
                header("Location: http://localhost:8888/php/admin/overview.php");
            }
            
        }

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
        $highPri = $_POST["highPri"];

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
    
            if($title_book["title"] === $title && $title_book["author"] === $author){
                array_push($errors, "A book with the same title and author already exists");
            }
        }

        //check if highPri section has value value
        if($highPri == "invalid"){
            array_push($errors, "Please indicate whether book is high priority or not.");
        }

        if(count($errors) === 0){
            $query = "INSERT INTO books(author, title, category, year, isbn, highPri)
            VALUES ('$author', '$title', '$category', '$year', '$isbn', '$highPri')";
            mysqli_query($db, $query);
            header("Location: http://localhost:8888/php/admin/overview.php");
        }



    }

    // Admin Delete User Section

    if(isset($_POST["adminDeleteBook"])){
        if($_POST["deleteBook"] == "invalid"){
            //cannot delete default value
            array_push($errors, "Please pick a valid user");
        }
        if(count($errors) === 0){
            $isbn = $_POST["deleteBook"];
            $query = "DELETE FROM books WHERE isbn='$isbn'";
            mysqli_query($db, $query);
            header("Location: http://localhost:8888/php/admin/overview.php");
        }
    }

    // Admin Update User Section

    if(isset($_POST["adminUpdateBook"])){
        $bookVal = $_POST["bookVal"];//isbn of the selected book
        $bookColumnVal = $_POST["bookColumnVal"];
        $bookTextVal = $_POST["bookTextVal"];
        $bookOptionVal = $_POST["bookOptionVal"];
        $isbn = $_POST["selectUpdateBook"];
        $updateRow = $_POST["selectUpdateRow"];
        $updateValue = $_POST["updateValue"];

        if(empty($updateValue) && $updateRow != "category"){
            array_push($errors, "New value is required");
        }
        if($bookColumnVal == "category"){
            if($bookOptionVal == "invalid"){
                array_push($errors, "Valid book category is required");
            }
        }

        if($bookColumnVal === "title"){
            
            //check if author and title combo are unique
            $book_query = "SELECT * FROM books WHERE isbn='$bookVal' LIMIT 1";
            $book_result = mysqli_query($db, $book_query);
            $book = mysqli_fetch_assoc($book_result);
            $book_author = $book["author"];
            $book_title = $book["title"];
            
            //look for author of same value 
            $author_query = "SELECT * FROM books WHERE author='$book_author' AND isbn != '$bookVal'";
            $author_result = mysqli_query($db, $author_query);
            $author = mysqli_fetch_assoc($author_result);
            if($author){
                //check if the another book's title is the same as the new value
                if($author["title"] === $bookTextVal){
                    array_push($errors, "A book with the same author and title already exists");
                }
            }
        }
        if($bookColumnVal === "author"){
            
            //check if author and title combo are unique
            $book_query = "SELECT * FROM books WHERE isbn='$bookVal' LIMIT 1";
            $book_result = mysqli_query($db, $book_query);
            $book = mysqli_fetch_assoc($book_result);
            $book_author = $book["author"];
            $book_title = $book["title"];
            
            //look for author of same value 
            $author_query = "SELECT * FROM books WHERE title='$book_title' AND isbn != '$bookVal'";
            $author_result = mysqli_query($db, $author_query);
            $author = mysqli_fetch_assoc($author_result);
            if($author){
                //check if the another book's title is the same as the new value
                if($author["author"] === $bookTextVal){
                    array_push($errors, "A book with the same author and title already exists");
                }
            }
        }

        //check if year is numeric
        if($bookColumnVal === "year"){
            if(!is_numeric($bookTextVal)){
                array_push($errors, "Year must be a number");
            }
        }

        //check if ISBN is numeric 
        if($bookColumnVal === "isbn"){
            if(!is_numeric($bookTextVal)){
                array_push($errors, "ISBN must be a number");
            }
        }
        if(count($errors) == 0){
            //passed validations, now update book info
            if($bookColumnVal === "category"){
                $update_query = "UPDATE books 
                SET category='$bookOptionVal'
                WHERE isbn='$bookVal'";
                mysqli_query($db, $update_query);
                header("Location: http://localhost:8888/php/admin/overview.php");
            }else{
                $update_query = "UPDATE books 
                SET $bookColumnVal='$bookTextVal'
                WHERE isbn='$bookVal'";
                mysqli_query($db, $update_query);
                header("Location: http://localhost:8888/php/admin/overview.php");
            }

        }
    }

?>
