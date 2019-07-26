<?php 
session_start();
include "../server.php" ?>
<!doctype html>
<html lang="en">
  <head>
    <title>Library Manager</title>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <?php include "../imports.php" ?>
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
  </head>
  <body>
      <div class="row">
       <?php include "../navbar.php"; ?>
       <div class="col-md-12">
       <form action="returnBook.php" method="post" >
       <div class="form-group">
       <?php 
              $con = mysqli_connect("localhost", "root", "root", "atukoran_db");
              //check if book is not already issued
              $user_id = $_SESSION["user_id"];
              $issued_book_id = array();
              $loan_query = "SELECT * FROM loans WHERE user_id='$user_id'";
              $results = mysqli_query($con, $loan_query);
              while($row = mysqli_fetch_assoc($results)){
                  if(!$row["returned_on"]){
                    array_push($issued_book_id, $row["book_id"]);
                  }     
              }
              $issued_book_id = array_unique($issued_book_id);
              if(count($issued_book_id) == 0){
                  //user has no loaned books
                  echo "<p>You have no issued books. <a href='http://localhost:8888/php/user/issueBook.php'>Click here</a> to issue books</p>";
              }else{
                //user has loaned books
                echo "
                <label>Choose book to return :</label>
              
                <select name='return_book_id' >
                ";
                foreach($issued_book_id as $value){
                        $book_query = "SELECT * FROM books WHERE book_id='$value' LIMIT 1";
                        $book_result = mysqli_query($db, $book_query);
                        $book = mysqli_fetch_assoc($book_result);
                        $book_author = $book["author"];
                        $book_title = $book["title"];
                        $book_category = $book["category"];
                        $book_year = $book["year"];
                        $book_id = $book["book_id"];
                        echo "
                        <option value='$book_id'>
                          Title: $book_title | Author: $book_author | Category: $book_category | Year: $book_year
                        </option>
                        ";    
                }
                echo "
                </select>
                <div class='input-group'>
                <button type='submit' class='btn btn-primary' name='returnBook'>Submit</button>
                </div>
                ";
              }
              //get book info from books table
              //display all book_ids
             

        ?>
       </div>
       </form>
       </div>
      </div>
    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
  </body>
</html>