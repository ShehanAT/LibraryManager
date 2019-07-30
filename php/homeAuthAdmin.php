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
        
        <h1 class="heading__main">Welcome to Shehan's Library Management System: </h1>
        <h2 class="heading-sub">Admin Section</h2>
        <h3 class="heading-sub">Instructions to get started:</h3>
        <ul>
          <li>Overview section shows all books, users, loans and waitlisted loans</li>
          <li>User section lets you add, delete or update users</li>
          <li>Books section lets you add, delete or update books</li>
        </ul>

     </div>
  
    </body>
</html>