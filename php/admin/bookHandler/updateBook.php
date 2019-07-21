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
      <div class="container">
      <form action="updateBook.php" method="post">
      <h3>Update Book: </h3>
        <?php include "../../errors.php"; ?>
        <div class="form-group">
        <label for="selectUpdateBook">Select book to update:</label>
        <select class="form-control" name="selectUpdateBook" onchange="selectCategory(this)">
            <option value="invalid" default>Pick Book</option>
        <?php 
            $db = mysqli_connect("localhost", "root", "root", "atukoran_db");
            $query = "SELECT * FROM books";
            $results = mysqli_query($db, $query);
            while($row = mysqli_fetch_assoc($results)){  
                  $author = $row["author"];
                  $title = $row["title"];
                  $category = $row["category"];
                  $year = $row["year"];
                  $isbn = $row["isbn"];
                  echo "
                      <option value='$isbn'>Title: $title | Author: $author | Category: $category | Year: $year</option>
                  ";
            }
            ?>
        </select>
        </div>
        <div class="form-group">
        <label for="selectUpdateRow" style="display: none;" id="selectRowLabel">Select category to update:</label>
        <select class="form-control" name="selectUpdateRow" style="display: none;" id="selectUpdateRow" onchange="showUpdateBookField(this)">
            <option value="invalid" default>Pick column</option>
            <option value="author">Author</option>
            <option value="title">Title</option>
            <option value="category">Category</option>
            <option value="year">Year</option>
            <option value="isbn">ISBN</option>
        </select>
        </div>
      <div class="form-group" style="display: none;" id="updateValue">
          <label for="updateValue">Enter new value:</label>
          <input type="text"
            class="form-control" name="updateValue" aria-describedby="helpId" >
          <small id="helpId" class="form-text text-muted">New values must be valid.</small>
      </div>
      <div class="form-group">
        <label for="updateCategoryValue" style="display: none;" id="selectBookCategoryLabel">Select category to update:</label>
        <select class="form-control" name="selectBookCategory" style="display: none;" id="selectBookCategory">
            <option value="invalid" default>Pick book category</option>
            <option value="Non-Fiction">Non-Fiction</option>
            <option value="Fiction">Fiction</option>
            <option value="Play">Play</option>
            <option value="Biography">Biography</option>
        </select>
        </div>
        <button type="submit" style="display: none;" onClick="javascript: return confirm('Are you sure you want to update this book?')" class="btn btn-primary" name="adminUpdateBook" id="updateBtn">Update Book</button>
      </form>
    </div>
      
    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
    <script src="http://localhost:8888/php/admin/js/eventHandlers.js"></script>
  </body>
</html>