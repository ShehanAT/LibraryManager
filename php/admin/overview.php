<?php  
session_start();
?>
<!doctype html>
<html lang="en">
  <head>
    <title>Library</title>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
  </head>
  <body>
      <?php include "../navbar.php" ?>
      <div class="allUsers container">
      <h3>All Users</h3>
      <table class="table">
          <thead>
              <tr>
                  <th>Username</th>
                  <th>Email</th>
                  <th>User Type</th>
                  <th>User Id</th>
              </tr>
          </thead>
          <tbody>
            <?php 
            $db = mysqli_connect("localhost", "root", "root", "atukoran_db");
            $query = "SELECT * FROM users";
            $results = mysqli_query($db, $query);
            while($row = mysqli_fetch_assoc($results)){
                $username = $row["username"];
                $email = $row["email"];
                $userId = $row["user_id"];
                $userType = $row["userType"];
                echo "
                <tr>
                    <td scope='row'>$username</td>
                    <td>$email</td>
                    <td>$userType</td>
                    <td>$userId</td>
                </tr>
                ";
            }

            ?>
          </tbody>
      </table>
      </div>
      <div class="allBooks container">
      <h3>All Books</h3>
      <table class="table">
          <thead>
              <tr>
                  <th>Title</th>
                  <th>Author</th>
                  <th>Category</th>
                  <th>Year</th>
                  <th>ISBN</th>
                  <th>Book Id</th>
              </tr>
          </thead>
          <tbody>
            <?php 
            $db = mysqli_connect("localhost", "root", "root", "atukoran_db");
            $query = "SELECT * FROM books";
            $results = mysqli_query($db, $query);
            while($row = mysqli_fetch_assoc($results)){
                $title = $row["title"];
                $author = $row["author"];
                $category = $row["category"];
                $year = $row["year"];
                $isbn = $row["isbn"];
                $book_id = $row["book_id"];
                echo "
                <tr>
                    <td scope='row'>$title</td>
                    <td>$author</td>
                    <td>$category</td>
                    <td>$year</td>
                    <td>$isbn</td>
                    <td>$book_id</td>
                </tr>
                ";
            }

            ?>
          </tbody>
      </table>
      
      </div>
      <div class="allLoans container">
      <h3>All Loans</h3>
      <table class="table">
          <thead>
              <tr>
                  <th>Book Title</th>
                  <th>Username</th>
                  <th>Loaned On</th>
                  <th>Return By</th>
                  <th>Returned On</th>
              </tr>
          </thead>
          <tbody>
            <?php 
            $db = mysqli_connect("localhost", "root", "root", "atukoran_db");
            $query = "SELECT * FROM loans";
            $results = mysqli_query($db, $query);
            while($row = mysqli_fetch_assoc($results)){
                $book_id = $row["book_id"];
                $user_id = $row["user_id"];
                $loaned_on = rtrim($row["loaned_on"], '00:00:00');
                $return_by = rtrim($row["return_by"], '00:00:00');
                $returned_on = rtrim($row["returned_on"], '00:00:00');
                //using book_id to get book title from books table
                $book_title_query = "SELECT * FROM books WHERE book_id='$book_id' LIMIT 1";
                $book_title_result = mysqli_query($db, $book_title_query);
                $book = mysqli_fetch_assoc($book_title_result);
                $book_title = $book["title"];//book title for each loan

                //using user_id to get username from users table
                $username_query = "SELECT * FROM users WHERE user_id='$user_id' LIMIT 1";
                $username_result = mysqli_query($db, $username_query);
                $user = mysqli_fetch_assoc($username_result);
                $username = $user["username"];//username for each loan
                echo "
                <tr>
                    <td scope='row'>$book_title</td>
                    <td>$username</td>
                    <td>$loaned_on</td>
                    <td>$return_by</td>
                    <td>$returned_on</td>
                </tr>
                ";
            }

            ?>
          </tbody>
      </table>
      
      </div>
    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
  </body>
</html>