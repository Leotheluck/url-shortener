<?php

include "./db.php";
include "./functions.php"; 

$code = $secret[random_int(0,61)].$secret[random_int(0,61)].$secret[random_int(0,61)].$secret[random_int(0,61)].$secret[random_int(0,61)];

if (isset($_POST)) {
    echo $_POST["url-origin"];
    echo $code;
};

$stmt = $pdo->prepare("
    INSERT INTO urls (url, url_code, views, active)
    VALUES(:url, :url_code, :views, :active)
");
$stmt->execute([
    ":url" => $_POST["url-origin"],
    ":url_code" => $code,
    ":views" => 0,
    ":active" => true
]);

header("Location: ./?published=".$code)

?>