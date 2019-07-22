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
		<form action="issueBook.php" method="post" id="post">
			<div class="form-group">
            <?php 
              $con = mysqli_connect("localhost", "root", "root", "atukoran_db");
              //check if book is not already issued
              $issued_book_id = array();
              $loan_query = "SELECT * FROM loans WHERE returned_on IS NULL";
              $results = mysqli_query($con, $loan_query);
              while($row = mysqli_fetch_assoc($results)){
                  array_push($issued_book_id, $row["book_id"]);
              }
              $issued_book_id = array_unique($issued_book_id);
              $book_query_string = "SELECT * FROM books WHERE book_id NOT IN (";
              foreach($issued_book_id as $value){
                  $book_query_string .= $value . " , ";
              }
              $book_query_string = rtrim($book_query_string, ", ");
              $book_query_string .= ");";
              $result = mysqli_query($con, $book_query_string);
              if(mysqli_num_rows($result) == 0){
                echo "<p>All books are loaned out. Please wait untill we have some books available</p>";
              }else{
                echo "
                <label>Choose Book Title:</label>
                <select name='book_id' >
                ";
                foreach($result as $value){
                    $book_title = $value["title"];
                    $book_id = $value["book_id"];
                    echo "
                    <option value=$book_id>
                    $book_title
                    </option>
                    ";
                }
                echo " 
                </select>
                </div>
                <div class='input-group'>
                <button type='submit' class='btn btn-primary' name='issueBook'>Submit</button>
                </div>";
              }
              ?>
        
           
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script> 
		
</body>
</html>