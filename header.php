<?php
    session_start();
    $loggedin = false;
    $admin = false;
    $moderator = false;
    $user = "Gost";

    if (isset($_SESSION['username'])){
        $loggedin = true;
        $id = $_SESSION['id'];
        $user = $_SESSION['username']; 
        if($id == 1){
            $admin = true;
        }
        if($id == 2){
            $moderator = true;
        }
    }
    require_once "functions.php";
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="style/style.css">
</head>
<body>
    <?php
    if (!$admin || !$loggedin) { ?>
    <div class="container">
    <div class="about">
        <a href="about.php">O nama</a>
        <a href="contact.php">Kontakt</a>
    </div> 
    </div>
    
    <?php } ?>
    <div class = "container">
        <img src="slike/knjizara.jpg" alt="Knjizara">
         
        <ul class="menu"> 
              
            <?php 
             if($admin) { ?>
                <li>
                    <a href="index.php">Knjige</a>
                </li>
                <li>
                    <a href="messages.php">Poruke</a>
                </li>
                <li>
                    <a href="logout.php">Odjavi se</a>
                </li>
            <?php }
            else if($moderator){ ?>
                <li>
                    <a href="index.php">Knjige</a>
                </li>
                <li>
                    <a href="addbook.php">Dodaj knjigu</a>
                </li>
                <li>
                    <a href="removebook.php">Ukloni knjigu</a>
                </li>
                <li>
                    <a href="logout.php">Odjavi se</a>
                </li>
            <?php 
            } else {
            if($loggedin) { ?>
                <li>
                    <a href="index.php">Knjige</a>
                </li>
                <li>
                    <a href="cart.php">Moja korpa</a>
                </li>
                <li>
                    <a href="accounts.php">Podaci o naručiocu</a>
                </li>
                <li>
                    <a href="orders.php">Istorija Narudžbina</a>
                </li>
                <li>
                    <a href="logout.php">Odjavi se</a>
                </li>
            <?php } else { ?>
                <li>
                    <a href="index.php">Knjige</a>
                </li>
                <li>
                    <a href="signup.php">Registruj se</a>
                </li>
                <li>
                    <a href="login.php">Prijavi se</a>
                </li>
            <?php } 
            }
            ?>
        </ul>