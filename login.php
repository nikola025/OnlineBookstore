<?php
    require_once "header.php";
    $error = '';
    if ($_SERVER["REQUEST_METHOD"] == "POST"){
        $username = $connection->real_escape_string($_POST['username']);
        $password = $connection->real_escape_string($_POST['password']);
        if($username == "" || $password == ""){
            $error = "Korisničko ime i lozinka ne mogu ostati prazni";
        } else {
            $result = queryMysql("SELECT * FROM users WHERE username = '$username'");
            if ($connection->error){
                $error = "Error in query: $connection->error";
            } else {
                if($result->num_rows == 0){
                    $error = "Nepostojeće korisničko ime";
                } else {
                  $row = $result->fetch_assoc();
                  $codedPassword = PASSWORD_HASH($password, PASSWORD_DEFAULT);  
                  if(!password_verify($password, $row['password'])){
                      $error = "Netačna lozinka";
                  } else {
                      $_SESSION['id'] = $row['id'];
                      $_SESSION['username'] = $row['username'];
                      header("Location: index.php");
                  }
                }
            }
        }
    }
?>
    <div class="content">
        <h2>Prijavi se</h2>
        <div class="error">
            <?php echo $error; ?>
        </div>
        <form action="login.php" method="POST">
        <label for="username">Korisničko ime:</label><br>
        <input type="text" name="username" placeholder="Unesite korisničko ime" id="username">
        <br>
        <label for="password">Lozinka:</label><br>
        <input type="password" name="password" placeholder="Unesite lozinku" id="password">
        <br>
        <input id="submit" type="submit" value="Prijavi se">
        </form>
    </div>

</div>
</body>
</htmm>