<?php
    session_start();
    require_once "functions.php";
   
        $id = $_SESSION['id'];
        $user = $_SESSION['username']; 
        
    

    if(isset($_POST['sbname'])){     
        $bname = sanitizeString($_POST['sbname']);
        
        
        $result = queryMysql("SELECT * FROM books WHERE books.bname ='$bname' OR books.bname  LIKE '%$bname%' ");
        if($result->num_rows){
            echo "<ul>";
            while($row = $result->fetch_assoc()){
                    $bookId = $row['id'];
                    echo "<li id='$bookId' class='bookname'>";
                    echo "<img src='slike/knjiga$bookId.jpg'>";
                    echo "<br>";
                    echo "<a href='index.php?show=$bookId'>";
                    echo $row['bname'];
                    echo "</a>";
                    echo "<br>";
                    echo $row['bauthor'];
                    echo "<br>";
                    echo "<span id='ord'>";
                    echo $row['bprice'];
                    echo "<span>";
                    echo "<br>";
                    echo "<a id='icart' href='index.php?buy=$bookId'>U korpu</a>";
                    echo "<br>";
                    
                    echo "</li>";
                    
                }
            echo "</ul>";
        }
        
    }

