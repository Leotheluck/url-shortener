<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>WMLN® Inscription</title>
    <meta name="description" content="free url stuff for my very short friends">
    <link rel="stylesheet" href="./styles/main.css">
</head>
<body>
    <?php
        if (!empty($_GET["popup"])) {
            if ($_GET["error"] == "pw-length") {
                echo "<div class='popup'>Le mot de passe doit faire entre 5 et 23 caractères !</div>";
            } else if ($_GET["error"] == "pw-match") {
                echo "<div class='popup'>Les mots de passe doivent correspondre !</div>";
            } else if ($_GET["error"] == "missing-info") {
                echo "<div class='popup'>Toutes les cases doivent être remplies !</div>";
            } else if ($_GET["error"] == "invalid-mail") {
                echo "<div class='popup'>Le mail rentré doit être valide !</div>";
            } else if ($_GET["error"] == "name-taken") {
                echo "<div class='popup'>Ce nom d'utilisateur est déjà pris !</div>";
            } else if ($_GET["error"] == "mail-taken") {
                echo "<div class='popup'>Cet e-mail est déjà utilisé par un autre compte !</div>";
            }
        }
    ?>
    <div class="side-panel">
        <div class="hide">
            <div class="button"></div>
        </div>
        <?php
            // foreach(array_reverse($urls, true) as $url) {
            //     echo "<p>wmln.me/".$url["url_code"]."</p>";
            // };
        ?>
    </div>
    <div class="container">
        <div class="main">
            <div class="header">
                <div class="information">
                    <h4>Inscription</h4>
                </div>
            </div>
            <div class="shortener">
                <a href="" class="logo"></a>
                <form action="./signup.db.php" method="POST" class="SigninPage">
                    <input type="text" name="username" id="username" placeholder="Nom d'utilisateur" />

                    <input type="text" name="mail" id="mail" placeholder="Adresse mail" required />
                    
                    <input type="password" name="password" id="password" placeholder="Mot de passe" required />

                    <input type="password" name="password-confirm" id="password-confirm" placeholder="Confirmer le mot de passe" required />

                    <div class="SigninZone">
                        <a href="./" class="logLink">Déjà inscrit ? Se connecter</a>
                        <input type="submit" value="S'inscrire" class="signinButton" />
                    </div>
                </form>
            </div>
        </div>
    </div>
    <script src="./scripts/main.js"></script>
</body>
</html>