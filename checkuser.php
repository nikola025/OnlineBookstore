<?php

require_once "functions.php"; 

if(isset($_POST['username'])){
    $username = sanitizeString($_POST['username']);
    $result = queryMysql("SELECT * FROM users WHERE username ='$username'");
    if($result->num_rows){
        echo "<span class='taken'>Ovo korisničko ime je zauzeto, izaberite neko drugo!</span>";
    } else {
        echo "<span class='available'>Ovo korisničko ime je slobodno!</span>";
    }

}