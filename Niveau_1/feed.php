<?php
session_start();
// Vérifie si l'utilisateur n'est pas connecté (par exemple, en vérifiant la présence d'une variable de session)
if (!isset($_SESSION['connected_id'])) {
    header("Location: login.php"); // Redirige vers la page de connexion
    exit(); // Arrête l'exécution du reste du code
}

?>

<!doctype html>
<html lang="fr">

<head>
    <meta charset="utf-8">
    <title>MySafePLace - Flux</title>
    <meta name="author" content="Julien Falconnet">
    <link rel="stylesheet" href="style.css" />
</head>

<body>
    <?php include("header.php"); ?>

    <div id="wrapper">
        <?php
        /**
         * Cette page est TRES similaire à wall.php. 
         * Vous avez sensiblement à y faire la meme chose.
         * Il y a un seul point qui change c'est la requete sql.
         */
        /**
         * Etape 1: Le mur concerne un utilisateur en particulier
         */
        $userId = intval($_GET['user_id']);
        ?>
        <?php
        /**
         * Etape 2: se connecter à la base de donnée
         */
        include("BDconnection.php");
        ?>
        <aside>
            <?php
            /**
             * Etape 3: récupérer le nom de l'utilisateur
             */
            $laQuestionEnSql = "SELECT * FROM `users` WHERE id= '$userId' ";
            $lesInformations = $mysqli->query($laQuestionEnSql);
            $user = $lesInformations->fetch_assoc();
            //@todo: afficher le résultat de la ligne ci dessous, remplacer XXX par l'alias et effacer la ligne ci-dessous
            //echo "<pre>" . print_r($user, 1) . "</pre>";
            ?>
            <!-- <div class="initial-avatar">...</div> -->
            <img src="user.jpg" alt="Portrait de l'utilisatrice"/>
            <section>
                <h3>🌸 Ta safe commu 🌸</h3>
                <p><?php echo $user['alias'] ?>, ici tu n'es qu'entre ami.e.s !</p>
                <p>C'est sur cette page que tu retrouves les posts des personnes que tu suis.</p>
            </section>
        </aside>
        <main class="debord_gauche">
            <?php
            include("mainSQLrequest.php");
            ?>
            <?php
            while ($post = $lesInformations->fetch_assoc()) {
                include "articles.php";
            }
            ?>
        </main>
    </div>
</body>

</html>