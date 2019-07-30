<?php 
session_start();
include "../adminServer.php"
?>
<!doctype html>
<html lang="en">
  <head>
  <head>
    <?php include "../../imports.php" ?>
    </head>
  </head>
  <body>
    <?php include "../../navbar.php"; ?>
    <div class="container">
    <h3>Enter new book details: </h3>
    <form action="addBook.php" method="post">
    <?php include "../../errors.php" ?>
    <div class="form-group">
        <label for="author">Author:</label>
        <input type="text" name="author" id="author" class="form-control" placeholder="" aria-describedby="helpId">
    </div>
    <div class="form-group">
        <label for="title">Title:</label>
        <input type="text" name="title" id="title" class="form-control" placeholder="" aria-describedby="helpId">
    </div>
    <div class="form-group">
        <label for="category">Select Book Category:</label>
        <select class="form-control" name="category" id="category">
          <option value="Fiction">Fiction </option>
          <option value="Non-Fiction">Non-Fiction</option>
          <option value="Play">Play</option>
          <option value="Biography">Biography</option>
        </select>
      </div>
    <div class="form-group">
        <label for="year">Year:</label>
        <input type="text" name="year" id="year" class="form-control" placeholder="" aria-describedby="helpId">
    </div>
    <div class="form-group">
        <label for="isbn">ISBN:</label>
        <input type="text" name="isbn" id="isbn" class="form-control" placeholder="" aria-describedby="helpId">
    </div>
    <div class="form-group" >
        <label for="isbn">High Priority Book?:</label>
        <select name="highPri">
          <option value="invalid">Pick book status</option>
          <option name="highPri"  class="form-control" valuearia-describedby="highPriority" aria-describedby="highPriority" value="1">Yes</option>
          <option name="highPri"  class="form-control" valuearia-describedby="highPriority" aria-describedby="highPriority" value="0">No</option>
        </select>  
    </div>
    <div class="form-group">
     <button type="submit" class="btn btn-primary" name="adminAddBook">Submit</button>
    </div>
    </form>
    </div>
  </body>
</html>
