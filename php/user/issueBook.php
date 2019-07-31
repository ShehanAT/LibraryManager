<?php 
session_start();
include "../server.php"; 
?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <?php include "../imports.php"; ?>
  </head>
<script>
  $(document).ready(function(){
    $("#searchBook").keyup(function(){
        $.post("search.php?searchBook=" +  $("#searchBook").val(), function(data, status){
             $("#searchData").html(data);
        });
    });
    $(".dropdown-content").on("click", function(){
        console.log("passing");
        return confirm("Are you sure you want to issue this book?")
    })
    $("#searchData").on("focusout", function(){
      console.log("passing2");
      $("#searchData").empty();//for emptying search dropdown items on focus out
    })

});

</script>
<body>
    <?php include "../navbar.php"; ?>
<div class="container">
<div class="row">

	<div class="col-md-12">
		<form action="issueBook.php" method="post" id="post">
      <div class="form-group">
        <label for="searchBook"></label>
        <input type="text" id="searchBook" name="searchBook"/>
        <div id="searchData"></div>
        <?php require_once "./search.php"; ?>
      </div>
			<div class="form-group" id="issue_book_select_container">
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
                echo "
                <p>All books are loaned out. Please wait untill we have some books available</p>
                </div>
                </form>
                ";
              }else{
                echo "
                <label>Choose Book:</label>
                <select name='book_id' id='issue_book_select' >
                ";
                foreach($result as $value){
                    $book_title = $value["title"];
                    $book_author = $value["author"];
                    $book_year = $value["year"];
                    $book_id = $value["book_id"];
                    echo "
                    <option value=$book_id>
                    Title: $book_title | Author: $book_author | Year: $book_year
                    </option>
                    ";
                }
                echo " 
                </select>
                </div>
                <div class='form-group'>
                <button type='submit' class='btn btn-primary' name='issueBook'>Submit</button>
                </div>
                </div>
                </form>";
              }
              ?>
              <?php 
                $con = mysqli_connect("localhost", "root", "root", "atukoran_db");
                $current_user_id = $_SESSION["user_id"];
                if(!$_SESSION["waitlist_book_id"]){//when it is the first time using waitlist
                  $query = "SELECT * FROM loans WHERE returned_on IS NULL AND user_id != $current_user_id";
                  $results = mysqli_query($con, $query);
                  echo "
                  <div class='container'>
                  <form action='issueBook.php' method='post'>
                  <div class='waitlist__section form-group'>
                  <h2>Join a waitlist for an issued book:</h2>
                  <select name='waitlist_value' id='waitlist_select'>
                  <option value='invalid'>Pick an issued book</option>
                  ";
                  while($row = mysqli_fetch_assoc($results)){
                    $book_id = $row["book_id"];
                    $user_id =  $row["user_id"];
                    //get book info
                    $book_query = "SELECT * FROM books WHERE book_id='$book_id' LIMIT 1";
                    $book_result = mysqli_query($con, $book_query);
                    $book = mysqli_fetch_assoc($book_result);
                    $book_title = $book["title"];
                    $book_author = $book["author"];
                    $book_category = $book["category"];
                    $book_year = $book["year"];
                    //get user info
                    $user_query = "SELECT * FROM users WHERE user_id='$user_id' LIMIT 1";
                    $user_result = mysqli_query($con, $user_query);
                    $user = mysqli_fetch_assoc($user_result);
                    $username = $user["username"];
                    echo "<option value='$book_id'>Book title:$book_title, Author:$book_author, Year:$book_year, Category:$book_category, Loaned by:$username</option>";
                  }
                  echo "
                  </select>
                  </div>
                  <div class='form-group'>
                  <button class='btn btn-primary' type='submit' name='add_waitlist'>Join waitlist</button>
                  </div>
                  </form>
                  </div>
                </div>
                </div>
                  ";
                }else{//if current user want to be added to multiple waitlists, this removes the waitlists that he is already subscribed to 
                  $book_id = $row["book_id"];
                  $user_id =  $row["user_id"];
                  $exclude_current_waitlist = "(" . $_SESSION["waitlist_book_id"] . ")";
                  //getting all loans excluding the ones under the current user's name
                  $query = "SELECT * FROM loans WHERE returned_on IS NULL AND user_id != $current_user_id AND book_id != $exclude_current_waitlist";
                  $results = mysqli_query($con, $query);
                  echo "
                  
                  <form action='issueBook.php' method='post'>
                  <div class='waitlist__section form-group'>
                  <h2>Join a waitlist for an issued book:</h2>
                  <select name='waitlist_value'>
                  <option value='invalid'>Pick an issued book</option>
                  ";
                  while($row = mysqli_fetch_assoc($results)){
                    $book_id = $row["book_id"];
                    $user_id =  $row["user_id"];
                    //get book info
                    $book_query = "SELECT * FROM books WHERE book_id='$book_id' LIMIT 1";
                    $book_result = mysqli_query($con, $book_query);
                    $book = mysqli_fetch_assoc($book_result);
                    $book_title = $book["title"];
                    $book_author = $book["author"];
                    $book_category = $book["category"];
                    $book_year = $book["year"];
                    //get user info
                    $user_query = "SELECT * FROM users WHERE user_id='$user_id' LIMIT 1";
                    $user_result = mysqli_query($con, $user_query);
                    $user = mysqli_fetch_assoc($user_result);
                    $username = $user["username"];
                    echo "<option value='$book_id'>Book title:$book_title, Author:$book_author, Year:$book_year, Category:$book_category, Loaned by:$username</option>";
                  }
                  echo "
                  </select>
                  </div>
                  <div class='form-group'>
                  <button class='btn btn-primary' type='submit' name='add_waitlist'>Join waitlist</button>
                  </div>
                  </form>
                  </div>
                </div>
                  ";
                }
               
              ?>
		</div>
</body>
</html>