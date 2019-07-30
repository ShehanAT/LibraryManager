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
    <div class="container">
    <div class="heading">
        <h2>User Profile Page</h2>
    </div>
    <div class="issuedBooks__body">
        <h2>All Issued Books:</h2>
        <table>
        <thead>
            <th>Book Title</th>
            <th>Issued On</th>
            <th>Return By</th>
            <th>Returned On</th>
        </thead>
        <tbody>
        <?php 
            $db = mysqli_connect("localhost", "root", "root", "atukoran_db");
            $user_id = $_SESSION["user_id"];
            $query = "SELECT * FROM loans WHERE user_id='$user_id' LIMIT 5";
            $results = mysqli_query($db, $query);
            while($row = mysqli_fetch_assoc($results)){
                $book_id = $row["book_id"];
                $book_loaned_on = rtrim($row["loaned_on"], '00:00:00');
                $book_return_by = rtrim($row["return_by"], '00:00:00');
                $book_query = "SELECT * FROM books WHERE book_id='$book_id' LIMIT 1";
                $book_result = mysqli_query($db, $book_query);
                $book = mysqli_fetch_assoc($book_result);
                $book_title = $book["title"];
                $book_returned_on = rtrim($row["returned_on"], '00:00:00');
                echo "<tr class=" . "book". $book_id . ">
                <td>$book_title</td>
                <td>$book_loaned_on</td>
                <td>$book_return_by</td>
                <td>$book_returned_on</td>
                </tr>";
            }

        ?>
        </tbody>
        </table>
    </div>
    </div>


</body>

</html>