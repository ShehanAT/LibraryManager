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
			<label>Choose Book Title:</label>
            
            <?php echo $_SESSION["user_id"]; ?> -->
            <?php echo $_SESSION["result"]; ?>
			<select name="book_id" >
              <?php 
              $con = mysqli_connect("localhost", "root", "root", "atukoran_db");
              $result = mysqli_query($con, "select * from books");
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