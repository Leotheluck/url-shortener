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
        // require_once "./redirect.php";

        $stmt = $pdo->prepare("
            SELECT * 
            FROM urls
            ");
        $stmt->execute();
        $urls = $stmt->fetchAll(PDO::FETCH_ASSOC);

        if ($_GET["popup"] == "not-enabled") {
            echo "<div class='popup'>This link has not been enabled!</div>";
        }

        if (isset($_GET["url"])) {
            header("Location: ./redirect.php?code=".$_GET["url"]);
        }
    ?>

    <div class="container">
        <div class="main">
            <div class="header"></div>
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
            <div class="scroll"></div>
        </div>
        <div class="side-panel">
            <?php
                foreach(array_reverse($urls, true) as $url) {
                    echo "<p>wmln.me/".$url["url_code"]."</p>";
                };
            ?>
        </div>
    </div>

    </br>
    </br>
    
    <form action="./publish.db.php" method="post">
        <input type="text" name="url-origin" value="haha">Votre url</input>
        <button type="submit">Publier</button>
    </form>

    <script src="./scripts/main.js"></script>
</body>
</html>