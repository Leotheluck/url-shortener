<?php
    session_start();

    $stmt = $pdo->prepare("
    SELECT * 
    FROM urls
    ");
    $stmt->execute();
    $urls = $stmt->fetchAll(PDO::FETCH_ASSOC);

    if ($_GET["popup"] == "not-enabled") {
    echo "<div class='popup'>Ce lien n'est pas activé !</div>";
    } else if ($_GET["popup"] == "successful-signup") {
    echo "<div class='popup'>Votre compte a été activé, ".$_GET["name"]." !</div>";
    } else if ($_GET["popup"] == "successful-login") {
    echo "<div class='popup'>Connexion réussie, ".$_SESSION["username"]." !</div>";
    } else if ($_GET["popup"] == "login-failed") {
    echo "<div class='popup'>Mot de passe ou nom d'utilisateur invalide !</div>";
    } else if ($_GET["popup"] == "successfuly-disconnected") {
    echo "<div class='popup'>Déconnexion, à la prochaine !</div>";
    }

    if (isset($_GET["url"])) {
    header("Location: ./redirect.php?code=".$_GET["url"]);
    }
?>