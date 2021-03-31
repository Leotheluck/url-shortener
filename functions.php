<?php
    session_start();

    $path = "http://".$_SERVER["SERVER_NAME"].":".$_SERVER['SERVER_PORT'].dirname($_SERVER["PHP_SELF"])."/";

    $stmt = $pdo->prepare("
    SELECT * 
    FROM urls
    ");
    $stmt->execute();
    $urls = $stmt->fetchAll(PDO::FETCH_ASSOC);

    if (!empty($_GET["popup"])) {
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
        } else if ($_GET["popup"] == "added-fav") {
        echo "<div class='popup'>Lien ajouté aux favoris !</div>";
        } else if ($_GET["popup"] == "removed-fav") {
        echo "<div class='popup'>Lien retiré des favoris !</div>";
        } else if ($_GET["popup"] == "changed-par") {
        echo "<div class='popup'>Paramètres changés !</div>";
        } else if ($_GET["popup"] == "copied-link") {
        echo "<div class='popup'>Lien copié dans le presse-papier !</div>";
        }
    }

    if (!empty($_GET["published"])) {
        echo "<div class='popup'>Lien copié dans le presse-papier !</div>";
    }

    if (isset($_GET["url"])) {
    header("Location: ./redirect.php?code=".$_GET["url"]);
    }

    function favorite($fav) {
        $favLink = "";

        foreach($users as $user) {
            if ($user["uid"] == $_SESSION["uid"]) {
                $favLink = $user["favlinks"].$fav.",";
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
    }
?>