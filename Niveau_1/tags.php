<?php
session_start();
?>

<?php include("header.php"); ?>

<!doctype html>
<html lang="fr">
<head>
    <meta charset="utf-8">
    <title>MySafePlace - Les messages par mot-clé</title>
    <meta name="author" content="Julien Falconnet">
    <link rel="stylesheet" href="style.css"/>
</head>

<div id="wrapper">
    <?php
    /**
     * Cette page est similaire à wall.php ou feed.php
     * mais elle porte sur les mots-clés (tags)
     */

    /**
     * Etape 1: Le mur concerne les tags sélectionnés par l'utilisateur
     */
    if (isset($_GET['id'])) {
        $tagId = intval($_GET['id']);
    }

    /**
     * Etape 2: Se connecter à la base de données
     */
    include("BDconnection.php");
    ?>

    <aside>

    <?php
    /**
     * Etape 3: Récupérer tous les mots-clés (tags)
     */
    $laQuestionEnSql = "SELECT * FROM tags";
    $lesInformations = $mysqli->query($laQuestionEnSql);
    if (!$lesInformations) {
        echo("Échec de la requête : " . $mysqli->error);
    }
    ?>
    <!-- <div class="initial-avatar">...</div> -->
    <img src="user.jpg" alt="Portrait de l'utilisatrice"/>

    <section>
        <h3>Mots-clés</h3>
        <?php
        $tagList = "";
        while ($tag = $lesInformations->fetch_assoc()) {
            $tagList .= '<a href="tags.php?id=' . $tag["id"] . '">'.'#'. $tag["label"] . '</a> ';
        }
        echo $tagList;
        ?>
    </section>


    
        <?php if (isset($tagId)):
            /**
             * Etape 3: Récupérer le nom du mot-clé
             */
            $laQuestionEnSql = "SELECT * FROM tags WHERE id = '$tagId'";
            $lesInformations = $mysqli->query($laQuestionEnSql);
            $tag = $lesInformations->fetch_assoc();
            //@todo: afficher le résultat de la ligne ci-dessous, remplacer XXX par le label et effacer la ligne ci-dessous
            //echo "<pre>" . print_r($tag, 1) . "</pre>";
            ?>
            <div class="initial-avatar">...</div>
            <!-- <img src="user.jpg" alt="Portrait de l'utilisatrice"/> -->

            <section>
    <h3>Mes Safes Keys #</h3>
    <p>Sur cette page, vous trouverez les derniers messages comportant le mot-clé <strong><?php echo $tag["label"] ?></strong>
        (n° <?php echo $tag["id"] ?>)</p>
</section>

        <?php endif; ?>

    </aside>
    <main>
        <?php
        /**
         * Etape 3: Récupérer tous les messages avec un mot clé donné
         */
        if (isset($tagId)) {
            $laQuestionEnSql = "
                    SELECT posts.content,
                    users.id as author_id,
                    posts.created,
                    users.alias as author_name,
                    count(likes.id) as like_number,
                    GROUP_CONCAT(DISTINCT tags.label) AS taglist, GROUP_CONCAT(DISTINCT tags.id) AS tagId
                    FROM posts_tags as filter 
                    JOIN posts ON posts.id=filter.post_id
                    JOIN users ON users.id=posts.user_id
                    LEFT JOIN posts_tags ON posts.id = posts_tags.post_id
                    LEFT JOIN tags       ON posts_tags.tag_id  = tags.id
                    LEFT JOIN likes      ON likes.post_id  = posts.id
                    WHERE filter.tag_id = '$tagId'
                    GROUP BY posts.id
                    ORDER BY posts.created DESC  
                ";
            $lesInformations = $mysqli->query($laQuestionEnSql);
            if (!$lesInformations) {
                echo ("Échec de la requête : " . $mysqli->error);
            }

            /**
             * Etape 4: @todo Parcourir les messages et remplir correctement le HTML avec les bonnes valeurs php
             */
            while ($post = $lesInformations->fetch_assoc()) {
                include "articles.php";
            }
        }
        ?>

    </main>
</div>
</body>
</html>
