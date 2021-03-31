<?php
// Including database basics
    include "./db.php";

// Loading Data
    $stmt = $pdo->prepare("
        SELECT * 
        FROM userbase
        ");
    $stmt->execute();

    $users = $stmt->fetchAll(PDO::FETCH_ASSOC);

// Getting inputs from $_POST
    $uid = $_POST["username"];
    $pw = $_POST["password"];

    $user_logged = false;

    foreach($users as $user) {
        if ($uid == $user["username"] && password_verify($pw, $user["password"])) {
            session_start();

            $_SESSION["username"] = $user["username"];
            $_SESSION["id"] = $user["id"];
            $_SESSION["links"] = $user["links"];
            $_SESSION["favlinks"] = $user["favlinks"];

            $user_logged = true;

            header("Location: ./?popup=successful-login");
        }
    }

    if ($user_logged == false) {
        header("Location: ./?popup=login-failed");
    }

?>