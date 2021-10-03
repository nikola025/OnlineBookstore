<?php
    require_once 'header.php';
    if (!$loggedin){
        header("Location: login.php");
    }
    $kname = $kaddress = $kpost = $ktown = $kphone = $kemail ="";
    $knameError = $kaddressError = $kpostError = $ktownError = $kphoneError = $kemailError = "";

    $result  = queryMysql("SELECT * from accounts WHERE user_id = $id");
    if($result->num_rows > 0){
        $row = $result->fetch_assoc();
        $kname = $row['kname']; 
        $kaddress = $row['kaddress'];
        $kpost = $row['post'];
        $ktown = $row['town'];
        $kphone = $row['phone'];
        $kemail = $row['email']; 
    }

    if($_SERVER['REQUEST_METHOD'] == "POST"){
        $kname = $address = $kpost = $ktown = $kphone = $kemail ="";
        $knameError = $addressError = $kpostError = $townError = $kphoneError = $kemailError = "";
        if(!empty($_POST['kname'])){
            $kname = sanitizeString($_POST['kname']);
        } else {
            $knameError = "Morate uneti vaše ime i prezime!";
        }
        if(!empty($_POST['kaddress'])){
            $kaddress = sanitizeString($_POST['kaddress']);
        } else {
            $kaddressError = "Unesite vašu adresu!";
        }
        if(!empty($_POST['kpost'])){
            $kpost = sanitizeString($_POST['kpost']);
        } else {
            $kpostError = "Poštanski broj je obavezan!";
        }
        if(!empty($_POST['ktown'])){
            $ktown = sanitizeString($_POST['ktown']);
        } else {
            $ktownError = "Mesto je obavezno!";
        }
        if(!empty($_POST['kphone'])){
            $kphone = sanitizeString($_POST['kphone']);
        } else {
            $kphoneError = "Morate uneti vaš broj telefona!"; 
        }
        if(empty($_POST['kemail'])){
            $kemailError = "Email polje ne može ostati prazno!";
        } else {
            $kemail = sanitizeString($_POST['kemail']);
            if(!filter_var($kemail, FILTER_VALIDATE_EMAIL)){
                $kemailError = "Loš format email-a!";
                $email = "";
            }
        }
        if ($knameError == "" && $kaddressError == "" && $kpostError =="" && $ktownError ==""&& $kphoneError ==""&& $kemailError == ""){
           if($result->num_rows > 0){
                queryMysql("UPDATE accounts
                SET kname = '$kname',
                    kaddress = '$kaddress',
                    post = '$kpost',
                    town = '$ktown',
                    phone = '$kphone',
                    email = '$kemail'
                    WHERE user_id = $id");
           } else {
                queryMysql("INSERT INTO accounts(user_id, kname, kaddress, post, town, phone, email) 
                     VALUE($id, '$kname', '$kaddress', '$kpost', '$ktown', '$kphone', '$kemail');  
                ");
           }
        }
    }

?>

    <div class="content">
    
    <form action="" method = "POST">
        <h3>Unesite ili izmenite informacije vezane za dostavu</h3>   
        <label for="">Ime i prezime ili naziv firme</label><br>
        <input type="text" name="kname" id="kname" value= "<?php echo $kname ?>">
        <span class="error">*<?php echo $knameError; ?></span><br>
        <label for="kaddress">Adresa (ulica i broj)</label><br>
        <input type="text" name="kaddress", id="kaddress", value="<?php echo $kaddress ?>">
        <span class="error">*<?php echo $kaddressError; ?></span><br>
        <label for="kpost">Poštanski broj</label><br>
        <input type="text" name="kpost", id="kpost", value="<?php echo $kpost ?>">
        <span class="error">*<?php echo $kpostError; ?></span><br>
        <label for="ktown">Mesto</label><br>
        <input type="text" name="ktown", id="ktown", value="<?php echo $ktown ?>">
        <span class="error">*<?php echo $ktownError; ?></span><br>
        <label for="kphone">Kontakt telefon</label><br>
        <input type="text" name="kphone", id="kphone", value="<?php echo $kphone ?>">
        <span class="error">*<?php echo $kphoneError; ?></span><br>
        <label for="kemail">Email</label><br>
        <input type="text" name="kemail", id="kemail", value="<?php echo $kemail ?>">
        <span class="error">*<?php echo $kemailError; ?></span><br>
        <input id="submit" type="submit" value="Sačuvaj podatke">
    
    </form>

    </div>

</div>
</body>
</html>