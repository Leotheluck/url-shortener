<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>WMLN®</title>
    <meta name="description" content="free url stuff for my very short friends">
    <link rel="shortcut icon" href="./favicon.ico" type="image/x-icon">
    <link rel="stylesheet" href="./styles/main.css">
</head>
<body>
    <?php
        include "./db.php";
        include "./functions.php"; 

        if (!empty($_SESSION["username"])) {
            $user_links = "";
            $fav_links = "";

            foreach($users as $user) {
                if ($user["uid"] == $_SESSION["uid"]) {
                    $user_links = $user["links"];
                    $fav_links = $user["favlinks"];
                }
            }
        };  
    ?>

    <div class="side-panel">
        <div class="hide">
            <div class="button"></div>
        </div>

        <?php if(empty($_SESSION["username"])): ?>
            <div class="panel-content">
                <p class="panel-welcome">Bienvenue !</p>
                <div class="panel-menu">
                    <p class="panel-titles">Derniers liens créés</p>
                    <?php

                        foreach(array_reverse($urls, true) as $url) {
                            echo '<div class="link-control">';
                            echo '<div class="link">';
                            echo '<a href="'.$path.$url["url_code"].'" target="_blank" class="wmln-link" title="'.$url["url"].'">wmln.me/'.$url["url_code"].'</a>';
                            echo "</div>";
                            echo "</div>";
                        };

                    ?>
                </div>
            </div>
        <?php
            // foreach(array_reverse($urls, true) as $url) {
            //     echo "<p>wmln.me/".$url["url_code"]."</p>";
            // };
        ?>
    </div>
        <?php endif ?>

        <?php if(!empty($_SESSION["username"])): ?>
            <div class="panel-content">
                <p class="panel-welcome">Bienvenue, </br><strong><?php echo $_SESSION["username"]; ?></strong> !</p>
                <div class="panel-menu">
                    <p class="panel-titles">Mes liens favoris</p>
                    <?php

                        $linksfav = explode(',', $fav_links);
                        for ($i=0; $i < count($linksfav) - 1; $i++) { 

                            $url_description = "";
                            $url_views = 0;
                            $url_state = 1;

                            foreach($urls as $url) {
                                if ($url["url_code"] == $linksfav[$i]) { 
                                    $url_description = $url["url"];
                                    $url_views = $url["views"];
                                    $url_state = $url["active"];
                                }
                            };

                            echo '<div class="link-control">';
                            echo '<div class="link">';
                            echo '<a href="'.$path.$linksfav[$i].'" target="_blank" class="wmln-link" title="'.$url_description.'">wmln.me/'.$linksfav[$i].'</a>';
                            echo '<div class="link-counter">';
                            echo '<p>[<strong>'.$url_views.'</strong></p>';
                            echo '<div class="eye-icon-w"></div>';
                            echo '<p>]</p>';
                            echo '</div>';
                            echo '</div>';
                            echo '<div class="commands-icons">';
                            echo '<form class="star-icon-z icon" method="post" action="./unfavorite.db.php?linkfav='.$linksfav[$i].'">';
                            echo '<button type="submit" class="button"></button>';
                            echo '</form>';
                            if ($url_state == 1) {
                                echo '<form class="checkcase-icon-z icon" method="post" action="./active.db.php?linkact='.$linksfav[$i].'">';
                                echo '<button type="submit" class="button"></button>';
                                echo '</form>';
                            } else if ($url_state == 0) {
                                echo '<form class="checkcase-icon-w icon" method="post" action="./active.db.php?linkact='.$linksfav[$i].'">';
                                echo '<button type="submit" class="button"></button>';
                                echo '</form>';
                            }
                            echo '<div></div>';
                            echo '</div>';
                            echo '</div>';
                        }
                    ?>
                    <p class="panel-titles">Mes liens</p>
                    <?php

                        $links = explode(',', $user_links);
                        for ($i=0; $i < count($links) - 1; $i++) { 

                            $isFav = false;

                            foreach($linksfav as $linkfav) {
                                if ($links[$i] == $linkfav) {
                                    $isFav = true;
                                }
                            }

                            if (!$isFav) {
                                $url_description = "";
                                $url_views = 0;
                                $url_state = 1;

                                foreach($urls as $url) {
                                    if ($url["url_code"] == $links[$i]) { 
                                        $url_description = $url["url"];
                                        $url_views = $url["views"];
                                        $url_state = $url["active"];
                                    }
                                };

                                echo '<div class="link-control">';
                                echo '<div class="link">';
                                echo '<a href="'.$path.$links[$i].'" target="_blank" class="wmln-link" title="'.$url_description.'">wmln.me/'.$links[$i].'</a>';
                                echo '<div class="link-counter">';
                                echo '<p>[<strong>'.$url_views.'</strong></p>';
                                echo '<div class="eye-icon-w"></div>';
                                echo '<p>]</p>';
                                echo '</div>';
                                echo '</div>';
                                echo '<div class="commands-icons">';
                                echo '<form class="star-icon-w icon" method="post" action="./favorite.db.php?linkfav='.$links[$i].'">';
                                echo '<button type="submit" class="button"></button>';
                                echo '</form>';
                                if ($url_state == 1) {
                                    echo '<form class="checkcase-icon-z icon" method="post" action="./active.db.php?linkact='.$links[$i].'">';
                                    echo '<button type="submit" class="button"></button>';
                                    echo '</form>';
                                } else if ($url_state == 0) {
                                    echo '<form class="checkcase-icon-w icon" method="post" action="./active.db.php?linkact='.$links[$i].'">';
                                    echo '<button type="submit" class="button"></button>';
                                    echo '</form>';
                                }
                                echo '<div></div>';
                                echo '</div>';
                                echo '</div>';
                            }

                            
                        }
                    ?>
                </div>
            </div>
        <?php endif ?>
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
                <?php if(empty($_GET["published"])): ?>
                        <form action="./publish.db.php" class="inputs" method="post">
                            <input class="url-input" type="text" name="url-origin" placeholder="Collez votre URL ici" value=""></input>
                            <button class="submit-input" type="submit">Go !</button>
                        </form>
                <?php endif ?>
                <?php if(!empty($_GET["published"])): ?>
                    <div class="inputs">
                        <input class="url-input" type="text" name="url-origin" placeholder="Collez votre URL ici" value=
                            <?php
                                echo $path.$_GET["published"];
                            ?>>
                            </input>
                        <button class="test copy-input"><img src="https://i.imgur.com/iOr8ddO.png" alt="Icone Copier"></button>
                        <form method="post" action="./empty.db.php">
                            <button class="reset-input" type="submit"><img src="https://i.imgur.com/2rVrfjt.png" alt="Icone Réinitialiser"></button>
                        </form>
                    </div>
                <?php endif ?>
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