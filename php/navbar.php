<?php 
    session_start();
?>
<html>
<head>
</head>
<body>
<nav class="navbar navbar-expand-lg navbar-dark bg-primary">
    <?php
    if($_SESSION["username"] == "admin"){
        echo "<a class='navbar-brand' href='http://localhost:8888/php/homeAuthAdmin.php'>Library Manager</a>";
    }else{
        echo "<a class='navbar-brand' href='http://localhost:8888/php/homeAuthUser.php'>Library Manager</a>";
    }
    ?>
  
  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarColor01" aria-controls="navbarColor01" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>

  <div class="collapse navbar-collapse" id="navbarColor01">
    <ul class="navbar-nav mr-auto">
    <?php 
            if(!$_SESSION["loggedIn"]){
            echo "
            <li class='nav-item'>
                <a href='http://localhost:8888/php/login.php' class='nav-link'>Login</a>
            
            </li>
            <li class='nav-item'>
                <a href='http://localhost:8888/php/user/register.php' class='nav-link'>Register</a>
            </li>
            ";
            }
            else{
                if($_SESSION["username"] == "admin"){
                    echo "
                    <li class='nav-item'>
                    <a href='http://localhost:8888/php/admin/overview.php' class='nav-link'>Overview</a>
                    </li> 
                    <li class='nav-item dropdown'>
                    <a class='nav-link dropdown-toggle' href='http://localhost:8888/php/userProfile/userProfileInfo.php' id='navbarDropdown' role='button' data-toggle='dropdown' aria-haspopup='true' aria-expanded='false'>
                    Users
                    </a>
               
                    <div class='dropdown-menu' aria-labelledby='navbarDropdown'>
                        <a href='http://localhost:8888/php/admin/userHandler/addUser.php' class='dropdown-item'>Add User</a>
                        <a href='http://localhost:8888/php/admin/userHandler/deleteUser.php' class='dropdown-item'>Delete User</a>
                        <a class='dropdown-item' href='http://localhost:8888/php/admin/userHandler/updateUser.php'>Update User</a>
                        
                    </div>
                    </li> 
                    <li class='nav-item dropdown'>
                    <a class='nav-link dropdown-toggle' href='http://localhost:8888/php/userProfile/userProfileInfo.php' id='navbarDropdown' role='button' data-toggle='dropdown' aria-haspopup='true' aria-expanded='false'>
                    Books
                    </a>
               
                    <div class='dropdown-menu' aria-labelledby='navbarDropdown'>
                        <a href='http://localhost:8888/php/admin/bookHandler/addBook.php' class='dropdown-item'>Add Book</a>
                        <a href='http://localhost:8888/php/admin/bookHandler/deleteBook.php' class='dropdown-item'>Delete Book</a>
                        <a class='dropdown-item' href='http://localhost:8888/php/admin/bookHandler/updateBook.php'>Update Book</a>
                    </div>
                    </li> 
                    <li class='nav-item'>
                        <a href='http://localhost:8888/php/home.php' class='nav-link'>Log Out</a>
                    </li>
                    ";
                }else{
                    echo "
                    <li class='nav-item'>
                        <a href='http://localhost:8888/php/user/issueBook.php' class='nav-link'>Issue Book</a>
                    </li>
                    <li class='nav-item'>
                        <a href='http://localhost:8888/php/user/returnBook.php' class='nav-link'>Return Book</a>
                    </li>
                    <li class='nav-item dropdown'>
                    <a class='nav-link dropdown-toggle' href='http://localhost:8888/php/user/userProfile/userProfileInfo.php' id='navbarUserDropdown' role='button' data-toggle='dropdown' aria-haspopup='true' aria-expanded='false'>
                    User Profile
                    </a>
               
                    <div class='dropdown-menu' aria-labelledby='navbarUserDropdown'>
                        <a href='http://localhost:8888/php/user/userProfile/userProfileInfo.php' class='dropdown-item'>Profile Info</a>
                        <a href='http://localhost:8888/php/user/userProfile/userIssued.php' class='dropdown-item'>Issued Books</a>
                        <a class='dropdown-item' href='http://localhost:8888/php/user/userProfile/userOverdue.php'>Overdue Books</a>
                        <a class='dropdown-item' href='http://localhost:8888/php/user/userProfile/userDueFunds.php'>Overdue Fees</a>
                    </div>
                    </li>
                <li class='nav-item'>
                    <a href='http://localhost:8888/php/home.php' class='nav-link'>Log Out</a>
                </li>
                ";
                }
              
        }
        ?>
    </ul>
  </div>
</nav>
  <!-- <nav class="navbar navbar-expand-lg navbar-light bg-light">
    <a href="http://localhost:8888/php/homeAuth.php" class="navbar-brand">Home</a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>

    <div class="collapse navbar-collapse" id="navbarSupportedContent">
        <ul class="navbar-nav mr-auto">
            <?php 
            if(!$_SESSION["loggedIn"]){
            echo "
            <li class='nav-item'>
                <a href='http://localhost:8888/php/login.php' class='nav-link'>Login</a>
            
            </li>
            <li class='nav-item'>
                <a href='http://localhost:8888/php/user/register.php' class='nav-link'>Register</a>
            </li>
            ";
            }
            else{
                if($_SESSION["username"] == "admin"){
                    echo "
                    <li class='nav-item'>
                    <a href='http://localhost:8888/php/admin/overview.php' class='nav-link'>Overview</a>
                    </li> 
                    <li class='nav-item dropdown'>
                    <a class='nav-link dropdown-toggle' href='http://localhost:8888/php/userProfile/userProfileInfo.php' id='navbarDropdown' role='button' data-toggle='dropdown' aria-haspopup='true' aria-expanded='false'>
                    Users
                    </a>
               
                    <div class='dropdown-menu' aria-labelledby='navbarDropdown'>
                        <a href='http://localhost:8888/php/admin/userHandler/addUser.php' class='dropdown-item'>Add User</a>
                        <a href='http://localhost:8888/php/admin/userHandler/deleteUser.php' class='dropdown-item'>Delete User</a>
                        <a class='dropdown-item' href='http://localhost:8888/php/admin/userHandler/updateUser.php'>Update User</a>
                        
                    </div>
                    </li> 
                    <li class='nav-item dropdown'>
                    <a class='nav-link dropdown-toggle' href='http://localhost:8888/php/userProfile/userProfileInfo.php' id='navbarDropdown' role='button' data-toggle='dropdown' aria-haspopup='true' aria-expanded='false'>
                    Books
                    </a>
               
                    <div class='dropdown-menu' aria-labelledby='navbarDropdown'>
                        <a href='http://localhost:8888/php/admin/bookHandler/addBook.php' class='dropdown-item'>Add Book</a>
                        <a href='http://localhost:8888/php/admin/bookHandler/deleteBook.php' class='dropdown-item'>Delete Book</a>
                        <a class='dropdown-item' href='http://localhost:8888/php/admin/bookHandler/updateBook.php'>Update Book</a>
                    </div>
                    </li> 
                    <li class='nav-item'>
                        <a href='http://localhost:8888/php/home.php' class='nav-link'>Log Out</a>
                    </li>
                    ";
                }else{
                    echo "
                    <li class='nav-item'>
                        <a href='http://localhost:8888/php/user/issueBook.php' class='nav-link'>Issue Book</a>
                    </li>
                    <li class='nav-item'>
                        <a href='http://localhost:8888/php/user/returnBook.php' class='nav-link'>Return Book</a>
                    </li>
                    <li class='nav-item dropdown'>
                    <a class='nav-link dropdown-toggle' href='http://localhost:8888/php/user/userProfile/userProfileInfo.php' id='navbarUserDropdown' role='button' data-toggle='dropdown' aria-haspopup='true' aria-expanded='false'>
                    User Profile
                    </a>
               
                    <div class='dropdown-menu' aria-labelledby='navbarUserDropdown'>
                        <a href='http://localhost:8888/php/user/userProfile/userProfileInfo.php' class='dropdown-item'>Profile Info</a>
                        <a href='http://localhost:8888/php/user/userProfile/userIssued.php' class='dropdown-item'>Issued Books</a>
                        <a class='dropdown-item' href='http://localhost:8888/php/user/userProfile/userOverdue.php'>Overdue Books</a>
                        <a class='dropdown-item' href='http://localhost:8888/php/user/userProfile/userDueFunds.php'>Overdue Fees</a>
                    </div>
                    </li>
                <li class='nav-item'>
                    <a href='http://localhost:8888/php/home.php' class='nav-link'>Log Out</a>
                </li>
                ";
                }
              
        }
        ?>
        </ul>
    </div>
  </nav> -->
    </body>
</html>
