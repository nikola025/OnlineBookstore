<?php
    require_once "header.php";
    if (!$loggedin){
        header("Location: login.php");
    }

    if (isset($_GET['delete'])){
        $messId = sanitizeString($_GET['delete']);
        queryMysql("DELETE FROM messages WHERE id = $messId");
    }
    
    $viewId = $id;
    $result = queryMysql("SELECT * FROM messages WHERE recip_id = $viewId ORDER BY id DESC");
    if ($result->num_rows){
        echo "<h3>Poruke korisnika:</h3>";
        while($row = $result->fetch_assoc()){
            echo "<div class='message'>";
            $authId = $row['auth_id'];
            $messId = $row['id'];
            $result1 = queryMysql("SELECT username FROM users WHERE id=$authId");
            $row1 = $result1->fetch_assoc();
            echo "<div class='user1'>Korisnik: " . $row1['username'] . " je poslao poruku: " . "<br></div>";
            echo "<div class='message1'>&quot" . $row['message'] . "&quot</div>";
            echo "<br>";
            echo "<a class='delete' href='messages.php?delete=$messId'>Izbrisi poruku</a>";
            echo "</div>";
        }
    } else {
        echo "<h3>Nemate novih poruka.</h3>";
    }
    

?>

</div>
</body>
</html>