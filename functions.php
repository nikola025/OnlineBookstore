<?php

$dbhost = "localhost";
$dbname = "knjizara";
$dbuser = "knadmin";
$dbpassword = "knadmin";

$connection  = new mysqli($dbhost, $dbuser, $dbpassword, $dbname);
if($connection->connect_error != null){
    die($connection->connect_error);
} 


function queryMysql($query){
    global $connection;
    $result = $connection->query($query);
    if(!$result){
        die($connection->error);
    }
    return $result;
}

function createTable($name, $query){
    queryMysql("CREATE TABLE IF NOT EXISTS $name($query)");
    echo "Table '$name' created or already exists.<br>";
}

function sanitizeString($text){
    $text = strip_tags($text);
    $text = htmlentities($text);
    $text = stripslashes($text);
    global $connection;
    $text = $connection->real_escape_string($text);
    return $text;
}

function showBook($id){
    $result = queryMysql("SELECT * FROM books WHERE books.id = $id");
    if($result->num_rows){
        $row = $result->fetch_assoc();
        echo "<img src='slike/knjiga$id.jpg'>";
        echo "<br>";
        echo $row['bname'];
        echo "<br>";
        echo $row['bauthor'];
        echo "<br>";
        echo $row['bprice']; 
    }

}



