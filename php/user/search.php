<?php

if(isset($_REQUEST["searchBook"])){
    $searchBook = $_REQUEST['searchBook'];
    $conn = new mysqli("localhost", 'root', 'root', 'atukoran_db');
    if($conn->connect_error){
        die($conn->connect_error);
    }
    $query = "SELECT * FROM books WHERE title LIKE '%$searchBook%'";
    //gets the books with title like the current input value
    $result = $conn->query($query);
    if(!$result){
        die($conn->error);
    }
    $rows = $result->num_rows;
    for($j = 0 ; $j < $rows ; ++$j){
        echo "<a href='#' class='dropdown-content' >";
        $row = $result->fetch_array(MYSQLI_ASSOC);
        echo "Title: " . $row["title"] . " Author: " . $row["author"];
        echo "</a>";
    }
    $result->close();
    $conn->close();
}

?>