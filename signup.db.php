<?php
// Including database basics
    include "./db.php";

// Getting inputs from $_POST
    $uid = $_POST["username"];
    $pw = $_POST["password"];
    $pwcheck = $_POST["password-confirm"];
    $mail = $_POST["mail"];

// Checking if either UID or Mail already exists
    $uid_exists = false;
    $mail_exists = false;

    foreach($users as $user) {
        if ($uid == $user["username"]) {
            $uid_exists = true;
        }
        if ($mail == $user["mail"]) {
            $mail_exists = true;
        }
    }

// Checking if the inputs are correct
    if (strlen($pw) < 5 || strlen($pw) > 24) {
        header("Location: ./signup.php?error=pw-length");
    } else if ($pw != $pwcheck) {
        header("Location: ./signup.php?error=pw-match");
    } else if (!$uid || !$pw || !$mail) {
        header("Location: ./signup.php?error=missing-info");
    } else if (!filter_var($mail, FILTER_VALIDATE_EMAIL)) {
        header("Location: ./signup.php?error=invalid-mail");
    } else if ($uid_exists) {
        header("Location: ./signup.php?error=name-taken");
    } else if ($mail_exists) {
        header("Location: ./signup.php?error=mail-taken");
    } else {
        $stmt = $pdo->prepare("
            INSERT INTO userbase (username, mail, password, links, favlinks)
            VALUES(:username, :mail, :password, :links, :favlinks)
        ");

        $stmt->execute([
            ":username" => $uid,
            ":mail" => $mail,
            ":password" => password_hash($pw, PASSWORD_DEFAULT),
            ":links" => "",
            ":favlinks" => ""
        ]);

        header("Location: ./?popup=successful-signup&name=".$uid);
    }
?>