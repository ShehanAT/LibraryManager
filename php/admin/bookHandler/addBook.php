<?php 
session_start();
include "../adminServer.php";
?>
<!doctype html>
<html lang="en">
  <head>
    <title>Library Manager</title>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
  </head>
  <body>
    <?php include "../../navbar.php"; ?>
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
    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
  </body>
</html>
