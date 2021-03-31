<?php
    session_start();
    include "./db.php";
    include "./functions.php";

    $favLink = "";
    $to_remove = $_GET["linkfav"].",";


    foreach($users as $user) {
        if ($user["uid"] == $_SESSION["uid"]) {
            $favLink = str_replace($to_remove, "", $user["favlinks"]);
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

    header("Location: ./?popup=removed-fav");
?>