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
        <ul>
          <li>Click on Issue Books to borrow a book</li>
          <li>Click on User Profile to check profile info, checked out and overdue books</li>
          <li>Click on All Books to display all books currently owned by the library</li>
          <li>Click on All Loans to display all loans transitions</li>
        </ul>

     </div>
  
    </body>
</html>