<?php
session_start();
// Vérifie si l'utilisateur n'est pas connecté (par exemple, en vérifiant la présence d'une variable de session)
if (!isset($_SESSION['connected_id'])) {
    header("Location: login.php"); // Redirige vers la page de connexion
    exit(); // Arrête l'exécution du reste du code
}

?>

<?php include("header.php"); ?>

<!doctype html>
<html lang="fr">

<head>
    <meta charset="utf-8">
    <title>MySafePLace - Paramètres</title>
    <meta name="author" content="Julien Falconnet">
    <link rel="stylesheet" href="style.css" />
</head>

<body>



    <div id="wrapper" class='profile'>


        <aside>
            <div class="initial-avatar">...</div>
            <!-- <img src="user.jpg" alt="Portrait de l'utilisatrice"/> -->
            <section>
                <h3>Présentation</h3>
                <p>Sur cette page vous trouverez les informations de l'utilisatrice
                    n° <?php echo intval($_SESSION['connected_id']) ?></p>
                <br>
                <hr>
                <br>
                <form action="settings.php?user_id=<?php echo $_SESSION['connected_id']; ?>" method="post">
                <input type="submit" name = 'followers' value="Mes followers">
                </form>
                <br>
                <hr>
                <br>
                <form action="subscriptions.php?user_id=<?php echo $_SESSION['connected_id']; ?>" method="post">
                <input type="submit" name = 'subscribe' value="Mes abonnements">
                </form>
                <br>
                <hr>
                <br>
                <form action="login.php?user_id=<?php echo $_SESSION['connected_id']; ?>" method="post">
                <input type="submit" name = 'disconnect' value="Me déconnecter">
                </form>

            </section>
        </aside>
        <main>
            <?php
            /**
             * Etape 1: Les paramètres concernent une utilisatrice en particulier
             * La première étape est donc de trouver quel est l'id de l'utilisatrice
             * Celui ci est indiqué en parametre GET de la page sous la forme user_id=...
             * Documentation : https://www.php.net/manual/fr/reserved.variables.get.php
             * ... mais en résumé c'est une manière de passer des informations à la page en ajoutant des choses dans l'url
             */
            $userId = intval($_SESSION['connected_id']);

            /**
             * Etape 2: se connecter à la base de donnée
             */
            include("BDconnection.php");

            /**
             * Etape 3: récupérer le nom de l'utilisateur
             */
            $laQuestionEnSql = "
                    SELECT users.*, 
                    count(DISTINCT posts.id) as totalpost, 
                    count(DISTINCT given.post_id) as totalgiven, 
                    count(DISTINCT recieved.user_id) as totalrecieved 
                    FROM users 
                    LEFT JOIN posts ON posts.user_id=users.id 
                    LEFT JOIN likes as given ON given.user_id=users.id 
                    LEFT JOIN likes as recieved ON recieved.post_id=posts.id 
                    WHERE users.id = '$userId' 
                    GROUP BY users.id
                    ";
            $lesInformations = $mysqli->query($laQuestionEnSql);
            if (!$lesInformations) {
                echo ("Échec de la requete : " . $mysqli->error);
            }
            $user = $lesInformations->fetch_assoc();

            /**
             * Etape 4: à vous de jouer
             */
            //@todo: afficher le résultat de la ligne ci dessous, remplacer les valeurs ci-après puiseffacer la ligne ci-dessous
            ?>
            <article class='parameters'>
                <h3>Mes paramètres</h3>
                <dl>
                    <dt>Pseudo</dt>
                    <dd><?php echo $user['alias'] ?></dd>
                    <dt>Email</dt>
                    <dd><?php echo $user['email'] ?></dd>
                    <dt>Nombre de message</dt>
                    <dd><?php echo $user['totalpost'] ?></dd>
                    <dt>Nombre de "J'aime" donnés </dt>
                    <dd><?php echo $user['totalgiven'] ?></dd>
                    <dt>Nombre de "J'aime" reçus</dt>
                    <dd><?php echo $user['totalrecieved'] ?></dd>
                </dl>
            </article>
            <?php if(isset($_POST['followers'])){
                ?>
                <main class='contacts'>
            <?php
            // Etape 1: récupérer l'id de l'utilisateur
            $userId = intval($_SESSION['connected_id']);
            // Etape 2: se connecter à la base de donnée
            include("BDconnection.php");
            // Etape 3: récupérer le nom de l'utilisateur
            $laQuestionEnSql = "
                    SELECT users.*
                    FROM followers
                    LEFT JOIN users ON users.id=followers.following_user_id
                    WHERE followers.followed_user_id='$userId'
                    GROUP BY users.id
                    ";
            $lesInformations = $mysqli->query($laQuestionEnSql);
            // Etape 4: à vous de jouer
            //@todo: faire la boucle while de parcours des abonnés et mettre les bonnes valeurs ci dessous 

            while ($userId = $lesInformations->fetch_assoc()) { ?>
                <article>
                    <img src="user.jpg" alt="blason" />
                    <h3><?php echo $userId["alias"] ?></h3>
                    <p><?php echo $userId["id"] ?></p>
                </article>
            <?php
            } ?>
        </main>

            <?php
            }
            ?>
            

        </main>
    </div>
</body>

</html>