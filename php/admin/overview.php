<?php  
session_start();
$db = mysqli_connect("localhost", "root", "root", "atukoran_db");
?>
<!DOCTYPE html>
<html>
    <head>
    <?php include "../imports.php" ?>
    </head>
  <body>
      <?php include "../navbar.php"; ?>
      <div class="allUsers container">
      <?php
        $chart_result1 = mysqli_query($db, "SELECT category, count(*) as cnt
        FROM books
        GROUP BY category");
        
        $chart_result2 = mysqli_query($db, "SELECT userType, count(*) as cnt
        FROM users
        GROUP BY userType");

         $chart_result3 = mysqli_query($db, "SELECT user_id, count(*) as cnt
         FROM loans
         GROUP BY user_id");
       
        include "chart_file.php";
        ?>
      <h3>All Users</h3>
      <table class="table">
          <thead>
              <tr>
                  <th scope="col">Username</th>
                  <th scope="col">Email</th>
                  <th scope="col">User Type</th>
                  <th scope="col">User Id</th>
              </tr>
          </thead>
          <tbody>
            <?php 
            
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
                  <th scope="col">Title</th>
                  <th scope="col">Author</th>
                  <th scope="col">Category</th>
                  <th scope="col">Year</th>
                  <th scope="col">ISBN</th>
                  <th scope="col">Book Id</th>
                  <th scope="col">Book status</th>
              </tr>
          </thead>
          <tbody>
            <?php 
            $query = "SELECT * FROM books";
            $results = mysqli_query($db, $query);
            while($row = mysqli_fetch_assoc($results)){
                $title = $row["title"];
                $author = $row["author"];
                $category = $row["category"];
                $year = $row["year"];
                $isbn = $row["isbn"];
                $book_id = $row["book_id"];
                $book_status = "";
                switch($row["highPri"]){
                    case "1":
                        $book_status = "High priority Book";
                        break;
                    case "0":
                        $book_status = "Regular Book";
                        break;
                    default: 
                        $book_status = "";
                        break;
                }
                echo "
                <tr>
                    <td scope='row'>$title</td>
                    <td>$author</td>
                    <td>$category</td>
                    <td>$year</td>
                    <td>$isbn</td>
                    <td>$book_id</td>
                    <td>$book_status</td>
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
                  <th scope="col">Book Title</th>
                  <th scope="col">Username</th>
                  <th scope="col">Loaned On</th>
                  <th scope="col">Return By</th>
                  <th scope="col">Returned On</th>
              </tr>
          </thead>
          <tbody>
            <?php 
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
      <div class="allWaitlist container">
      <h3>All Waitlist Entries</h3>
      <table class="table">
          <thead>
              <tr>
                  <th scope="col">Book Title</th>
                  <th scope="col">Username</th>
                  <th scope="col">Waitlist Id</th>
                  <th scope="col">Currently Valid</th>
                  <th scope="col">Created On</th>
              </tr>
          </thead>
          <tbody>
            <?php 
            //selecting all records in waitlist table
            $query = "SELECT * FROM waitlist";
            $results = mysqli_query($db, $query);
            while($row = mysqli_fetch_assoc($results)){
                $book_id = $row["book_id"];
                $book_query = "SELECT * FROM books WHERE book_id='$book_id' LIMIT 1";
                $book_result = mysqli_query($db, $book_query);
                $book_title = mysqli_fetch_assoc($book_result)["title"];//book title

                //use user_id to find corresponding username in users table
                $user_id = $row["user_id"];
                $user_query = "SELECT * FROM users WHERE user_id='$user_id' LIMIT 1";
                $user_result = mysqli_query($db, $user_query);
                $username = mysqli_fetch_assoc($user_result)["username"];//username

                //store the waitlist id, isValid and created_on timestamp in variables
                $waitlist_id = $row["waitlist_id"];
                $waitlist_valid = $row["isValid"];
                if(!$waitlist_valid){
                    $waitlist_valid = "Yes";
                }else{
                    $waitlist_valid = "No";
                }
                $waitlist_created_on = substr($row["Created_on"], 0, 10);
                echo "
                <tr>
                    <td scope='row'>$book_title</td>
                    <td>$username</td>
                    <td>$waitlist_id</td>
                    <td>$waitlist_valid</td>
                    <td>$waitlist_created_on</td>
                </tr>
                ";
            }

            ?>
          </tbody>
      </table>
      
      </div>

  </body>
</html>