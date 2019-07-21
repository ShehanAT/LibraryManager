<?php 
session_start();
?>
<!DOCTYPE html>
<html>
<head>
    <?php include "../../imports.php" ?>
</head>
<body>
    <?php include "../../navbar.php"; ?>
    <div class="overduefee__head">
        <h2>User Profile Page</h2>
    </div>
    <div class="overduefee__body">
        <h2 class="overduefee__body__heading">Overdue Fees:</h2>
        <?php 
            $db = mysqli_connect("localhost", "root", "root", "atukoran_db");
            $user_id = $_SESSION["user_id"];
            $query = "SELECT * FROM loans WHERE user_id='$user_id' LIMIT 5";
            $results = mysqli_query($db, $query);
            

            while($row = mysqli_fetch_assoc($results)){
                $currentDate = date("Y-m-d");
                if($row["return_by"] < $currentDate){
                    $_SESSION["hasOverdue"] = true;
                }
            }


        ?>
    
        <?php 
          if($_SESSION["hasOverdue"]){
            echo "
            <table>
            <thead>
                <th>Book Title</th>
                <th>Issued On</th>
                <th>Return By</th>
            </thead>
            <tbody>
            ";
            $db = mysqli_connect("localhost", "root", "root", "atukoran_db");
            $user_id = $_SESSION["user_id"];
            $query = "SELECT * FROM loans WHERE user_id='$user_id' LIMIT 5";
            $results = mysqli_query($db, $query);
            $overdueDays = 0;
            $currentFee = 0;            
            while($row = mysqli_fetch_assoc($results)){

                $currentDate = time();
                $return_by_date = strtotime($row["return_by"]);
                if($return_by_date < $currentDate){
                    //1st data
                    //issued book is overdue
                    $book_id = $row["book_id"];
                    $book_loaned_on = rtrim($row["loaned_on"], '00:00:00');
                    $book_return_by = rtrim($row["return_by"], '00:00:00');//2nd date
                    $diff = $currentDate - $return_by_date;
                    $diff = round($diff / (60 * 60 * 24));;
                    $overdueDays += $diff;
                    $book_query = "SELECT * FROM books WHERE book_id='$book_id' LIMIT 1";
                    $book_result = mysqli_query($db, $book_query);
                    $book = mysqli_fetch_assoc($book_result);
                    $book_title = $book["title"];
                    echo "<tr class=" . "book". $book_id . ">
                    <td>$book_title</td>
                    <td>$book_loaned_on</td>
                    <td>$book_return_by</td>
                    </tr>";
                }     
            }
            $overdueFee = $overdueDays * 0.5;
            echo "
            </tbody>
            </table> 
          
            <div>
            <strong>Cummulative # of days past due date: <span>$overdueDays</span></strong>
            </div>
            <div>
            <strong>Cost per day: <span>$0.50</span></strong>
            </div>
            <div>
            <strong>Balance Due: <span>$overdueFee</span></strong>   
            </div>
            ";

          }else{
              echo "<p>You have no overdue fees on record.</p>";
          }   
        ?>
      
    </div>
    


</body>

</html>