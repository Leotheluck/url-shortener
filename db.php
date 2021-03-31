<?php

// echo "The database file is working !";

$ip = "localhost";
$port = $_SERVER['SERVER_PORT'];
$username = "root";
$password = "root";
$dbname = "shorturl";

$pdo = new PDO("mysql:host=localhost;dbname=shorturl", $username, $password, [
    PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION
]);

$stmt = $pdo->prepare("
    SELECT * 
    FROM userbase
    ");
$stmt->execute();
$users = $stmt->fetchAll(PDO::FETCH_ASSOC);

$stmt = $pdo->prepare("
    SELECT * 
    FROM urls
    ");
$stmt->execute();
$urls = $stmt->fetchAll(PDO::FETCH_ASSOC);

?>