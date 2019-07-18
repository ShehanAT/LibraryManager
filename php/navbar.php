
<html>
<head>
</head>
<body>
  <nav class="navbar navbar-expand-lg navbar-light bg-light">
    <a href="http://localhost:8888/php/homeAuth.php" class="navbar-brand">Home</a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>

    <div class="collapse navbar-collapse" id="navbarSupportedContent">
        <ul class="navbar-nav mr-auto">
            <li class="nav-item active">
                <a href="http://localhost:8888/php/login.php" class="nav-link">Login</a>
            
            </li>
            <li class="nav-item">
                <a href="http://localhost:8888/php/register.php" class="nav-link">Register</a>
            </li>
            <li class="nav-item">
                <a href="http://localhost:8888/php/issueBook.php" class="nav-link">Issue Book</a>
            </li>
            <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle" href="http://localhost:8888/php/userProfile/userProfileInfo.php" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                User Profile
                </a>
            <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                <a href="http://localhost:8888/php/userProfile/userProfileInfo.php" class="dropdown-item" href="#">Profile Info</a>
                <a href="http://localhost:8888/php/userProfile/userIssued.php" class="dropdown-item">User Profile</a>
                <a class="dropdown-item" href="#">Something else here</a>
            </div>
            </li>
            <li class="nav-item">
                <?php 
                    session_start();
                    if($_SESSION["loggedIn"]){
                        echo  "<a href='http://localhost:8888/php/home.php' class='nav-link'>Log Out</a>";
                    }
                ?>
            </li>
        </ul>
    </div>
  </nav>
    </body>
</html>
