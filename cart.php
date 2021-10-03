<?php
    require_once "header.php";
    if (!$loggedin){
        header("Location: login.php");
    }
    if (isset($_GET['remove'])){
        $cartId = sanitizeString($_GET['remove']);
        queryMysql("DELETE FROM cart WHERE cart.id = $cartId");     
    }
    
    if (isset($_GET['order'])){
        $bookId = sanitizeString($_GET['order']);
        $p = queryMysql("SELECT * FROM accounts WHERE user_id=$id");
        if($p->num_rows){
            $date   = new DateTime();
            $result = $date->format('Y-m-d-H-i-s');
            $krr    = explode('-', $result);
            $result = implode("", $krr);
            queryMysql("DELETE FROM cart WHERE cart.buyer_id = $id AND cart.book_id = $bookId");
            $z = queryMysql("SELECT bname FROM books WHERE books.id = '$bookId'");
            $zz = $z->fetch_assoc();
            $zzz = $zz['bname'];
            echo "<p id='ord'>Uspesno narucena knjiga: " . "&quot" .  $zzz . "&quot" . "</p>";
            queryMysql("INSERT INTO orders(buyer_id, book_id, vreme)
            VALUES ($id, $bookId, $result)");
             
        } else {
            echo "<div class='check'>Da biste uspesno narucili knjigu neophodno je da unesete bitne informacije vezane za dostavu knjige!</div>" . "<a id='ord' href=accounts.php>Unesi podatke</a>";
        }
    }
    
?>
    <div class="content">       
    <?php
        $kbooks = false;
        $result = queryMysql("SELECT * FROM cart WHERE
        buyer_id = $id");
        echo "<ul>";
            while($row = $result->fetch_assoc()){
                echo "<li class='bookname'>";
                showBook($row['book_id']);
                echo "<br>";
                $t = $row['book_id'];
                echo "<br>";
                $k = $row['id'];
                echo "<a id='ord' href='cart.php?order=$t'>Naruči</a>";
                echo "<br>";
                echo "<br>";
                echo "<a class='author' id='rem' href='cart.php?remove=$k'>Ukloni iz korpe</a>";       
                $kbooks = true;
                echo "</li>";
                
            }
        echo "</ul>";
        if($kbooks == FALSE){
            echo "<div><h2>Vaša korpa je prazna</h2></div>";
            echo "<div class='dknjige'><a href='index.php'>Dodaj knjige</div>";        
        }
    ?>
  </div>
 





</div>
</body>
</html>