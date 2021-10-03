<?php
    require_once "header.php";
    if (!$loggedin){
        header("Location: login.php");
    }
    
    if (isset($_GET['remove'])){

        $bookId = sanitizeString($_GET['remove']);
            queryMysql("DELETE FROM books WHERE books.id = $bookId"); 
    }
    
?>
        <div class="content">
            <?php  
                $result = queryMysql("SELECT * FROM books");
                echo"<ul>";
                while($row = $result->fetch_assoc()){
                    $bookId = $row['id'];
                    echo "<li <span class='bookname'>$bookId</span>";
                    echo "<br>";
                    echo "<img src='slike/knjiga$bookId.jpg'>";
                    echo "<br>";
                    echo "<a href='index.php?show=$bookId'>";
                    echo $row['bname'];
                    echo "</a>";
                    echo "<p class='author'>" .$row['bauthor']."</p>";
                    echo "<a class='remove' href='removebook.php?remove=$bookId'>Izbriši knjigu</a>";
                    echo "</li>";
                }
                echo"</ul>";
            ?>
        </div>
       
    </div>
</body>
</html> 