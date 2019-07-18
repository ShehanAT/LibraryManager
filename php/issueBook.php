<?php include "server.php" ?>
<html>
<head>
<?php include "imports.php" ?>
<link rel="stylesheet" href="../css/form.css" />
</head>


<body>
<div class="row">
    <?php include "navbar.php"; ?>
	<div class="col-md-12">
		<form action="issueBook.php" method="post" id="post">
			<div class="form-group">
            <?php 
              $con = mysqli_connect("localhost", "root", "root", "atukoran_db");
           

            //   echo $book_query_string;
            ?>
			<label>Choose Book Title:</label>
           
			<select name="book_id" >
              <?php 
              $con = mysqli_connect("localhost", "root", "root", "atukoran_db");
              //check if book is not already issued
              $issued_book_id = array();
              $loan_query = "SELECT * FROM loans";
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
              foreach($result as $value){
                  $book_title = $value["title"];
                  $book_id = $value["book_id"];
                  echo "
                  <option value=$book_id>
                   $book_title
                  </option>
                  ";
              }
              
              ?>
            </select>
			</div>
            <div class="input-group">
            <button type="submit" class="btn" name="issueBook">Submit</button>
            </div>
            
		
</body>
</html>