<?php
    require_once "header.php";
    if (!$loggedin){
        header("Location: login.php");
    }
    
?>
    <div class="content">       
    <?php
        $obooks = false;
    
        $result = queryMysql("SELECT * FROM orders WHERE
        buyer_id = $id");
        echo "<ul>";
            while($row = $result->fetch_assoc()){
                echo "<li class='bookname'>";
                $v = $row['vreme'];
                showBook($row['book_id']);
                echo "<br>";
                echo "<br>";
                echo "<span id='ord'>";
                echo substr($v, 6, 2) . "." . substr($v,4,2) . "." . substr($v,0,4) . "  ,  " . substr($v,8,2) . ":" . substr($v,10,2) . ":" . substr($v,12,2);
                echo "</span>";
                echo "</li>";
                $obooks = true;
            }
        echo "</ul>";
        if($obooks == FALSE){
            echo "<div><h2>Još uvek niste kupili nijednu knjigu<h2></div>";
            echo "<div class='dknjige'><a href='index.php'>Kupi</div>";        
        }
    ?>
  </div>





</div>
</body>
</html>