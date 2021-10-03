<?php
    require_once "header.php";
    if (!$loggedin){
        header("Location: login.php");
    }

    if($_SERVER['REQUEST_METHOD'] == "POST"){
        $message = sanitizeString($_POST['message']);
        if($message != ""){
            $adminId = 1;
            queryMysql("INSERT INTO messages(auth_id,recip_id,message)
                        VALUE ($id, $adminId, '$message')");
            echo "<h4 class='tic'>Poruka poslata!</h4>"; 
         } else {
             echo "<h4>Ne možete poslati praznu poruku!</h4>";
         }
    }

?>

    <div class="content">       
    <h3>Kontakt:</h3>
    <form action="" method="POST">
        <h4>Pošaljite poruku adminu:</h4>
        <textarea name="message" id="message" cols="60" rows="3"></textarea>
        <br>
        <input id="submit" type="submit" value="Pošalji">
    </form>
    </div>





</div>
</body>
</html>