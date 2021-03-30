<?php

// echo "The database file is working !";

$ip = "localhost";
$port = 8888;
$username = "root";
$password = "root";
$dbname = "shorturl";

$pdo = new PDO("mysql:host=localhost;dbname=shorturl", $username, $password, [
    PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION
]);

// $stmt = $pdo->prepare("
//     INSERT INTO urls (url, url_code, views, active)
//     VALUES(:url, :url_code, :views, :active)
// ");
// $stmt->execute([
//     ":url" => "https://www.youtube.com",
//     ":url_code" => "xCEkf",
//     ":views" => 0,
//     ":active" => true
// ]);

?>