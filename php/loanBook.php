<?php include("server.php"); ?>

<!DOCTYPE html>
<html>
<head>
    <style>
        <?php include "../css/book.css"; ?>
    </style>
</head>
<body>
    <?php include "./navbar.php" ?>
    <div class="header">
        <h2>Loan A Book</h2>
    </div>
    <form action="loanBook.php" method="post">
        <?php include "errors.php"; ?>
        <div class="input-group">
            <label for="bookTitle">Select Book Title:
            <?php 
              $server = "localhost";
              $username = "atukoran";
              $password = "wezhyp-xixwoJ-puxhu6";
              $dbName = "atukoran_db";
              $conn = new mysqli($server, $username, $password, $dbName);
              if($conn->connect_error()){
                  die("Connection failed: " . $conn->connect_error());
              }
              $query = "SELECT * FROM books";
              $results = mysqli_query($db, query);
              echo "passing1";
              if($results->num_rows > 0){
                  echo "passing2";
                  while($row = $result->fetch_assoc()){
                      echo "<option value=".$row["book_id"] .">" . $row["title"] ." by " . $row["author"] . "</option>";
                  }
              }else{
                  echo "Internal Server Error Occured.";
              }
              $conn->close();
            ?>
        
        </div>
    
    
    
    </form>
</body>

</html>