<?php
    require_once 'header.php';
    if (!$loggedin){
        header("Location: login.php");
    }
    $bname = $bauthor = $bprice = $bdesc = "";
    $bnameError = $bauthorError = $bpriceError = $bdescError = "";


    if($_SERVER['REQUEST_METHOD'] == "POST"){

        if(!empty($_POST['bname'])){
            $bname = sanitizeString($_POST['bname']);
        } else {
            $bnameError = "Unesite ime knjige!";
        }
        if(!empty($_POST['bauthor'])){
            $bauthor = sanitizeString($_POST['bauthor']);
        } else {
            $bauthorError = "Unesite ime autora!";
        }
        if(!empty($_POST['bprice'])){
            $bprice = sanitizeString($_POST['bprice']);
        } else {
            $bpriceError = "Unesite cenu knjige!";
        }
        if(!empty($_POST['bdesc'])){
            $bdesc = sanitizeString($_POST['bdesc']);
        } else {
            $bdescError = "Unesite opis knjige!";
        }
        
        if ($bnameError == "" && $bauthorError == "" && $bpriceError =="" && $bdescError ==""){
                queryMysql("INSERT INTO books(bname, bauthor, bprice, bdesc) 
                     VALUE('$bname', '$bauthor', '$bprice', '$bdesc');  
                ");
           echo "<p class='tic'>Knjiga je uspešno dodata!</p>";
           $bname = $bauthor = $bprice = $bdesc = "";
        }  
    }

?>

    <div class="content">
    
    <form action="" method = "POST">
        <label for="bname">Ime knjige:</label><br>
        <input type="text" name="bname" id="bname" value= "<?php echo $bname ?>">
        <span class="error"><?php echo $bnameError; ?></span><br>
        <label for="bauthor">Autor:</label><br>
        <input type="text" name="bauthor", id="bauthor", value="<?php echo $bauthor ?>">
        <span class="error"><?php echo $bauthorError; ?></span><br>
        <label for="bprice">Cena:</label><br>
        <input type="text" name="bprice", id="bprice", value="<?php echo $bprice ?>">
        <span class="error"><?php echo $bpriceError; ?></span><br>
        <label for="bdesc">Opis:</label><br>
        <textarea name="bdesc" id="bdesc" cols="30" rows="4"><?php echo $bdesc?></textarea>
        <span class="error"><?php echo $bdescError; ?></span><br>
        <input id="submit" type="submit" value="Dodaj knjigu">
    
    </form>

    </div>

</div>
</body>
</html>