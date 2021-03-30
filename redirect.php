<?php
    $stmt = $pdo->prepare("
        SELECT * 
        FROM urls
        ");
    $stmt->execute();
    $urls = $stmt->fetchAll(PDO::FETCH_ASSOC);

    $destination = "";
    $urlID = -1;
    $urlViewsCalc = 0;
    $urlEnabled = 0;

    // var_dump($urls);
    foreach($urls as $url) {
        if ($url["url_code"] == $_GET["code"]) { 
            $destination = $url["url"];
            $urlID = $url["id"];
            $urlViewsCalc = $url["views"] + 1;
            $urlEnabled = $url["active"];
        }
    };
    
    $stmt = $pdo->prepare("
        UPDATE urls
        SET views = :urlViews
        WHERE id = :urlID
    ");

    $stmt->execute([
        ":urlViews" => $urlViewsCalc,
        ":urlID" => $urlID,
    ]);    

    if ($urlEnabled == 1) {
        header("Location: ".$destination);
    } else {
        echo "this link has not been enabled";
    };
?>