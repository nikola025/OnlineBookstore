<?php 
    require_once "header.php";

    $error = "";
    if($_SERVER["REQUEST_METHOD"] == "POST"){
        $username = $connection->real_escape_string($_POST['username']);
        $password = $connection->real_escape_string($_POST['password']);
        if($username == "" || $password == ""){
                $error = "Morate popuniti oba polja!";
        } else {
            $result = queryMysql("SELECT * FROM users WHERE username = '$username'");
            if ($result->num_rows > 0){
                $error = "Ovo korisničko ime je zauzeto, izaberite neko drugo!";
            } else {
                $codedPassword = PASSWORD_HASH($password, PASSWORD_DEFAULT);
                queryMysql("INSERT INTO users(username, password)
                    VALUES('$username','$codedPassword')");
                header("Location: login.php");
            }
        }
    }
?>
    <div class = "content">
        <h2>Napravi novi nalog</h2>
        <div class="error">
            <?php echo $error; ?>
        </div>
        <form action="signup.php" method="post">
            <label for="username">Korisničko ime:</label><br>
            <input type="text" name="username" id="username" placeholder="Unesite korisničko ime" onBlur = "checkUser(this)">
            <br>
            <label for="password">Lozinka:</label><br>
            <input type="password" name="password" id="password" placeholder="Unesite lozinku">
            <br>
            <input id="submit" type="submit" value="Registruj se!">
        </form>
    </div>
</div>
<script src="script/myscript.js"></script>
<script>
    function checkUser(inp){
        var username = inp.value;
        if(username == ''){
            document.getElementsByClassName('error')[0].innerHTML = "";
            return;
        }

        var params = "username=" + username;
        var request = ajaxRequest();
        if (request !==false){
            request.open("POST","checkuser.php", true);
            request.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
            request.setRequestHeader("Content-length", params.length);
            request.setRequestHeader("Connection","close");
            
            request.onreadystatechange = function(){
                if(this.readyState == 4 && this.status == 200){
                    document.getElementsByClassName('error')[0].innerHTML = this.responseText;
                }
            }
            request.send(params);
        }

    }

    
    
</script>
</body>
</html>