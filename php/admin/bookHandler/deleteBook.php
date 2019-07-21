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
                $isbn = $row["isbn"];
                echo "
                    <option value='$isbn'>Title: $title | Author: $author | Category: $category | Year: $year</option>
                ";
            }

            ?>
        </select>
        </div>
         <button type="submit" onClick="javascript: return confirm('Are you sure you want to delete this book?')" class="btn btn-danger" name="adminDeleteBook">Delete Book</button>
     </form>    


  </div>
    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
  </body>
</html>