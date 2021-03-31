<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>WMLN®</title>
    <meta name="description" content="free url stuff for my very short friends">
    <link rel="stylesheet" href="./styles/main.css">
</head>
<body>
    <?php
        include "./db.php";
        include "./functions.php"; 
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
                <?php if(!empty($_SESSION["username"])): ?>
                    <form action="./disconnect.db.php" class="disconnect" method="post">
                        <input type="submit" value="Se déconnecter"></input>
                    </form>
                <?php endif ?>
                <?php if(empty($_SESSION["username"])): ?>
                    <div class="information">
                        <h4>Connexion</h4>
                    </div>
                <?php endif ?>
            </div>
            <?php if(!empty($_SESSION["username"])): ?>
                <div class="shortener">
                    <a href="" class="logo"></a>
                    <form action="./publish.db.php" class="inputs" method="post">
                        <input class="url-input" type="text" name="url-origin" placeholder="Collez votre URL ici" value=
                            <?php
                                if (!empty($_GET)) {
                                    echo "localhost:8888/back-end/url-shortener/".$_GET["published"];
                                }
                            ?>></input>
                        <button class="submit-input" type="submit">Go !</button>
                    </form>
                </div>
            <?php endif ?>
            <?php if(empty($_SESSION["username"])): ?>
                <div class="shortener">
                    <a href="" class="logo"></a>
                    <form action="./login.db.php" method="post" class="inputs loginPage">
                        <div class="logsInputs">
                            <input type="text" name="username" id="username" placeholder="Nom d'utilisateur" class="logs-inputs" required />
                            <input type="password" name="password" id="password" placeholder="Mot de passe" class="logs-inputs" required />
                        </div>
                        <div class="logZone">
                            <a class="logLink" href="./signup.php">Pas de compte ? S'inscrire</a>
                            <input type="submit" value="Connexion" class="connectButton"/>
                        </div>
                    </form>
                </div>
            <?php endif ?>
            <div class="scroll">

            </div>
        </div>
    </div>

    <script src="./scripts/main.js"></script>
</body>
</html>