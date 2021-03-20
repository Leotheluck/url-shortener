<?php

    echo "trop trop mims les potes ça va ou quoi haha ^^</br>";

    $json = file_get_contents("./db.json");
    $data = json_decode($json, true);
    $shortened = $data["shortened"];

    echo $shortened[0]["id"];

    
?>

<input class="inputms">mon url corute</input>