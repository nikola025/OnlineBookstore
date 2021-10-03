<?php

require_once "functions.php";

if($_SERVER['REQUEST_METHOD'] == "POST"){
    if(isset($_POST['action'])){
        if($_POST['action'] == 'add'){
        
            $bookId = sanitizeString($_POST['bookId']);
            $id = sanitizeString($_POST['myId']);
            $result = queryMysql("SELECT * FROM cart WHERE buyer_id = $id 
                                        AND book_id = $bookId");
            if($result->num_rows == 0){
                queryMysql("INSERT INTO cart(buyer_id, book_id)
                VALUES ($id, $bookId)");
            }

            $result = queryMysql("SELECT * FROM books WHERE books.id = $bookId");
                $br = $bookId;
                $row = $result->fetch_assoc();
                    $bookId = $row['id'];
                    echo "<img src='slike/knjiga$br.jpg'>";
                    echo "<br>";
                    echo "<a href='index.php?show=$bookId'>";
                    echo $row['bname'];
                    echo "</a>";
                    echo "<br>";
                    echo $row['bauthor'];
                    echo "<br>";
                    echo $row['bprice'];
                    echo "<br>";
                    
    }

}
}