<?php
// Including database basics
    include "./db.php";

// Getting inputs from $_POST
    $uid = $_POST["username"];
    $pw = $_POST["password"];

    $user_logged = false;

    foreach($users as $user) {
        if ($uid == $user["username"] && password_verify($pw, $user["password"])) {
            session_start();

            $_SESSION["username"] = $user["username"];
            $_SESSION["uid"] = $user["uid"];

            $user_logged = true;

            header("Location: ./?popup=successful-login");
        }
    }

    if ($user_logged == false) {
        header("Location: ./?popup=login-failed");
    }

?>