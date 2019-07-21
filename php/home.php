<?php 
session_start();
session_destroy();
?>
<!DOCTYPE html>
<html>
    <head>
    <?php include "imports.php" ?>
    </head>
    <body>
      <?php include "navbar.php"; ?>
      <div class="heading">
        
        <h1 class="heading__main">Welcome to Shehan's Library Management System</h1>
        <h3 class="heading-sub">Made for COMP-3340 Final Project</h3>
         <h4>Please log in or register to get started.</h4>
     </div>
  
    </body>
</html>