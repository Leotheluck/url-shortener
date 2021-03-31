<?php
session_start();
include "./db.php";

$secret = ['a','b','c','d','e','f','g','h','i','j','k','l','m','n','o','p','q','r','s','t','u','v','w','x','y','z',
               'A','B','C','D','E','F','G','H','I','J','K','L','M','N','O','P','Q','R','S','T','U','V','W','X','Y','Z',
               '0','1','2','3','4','5','6','7','8','9'];

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

$newLink = "";

foreach($users as $user) {
    if ($user["uid"] == $_SESSION["uid"]) {
        $newLink = $user["links"].$code.",";
    }
}

$stmt = $pdo->prepare("
    UPDATE userbase
    SET links = :newLink
    WHERE uid = :userID
");

$stmt->execute([
    ":newLink" => $newLink,
    ":userID" => $_SESSION["uid"],
]);  

header("Location: ./?published=".$code)

?>