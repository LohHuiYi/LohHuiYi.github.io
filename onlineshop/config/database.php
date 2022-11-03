<?php
// used to connect to the database
$host = "localhost";
$db_name = "onlineshop";
$username = "onlineshop";
$password = "0(0(o[4JJ1RaR2Pk";

try {
    $con = new PDO("mysql:host={$host};dbname={$db_name}", $username, $password);
    //echo "Connected successfully";
}

// show error
catch (PDOException $exception) {
    echo "Connection error: " . $exception->getMessage();
}
