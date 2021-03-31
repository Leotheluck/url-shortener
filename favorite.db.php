<?php
    session_start();
    include "./db.php";
    include "./functions.php";

    $favLink = "";

    foreach($users as $user) {
        if ($user["uid"] == $_SESSION["uid"]) {
            $favLink = $user["favlinks"].$_GET["linkfav"].",";
        }
    }

    $stmt = $pdo->prepare("
        UPDATE userbase
        SET favlinks = :favLink
        WHERE uid = :userID
    ");

    $stmt->execute([
        ":favLink" => $favLink,
        ":userID" => $_SESSION["uid"],
    ]);  

    header("Location: ./?popup=added-fav");
?>