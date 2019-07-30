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
  <div class="deleteBook container">
  <form action="deleteBook.php" method="post">
      <h3>Delete Book: </h3>
        <div class="form-group">
        <label for="deleteUser">Select book to be deleted:</label>
        <?php include "../../errors.php"; ?>
        <select class="form-control" name="deleteBook" >
        <option value="invalid" default>select book</option>
        <?php 
            $db = mysqli_connect("localhost", "root", "root", "atukoran_db");
            $query = "SELECT * FROM books";
            $results = mysqli_query($db, $query);
            while($row = mysqli_fetch_assoc($results)){
                $author = $row["author"];
                $title = $row["title"];
                $category = $row["category"];
                $year = $row["year"];
                $book_id = $row["book_id"];
                echo "
                    <option value='$book_id'>Title: $title | Author: $author | Category: $category | Year: $year</option>
                ";
            }

            ?>
        </select>
        </div>
         <button type="submit" onClick="javascript: return confirm('Are you sure you want to delete this book?')" class="btn btn-danger" name="adminDeleteBook">Delete Book</button>
     </form>    


  </div>

  </body>
</html>