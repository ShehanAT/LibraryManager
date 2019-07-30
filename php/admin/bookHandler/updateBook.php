<?php 
session_start();
include "../adminServer.php";
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
      <form action="updateBook.php" method="post">
      <h3>Update Book: </h3>
        <?php include "../../errors.php"; ?>
        <div class="form-group" id="book">
        <label for="selectUpdateBook">Select book to update:</label>
        <select class="form-control" name="bookVal" id="bookVal">
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
        <div class="form-group" id="bookColumn">
        <label for="selectUpdateRow" id="selectRowLabel">Select category to update:</label>
        <select class="form-control" name="bookColumnVal" id="bookColumnVal" onchange="showNewValueField(this)">
            <option value="invalid" default>Pick column</option>
            <option value="author">Author</option>
            <option value="title">Title</option>
            <option value="category">Category</option>
            <option value="year">Year</option>
            <option value="isbn">ISBN</option>
        </select>
        </div>
      <div class="form-group" style="display: none;" id="bookText">
          <label for="updateValue">Enter new value:</label>
          <input type="text"
            class="form-control" name="bookTextVal" id="bookTextVal" aria-describedby="helpId" >
          <small id="helpId" class="form-text text-muted">New values must be valid.</small>
      </div>
      <div class="form-group" style="display: none;" id="bookOption">
        <label for="updateCategoryValue" >Select category to update:</label>
        <select class="form-control" name="bookOptionVal" id="bookOptionVal" >
            <option value="invalid" default>Pick book category</option>
            <option value="Non-Fiction">Non-Fiction</option>
            <option value="Fiction">Fiction</option>
            <option value="Play">Play</option>
            <option value="Biography">Biography</option>
        </select>
        </div>
        <button type="submit" onClick="javascript: return confirm('Are you sure you want to update this book?')" class="btn btn-primary" name="adminUpdateBook">Update Book</button>
      </form>
    </div>
      
    <script src="http://localhost:8888/php/admin/js/eventHandlers.js"></script>
  </body>
</html>