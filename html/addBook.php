<?php include("server.php"); ?>

<!DOCTYPE html>
<html>
<head>
    <style>
    <?php include "../css/addBook.css" ?>
    <style>
</head>
<body>
   <?php include "./navbar.php" ?>
   <div class="header">
     <h2>Add Book</h2>
     <p>* Must be logged in as admin to add new book</p>
   </div>
    <form action="register.php" method="post" id="post">
        <?php include "errors.php"; ?>
        <div class="input-group">
            <label for="author">Author: </label>
            <input type="text" name="author" value"<?php echo $author; ?>">
        </div>
        <div class="input-group">
            <label for="title">Title: </label>
            <input type="text" name="title" value="<?php echo $title; ?>">
        </div>
        <div class="input-group">
            <label for="category">Catetory: </label>
            <input type="text" name="category" value="<?php echo $category; ?>">
        </div>
        <div class="input-group">
            <label for="year">Year: </label>
            <input type="text" name="year" value="<?php echo $year; ?>">
        </div>
        <div class="input-group">
            <label for="isbn">ISBN: </label>
            <input type="text" name="isbn" value="<?php echo $isbn; ?>">
        </div>
        <div class="input-group" >
            <button type="submit" class="btn" name="add_book">Register</button>
        </div>
</body>
</html>