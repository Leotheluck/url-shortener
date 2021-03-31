<?php
    session_start();
    include "./db.php";
    include "./functions.php";

    $linkstate = 1;

    foreach($urls as $url) {
        if ($url["url_code"] == $_GET["linkact"]) {
            if ($url["active"] == 1) {
                $linkstate = 0;
            }
        }
    }

    $stmt = $pdo->prepare("
        UPDATE urls
        SET active = :active
        WHERE url_code = :urlCODE
    ");

    $stmt->execute([
        ":active" => $linkstate,
        ":urlCODE" => $_GET["linkact"],
    ]);  

    header("Location: ./?popup=changed-par");
?>