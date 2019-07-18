<?php 
session_start();
?>
<html>
    <head>
    <?php include "imports.php" ?>
    </head>
    <body>
      <?php include "navbar.php"; ?>
      <div class="heading">
        
        <h1 class="heading__main">Welcome to Shehan's Library Management System</h1>
        <h3 class="heading-sub">Made for COMP-3340 Final Project</h3>
        <?php echo "Updated: The username is " . $_SESSION["username"] . " The user_id is " . $_SESSION["user_id"]; ?>
     </div>
  
    </body>
</html>